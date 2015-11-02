<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Photos extends Model {

    protected $table = 'photos';

    protected $primaryKey = 'photosId';

    public static function deletePhotosByUser($userId)
    {
        $directory = "assets/images/_upload/fotos/".$userId;
        File::deleteDirectory($directory);

        $finalists = Finalists::where('category', 'fotos')->get();
        foreach($finalists as $finalist):
            self::where('photosId', '=', $finalist->idCategory)
                ->where('usersId', '=', $userId)
                ->delete();
        endforeach;

        return self::where('usersId', $userId)->delete();
    }
}