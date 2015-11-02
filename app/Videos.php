<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model {

    protected $table = 'videos';

    protected $primaryKey = 'videosId';

    public static function deleteVideosByUser($userId)
    {
        $finalists = Finalists::where('category', 'videos')->get();
        foreach($finalists as $finalist):
            self::where('videosId', '=', $finalist->idCategory)
                ->where('usersId', '=', $userId)
                ->delete();
        endforeach;

        return self::where('usersId', $userId)->delete();
    }
}