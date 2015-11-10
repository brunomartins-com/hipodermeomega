<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class UsersReceipts extends Model {

    protected $table = 'usersReceipts';

    protected $primaryKey = 'usersReceiptsId';

    public $timestamps = false;

    public static function deleteReceiptsByUser($userId)
    {
        $folder = "assets/images/_upload/participantes/";

        $usersReceipts = self::where('usersId', $userId)->get();
        foreach($usersReceipts as $userReceipt):
            if (File::exists($folder . $userReceipt->receipt)) {
                File::delete($folder . $userReceipt->receipt);
            }
        endforeach;

        return self::where('usersId', $userId)->delete();
    }

    public static function quantityReceiptsByUser($userId){
        return self::where('usersId', '=', $userId)->count();
    }
}