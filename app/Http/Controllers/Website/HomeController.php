<?php namespace App\Http\Controllers\Website;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use League\Flysystem\Filesystem;
use Auth;
use Carbon\Carbon;

use App\Advertising;
use App\Banners;
use App\Calls;
use App\Pages;
use App\Photos;
use App\Videos;

class HomeController extends Controller
{
    public function index()
    {
        $page = 'home';
        $websiteSettings = \App\Exceptions\Handler::readFile("websiteSettings.json");

        $pages = Pages::where('slug', '=', $page)->first();
        $advertising = Advertising::orderByRaw("RAND()")->get();
        foreach ($advertising as $ad) {
            array_add($ad, "image", Advertising::imageVideo($ad->url));
            array_set($ad, "url", Advertising::embedVideo($ad->url, 1));
        }
        $banners = Banners::orderByRaw("RAND()")->get();
        $calls = Calls::orderByRaw("RAND()")->limit(2)->get();

        return view('website.home')->with(compact('page', 'websiteSettings', 'pages', 'advertising', 'banners', 'calls'));
    }

    public function postSentPhotos(Request $request)
    {
        $photos = Photos::where('usersId', '=', $request->userId)
            ->addSelect('usersId')
            ->addSelect('photo')
            ->get();

        return json_encode($photos);
    }

    public function postSentVideo(Request $request)
    {
        $video = Videos::where('usersId', '=', $request->userId)
            ->addSelect('url')
            ->get();
        foreach ($video as $vi) {
            array_add($vi, "image", Advertising::imageVideo($vi->url));
        }

        return json_encode($video);
    }

    public function postUpload(Request $request)
    {
        if(!empty($request->file('photo')) or !empty($request->url)){
            if(5 < count($request->file('photo'))){
                $message = "Você enviou mais fotos do que o permitido!";
                return redirect(url('/'))->with(compact('message'));
            }else{

                $userId = Auth::user()->id;

                $quantityPhotos = Photos::quantityPhotosByUser($userId);
                $quantityVideos = Videos::quantityVideosByUser($userId);
                $quantityPhotosAvailable = 5-$quantityPhotos;

                if($quantityPhotosAvailable < count($request->file('photo'))){
                    $message = "Você enviou mais fotos/vídeo do que o permitido!";
                    return redirect(url('/'))->with(compact('message'));
                }else{

                    $folder = 'assets/images/_upload/fotos/'.$userId.'/';

                    if(!File::exists($folder)) {
                        File::makeDirectory($folder, 0777);
                    }

                    if(!empty($request->url) and ((substr_count($request->url,"http://") == 1 or substr_count($request->url,"https://") == 1)) and $quantityVideos == 0) {
                        $videoAdd = new Videos();
                        $videoAdd->usersId = $userId;
                        $videoAdd->url = $request->url;
                        $videoAdd->save();
                    }

                    if(!empty($request->file('photo'))) {
                        foreach ($request->photo as $file) {
                            if (!is_null($file)) {
                                if ($file->getSize() > 2048000 or $file->getSize() == 0) {
                                    $message = "As fotos não podem ser maiores que 2Mb!";
                                    return redirect(url('/'))->with(compact('message'));
                                } else {
                                    $photoAdd = new Photos();
                                    $photoAdd->usersId = $userId;

                                    //IMAGE
                                    $extension = $file->getClientOriginalExtension();
                                    $nameImage = Carbon::now()->format('YmdHis') . "." . $extension;
                                    Image::make($file)->resize(800, null, function ($constraint) {
                                        $constraint->aspectRatio();
                                    })->save($folder . $nameImage);
                                    Image::make($file)->resize(null, 100, function ($constraint) {
                                        $constraint->aspectRatio();
                                    })->save($folder . "thumb_" . $nameImage);
                                    $photoAdd->photo = $nameImage;

                                    $photoAdd->save();
                                }
                            } else if (is_null($file) and empty($request->url)) {
                                $message = "Envie pelo menos uma foto ou vídeo!";
                                return redirect(url('/'))->with(compact('message'));
                            }
                        }
                    }
                    $message = "Mídias enviadas com sucesso!";
                    return redirect(url('/'))->with(compact('message'));
                }
            }
        }else{
            $message = "Envie pelo menos uma foto ou vídeo!";
            return redirect(url('/'))->with(compact('message'));
        }
    }
}