<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Match;
use App\Models\Message;
use App\Models\Message_relation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use DateTime;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $current_user = Auth::user();
        $destination_user = User::find($request->user_id);
        $message_class = new Message;
        $message_relation = new Message_relation;
        $messages = DB::select('select * from messages where ( user_id = ' . $current_user->id . ' and destination_user_id = ' . $destination_user->id . ' ) or ( user_id = ' . $destination_user->id . ' and destination_user_id = ' . $current_user->id . ' )');
        $skills = explode(" ", $current_user->skill);
        $licences = explode(" ", $current_user->licence);
        $message_cs = Message_relation::where('user_id', $current_user->id)->get();
        $message_count = 0;
        foreach ($message_cs as $message_c) {
            if ($message_c->message_count != 0 || $message_c->message_count == 'match') {
                $message_count++;
            }
        }
        Message_relation::where('destination_user_id', $request->user_id)->where('user_id', $current_user->id)->update(['message_count' => 0]);
        $match_flg = Match::where('matched_user_id', $current_user->id)->where('match_flg', '!=', 1)->where('unmatch_flg', '!=', 1)->first();
        $param = ['current_user' => $current_user, 'messages' => $messages, 'destination_user' => $destination_user, 'message_class' => $message_class, 'skills' => $skills, 'licences' => $licences, 'message_count' => $message_count, 'match_flg' => $match_flg];
        return view('message.message', $param);
    }

    public function add(Request $request)
    {
        $this->validate($request, Message::$rules);
        $current_user = Auth::user();
        $destination_user = User::find($request->user_id);
        $message_class = new Message;
        $message = new Message;
        $message->user_id = $request->current_user_id;
        $message->destination_user_id = $request->destination_user_id;
        $message->text = $request->text;
        $date = new DateTime();
        $date->modify('+9 hour');
        $created_at = $date->format('Y-m-d H:i:s');
        $message->created_at = $created_at;
        $message->save();
        $request->session()->regenerateToken();
        $skills = explode(" ", $current_user->skill);
        $licences = explode(" ", $current_user->licence);
        $messages = DB::select('select * from messages where ( user_id = ' . $current_user->id . ' and destination_user_id = ' . $destination_user->id . ' ) or ( user_id = ' . $destination_user->id . ' and destination_user_id = ' . $current_user->id . ' )');
        Message_relation::where('user_id', $request->user_id)->where('destination_user_id', $current_user->id)->increment('message_count', 1);
        $message_relation = new Message_relation;
        $message_cs = Message_relation::where('user_id', $current_user->id)->get();
        $message_count = 0;
        $match_flg = Match::where('matched_user_id', $current_user->id)->where('match_flg', '!=', 1)->where('unmatch_flg', '!=', 1)->first();
        foreach ($message_cs as $message_c) {
            if ($message_c->message_count != 0 || $message_c->message_count == 'match') {
                $message_count++;
            }
        }
        $param = ['current_user' => $current_user, 'destination_user' => $destination_user, 'messages' => $messages, 'message_class' => $message_class, 'skills' => $skills, 'licences' => $licences, 'message_count' => $message_count, 'match_flg' => $match_flg];
        return view('message.message', $param);
    }

    public function ajax_message_process(Request $request)
    {
        $current_user = Auth::user();
        $date = new DateTime();
        $date->modify('+9 hour');
        $created_at = $date->format('Y-m-d H:i:s');
        if ($request->file('image') != '') {
            $file_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/sample', $file_name);
            $image = 'storage/sample/' . $file_name;
            $param = [
                'user_id' => $current_user->id,
                'destination_user_id' => $request->user_id,
                'text' => $request->text,
                'image' => $image,
                'created_at' => $created_at,
            ];
        } else {
            $param = [
                'user_id' => $current_user->id,
                'destination_user_id' => $request->user_id,
                'text' => $request->text,
                'created_at' => $created_at,
            ];
        }
        DB::table('messages')->insert($param);
    }
}
