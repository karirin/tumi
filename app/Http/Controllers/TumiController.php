<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\HelloRequest;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Person;
use App\User;
use App\Tumi;
use App\Match;
use App\Models\Message_relation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use DateTime;

class TumiController extends Controller
{
    private $method_action_key = 'method_action_key';

    public function disp(Request $request)
    {
        $current_user = Auth::user();
        $current_user_id = $current_user->id;
        $goal_id = $request->goal_id;
        $tumis = Tumi::where('user_id', $current_user->id)->orderBy("created_at", "desc")->get();
        $param = ['tumis' => $tumis, 'goal_id' => $goal_id];
        return view('tumi.tumi', $param);
    }

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
        $date = new DateTime();
        $date->modify('+9 hour');
        $year = $date->format('Y');
        $mouth = $date->format('m');
        $day = $date->format('d');
        $created_at = $date->format('Y-m-d H:i:s');
        if ($request->file('image') != '') {
            $file_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/sample', $file_name);
            $form = [
                'tittle' => $request->tumi_tittle,
                'image' => 'storage/sample/' . $file_name,
                'text' => $request->tumi_text,
                'year' => $year,
                'mouth' => $mouth,
                'day' => $day,
                'user_id' => $current_user->id,
                'goal_id' => $request->goal_id,
                'created_at' => $created_at,
            ];
        } else {
            $date = new DateTime();
            $year = $date->format('Y');
            $mouth = $date->format('m');
            $day = $date->format('d');
            $form = [
                'tittle' => $request->tumi_tittle,
                'image' => 'storage/sample/noimage.jpg',
                'text' => $request->tumi_text,
                'year' => $year,
                'mouth' => $mouth,
                'day' => $day,
                'user_id' => $current_user->id,
                'goal_id' => $request->goal_id,
                'created_at' => $created_at,
            ];
        }
        $action = session()->get($this->method_action_key);
        $is_reload = ($action == '');
        if (is_null($action)) {
            DB::table('tumis')->insert($form);
        }
        $current_user = Auth::user();
        $current_user_id = $current_user->id;
        $tumis = Tumi::where('user_id', $current_user->id)->orderBy("created_at", "desc")->get();
        $param = ['current_user' => $current_user, 'users' => $users, 'skills' => $skills, 'licences' => $licences, 'message_count' => $message_count, 'top_message' => '', 'match_flg' => $match_flg, 'tumis' => $tumis, 'goal_id' => $request->goal_id];
        return view('tumi.tumi', $param);
    }

    public function index(Request $request)
    {
        $current_user = Auth::user();
        $tumis = Tumi::where('user_id', $current_user->id)->orderBy("created_at", "desc")->get();
        return view('markdown', ['tumis' => $tumis]);
    }

    public function ajax_edit_tittle(Request $request)
    {
        $current_user = Auth::user();
        $users = User::get();
        $tumi_id = $request->tumi_id;
        $tumi_tittle = $request->tumi_tittle;
        DB::update('update tumis set tittle = "' . $tumi_tittle . '" where id = ' . $tumi_id);
    }

    public function ajax_edit_text(Request $request)
    {
        $current_user = Auth::user();
        $users = User::get();
        $tumi_id = $request->tumi_id;
        $tumi_text = $request->tumi_text;
        DB::update('update tumis set text = "' . $tumi_text . '" where id = ' . $tumi_id);
    }

    public function ajax_edit_done(Request $request)
    {
        $current_user = Auth::user();
        $users = User::get();
        $tumi_id = $request->tumi_id;
        $tumi_text = $request->tumi_text;
        $tumi_tittle = $request->tumi_tittle;
        DB::update('update tumis set text = "' . $tumi_text . '",tittle = "' . $tumi_tittle . '" where id = ' . $tumi_id);
    }
}
