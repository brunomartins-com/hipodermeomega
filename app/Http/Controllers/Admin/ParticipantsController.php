<?php namespace App\Http\Controllers\Admin;

use App\ACL;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Photos;
use App\Videos;

class ParticipantsController extends Controller
{
    public function getIndex()
    {
        if (! ACL::hasPermission('participants')) {
            return redirect(route('home'))->withErrors(['Você não tem permissão para acessar a página de participantes.']);
        }

        $users = User::where('type', '=', 1)
            ->orderBy('id', 'DESC')
            ->addSelect('id')
            ->addSelect('babyName')
            ->addSelect('babyBirthdate')
            ->addSelect('name')
            ->addSelect('email')
            ->addSelect('city')
            ->addSelect('state')
            ->addSelect('active')
            ->get();

        return view('admin.participants.index')->with(compact('users'));
    }

    public function getView($usersId)
    {
        if (! ACL::hasPermission('participants')) {
            return redirect(route('participants'))->withErrors(['Você não tem permissão para visualizar dados dos participantes.']);
        }

        $user = User::where('id', '=', $usersId)->first();

        return view('admin.participants.view')->with(compact('user'));
    }

    public function putStatus(Request $request)
    {
        if (! ACL::hasPermission('participants', 'edit')) {
            return redirect(route('participants'))->withErrors(['Você não tem permissão para editar o status dos participantes.']);
        }
        $user = User::find($request->userId);
        $user->active = $request->active;
        $user->save();

        $success = "Status do participante editado com sucesso!";

        return redirect(route('participants'))->with(compact('success'));
    }

    public function delete(Request $request)
    {
        if (! ACL::hasPermission('participants', 'delete')) {
            return redirect(route('participants'))->withErrors(['Você não tem permissão para deletar participantes.']);
        }

        Photos::deletePhotosByUser($request->get('userId'));
        Videos::deleteVideosByUser($request->get('userId'));
        User::find($request->get('userId'))->delete();

        $success = "Participante excluído com sucesso.";

        return redirect(route('participants'))->with(compact('success'));
    }
}