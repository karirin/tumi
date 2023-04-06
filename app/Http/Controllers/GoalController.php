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
use App\Tumi;
use DateTime;

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
        $match_flg = DB::table('matches')->where('matched_user_id', $current_user->id)->where('match_flg', '!=', 1)->where('unmatch_flg', '!=', 1)->first();
        $user = new User;
        if ($request->file('image') != '') {
            $file_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/sample', $file_name);
            $form = "";
            $date = new DateTime();
            $year = $date->format('Y');
            $mouth = $date->format('m');
            $day = $date->format('d');
            $form = [
                'tittle' => $request->tumi_tittle,
                'text' => $request->tumi_text,
                'image' => 'storage/sample/' . $file_name,
                'user_id' => $current_user->id,
                'year' => $year,
                'mouth' => $mouth,
                'day' => $day
            ];
        } else {
            $date = new DateTime();
            $year = $date->format('Y');
            $mouth = $date->format('m');
            $day = $date->format('d');
            $form = [
                'tittle' => $request->tumi_tittle,
                'text' => $request->tumi_text,
                'image' => 'storage/sample/noimage.jpg',
                'user_id' => $current_user->id,
                'year' => $year,
                'mouth' => $mouth,
                'day' => $day
            ];
        }
        $action = session()->get($this->method_action_key);
        $is_reload = ($action == '');
        if (is_null($action)) {
            DB::table('goals')->insert($form);
        }
        $current_user_id = $current_user->id;
        $goals = Goal::where('user_id', $current_user->id)->get();
        $goal_message = "積み上げ目標を投稿しました";
        $param = ['current_user' => $current_user, 'users' => $users, 'skills' => $skills, 'licences' => $licences, 'message_count' => $message_count, 'top_message' => '', 'match_flg' => $match_flg, 'goals' => $goals, 'goal_message' => $goal_message];

        return view('top.index', $param);
    }

    public function delete(Request $request)
    {
        $current_user = Auth::user();
        $users = User::get();
        $current_user_id = $current_user->id;
        $goal_id = $request->goal_delete_id;
        $message = new Message_relation;
        $message_cs = Message_relation::where('user_id', $current_user->id)->get();
        $message_count = 0;
        $goals = Goal::where('user_id', $current_user->id)->get();
        $match_flg = DB::table('matches')->where('matched_user_id', $current_user->id)->where('match_flg', '!=', 1)->where('unmatch_flg', '!=', 1)->first();
        foreach ($message_cs as $message_c) {
            if ($message_c->message_count != 0 || $message_c->message_count == 'match') {
                $message_count++;
            }
        }
        $tumis = Tumi::where('user_id', $current_user->id)->orderBy("created_at", "desc")->get();
        $goal_class = new Goal;
        $tumi_id = $request->tumi_id;
        DB::delete('delete from goals where id = ' . $goal_id);
        DB::delete('delete from tumis where goal_id = ' . $goal_id);
        $goal_message = "積み上げ目標を削除しました";
        $param = ['current_user' => $current_user, 'users' => $users, 'message_count' => $message_count, 'top_message' => '', 'match_flg' => $match_flg, 'goals' => $goals, 'goal_message' => $goal_message];
        return view('top.index', $param);
    }
}
