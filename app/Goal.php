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
}
