<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\HelloRequest;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Person;
use App\User;
use App\Goal;
use App\Match;
use App\Models\Message_relation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class GoalController extends Controller
{
    private $method_action_key = 'method_action_key';

    public function add(Request $request)
    {
        $current_user = Auth::user();
        $users = User::get();
        $path = $request->path();
        $message = new Message_relation;
        $message_cs = Message_relation::where('user_id', $current_user->id)->get();
        $message_count = 0;
        foreach ($message_cs as $message_c) {
            if ($message_c->message_count != 0 || $message_c->message_count == 'match') {
                $message_count++;
            }
        }
        $skills = explode(" ", $current_user->skill);
        $licences = explode(" ", $current_user->licence);
        $match_flg = Match::where('matched_user_id', $current_user->id)->where('match_flg', '!=', 1)->where('unmatch_flg', '!=', 1)->first();
        $user = new User;
        if ($request->file('image') != '') {
            $file_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/sample', $file_name);
            $form = "";
            $form = [
                'tittle' => $request->tumi_tittle,
                'image' => 'storage/sample/' . $file_name,
                'user_id' => $current_user->id
            ];
        } else {
            $form = [
                'tittle' => $request->tumi_tittle,
                'image' => 'storage/sample/noimage.jpg',
                'user_id' => $current_user->id
            ];
        }
        $action = session()->get($this->method_action_key);
        $is_reload = ($action == '');
        if (is_null($action)) {
            DB::table('goals')->insert($form);
        }
        $current_user_id = $current_user->id;
        $goals = Goal::where('user_id', $current_user->id)->get();
        $param = ['current_user' => $current_user, 'users' => $users, 'skills' => $skills, 'licences' => $licences, 'message_count' => $message_count, 'top_message' => '', 'match_flg' => $match_flg, 'goals' => $goals];

        return view('top.index', $param);
    }
}
