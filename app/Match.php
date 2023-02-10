<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notifiable;

class Match extends Model
{
    protected $table = 'matches';

    protected $guarded = array('id');

    public function getMatch($current_user_id, $matched_user_id)
    {
        $match_flg = DB::select('select * from matches where matched_user_id = ' . $current_user_id . ' and user_id = ' . $matched_user_id . '');
        return $match_flg;
    }
}
