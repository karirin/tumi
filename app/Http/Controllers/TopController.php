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

class TopController extends Controller
{

    public function index(Request $request)
    {
        $current_user = Auth::user();
        $users = User::get();
        $path = $request->path();
        $message = new Message_relation;
        if ($current_user != "") {
            $current_user_id = $current_user->id;
            $goals = Goal::where('user_id', $current_user->id)->get();
            $message_cs = Message_relation::where('user_id', $current_user->id)->get();
            $message_count = 0;
            foreach ($message_cs as $message_c) {
                if ($message_c->message_count != 0 || $message_c->message_count == 'match') {
                    $message_count++;
                }
            }
            $skills = explode(" ", $current_user->skill);
            $licences = explode(" ", $current_user->licence);
            $match_flg = DB::table('matches')->where('matched_user_id', $current_user->id)->where('match_flg', '!=', 1)->where('unmatch_flg', '!=', 1)->first();
            $param = ['current_user' => $current_user, 'users' => $users, 'skills' => $skills, 'licences' => $licences, 'message_count' => $message_count, 'top_message' => '', 'match_flg' => $match_flg, 'goals' => $goals];
        } else {
            $param = ['users' => $users];
        }
        $user = new User;
        return view('top.index', $param);
    }

    public function privacy_poricy(Request $request)
    {
        $current_user = Auth::user();
        $users = User::get();
        $path = $request->path();
        $message = new Message_relation;
        if ($current_user != "") {
            $message_cs = Message_relation::where('user_id', $current_user->id)->get();
            $message_count = 0;
            foreach ($message_cs as $message_c) {
                if ($message_c->message_count != 0 || $message_c->message_count == 'match') {
                    $message_count++;
                }
            }
            $skills = explode(" ", $current_user->skill);
            $licences = explode(" ", $current_user->licence);
            $param = ['current_user' => $current_user, 'users' => $users, 'skills' => $skills, 'licences' => $licences, 'message_count' => $message_count, 'top_message' => ''];
        } else {
            $param = ['users' => $users];
        }
        $user = new User;

        return view('privacy_poricy', $param);
    }

    public function terms_of_service(Request $request)
    {
        $current_user = Auth::user();
        $users = User::get();
        $path = $request->path();
        $message = new Message_relation;
        if ($current_user != "") {
            $message_cs = Message_relation::where('user_id', $current_user->id)->get();
            $message_count = 0;
            foreach ($message_cs as $message_c) {
                if ($message_c->message_count != 0 || $message_c->message_count == 'match') {
                    $message_count++;
                }
            }
            $skills = explode(" ", $current_user->skill);
            $licences = explode(" ", $current_user->licence);
            $param = ['current_user' => $current_user, 'users' => $users, 'skills' => $skills, 'licences' => $licences, 'message_count' => $message_count, 'top_message' => ''];
        } else {
            $param = ['users' => $users];
        }
        $user = new User;

        return view('terms_of_service', $param);
    }
}
