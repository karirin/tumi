<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notifiable;
use cebe\markdown\Markdown as Markdown;

class Tumi extends Model
{
    protected $table = 'tumis';

    protected $guarded = array('id');

    public static $rules = array(
        'text' => 'required',
        'title' => 'required'
    );

    public function parse() {
        //newでインスタンスを作る
        $parser = new Markdown();
        //bodyをパースする
        return $parser->parse($this->body);
    }

    public function getMarkBodyAttribute() {
        return $this->parse();
    }
}
