<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Message_relation extends Model
{
    protected $table = 'message_relations';

    protected $guarded = array('id');

    public $timestamps = false;

    public function getData()
    {

        $data = DB::table($this->table)->get();
        return $data;
    }

    public function getNewmessage($current_user_id, $destination_user_id)
    {
        $new_message = DB::select('select text from messages where (user_id = ' . $current_user_id . ' and destination_user_id = ' . $destination_user_id . ') or (user_id = ' . $current_user_id  . ' and destination_user_id = ' . $destination_user_id . ') ORDER BY created_at DESC');
        return $new_message[0]->text;
    }

    public function getNewmessagecount($current_user_id, $destination_user_id)
    {
        $new_message_count = DB::select('select message_count from message_relations where user_id = ' . $current_user_id . ' and destination_user_id = ' . $destination_user_id);
        return $new_message_count[0]->message_count;
    }

    public function getmessagecount($current_user_id)
    {
        $new_message_count = DB::select('select message_count from message_relations where user_id = ' . $current_user_id);
        return $new_message_count[0]->message_count;
    }

    public function getNewcreated_at($current_user_id, $destination_user_id)
    {
        $new_message = DB::select('select created_at from messages where (user_id = ' . $current_user_id . ' and destination_user_id = ' . $destination_user_id . ') or (user_id = ' . $current_user_id  . ' and destination_user_id = ' . $destination_user_id . ') ORDER BY created_at DESC');
        return $new_message[0]->created_at;
    }
}