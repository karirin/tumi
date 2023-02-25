<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notifiable;

class Goal extends Model
{
    protected $table = 'goals';

    protected $guarded = array('id');

    public static $rules = array(
        'title' => 'required'
    );

    public function goal_tittle($goal_id)
    {
        $goal_tittle = DB::select('select tittle from goals where id = ' . $goal_id);
        return $goal_tittle[0]->tittle;
    }
}
