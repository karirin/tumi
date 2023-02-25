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
use App\Goal;
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
        $tumi_message = "";
        $goal_class = new Goal;
        $param = ['tumis' => $tumis, 'goal_id' => $goal_id, 'tumi_message' => $tumi_message, 'goal_class' => $goal_class, 'current_user' => $current_user];
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
        $goal_class = new Goal();
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
        $tumi_message = "投稿しました";
        $param = ['current_user' => $current_user, 'users' => $users, 'skills' => $skills, 'licences' => $licences, 'message_count' => $message_count, 'top_message' => '', 'match_flg' => $match_flg, 'tumis' => $tumis, 'goal_id' => $request->goal_id, 'tumi_message' => $tumi_message, 'goal_class' => $goal_class];
        return view('tumi.tumi', $param);
    }

    public function index(Request $request)
    {
        $current_user = Auth::user();
        $tumis = Tumi::where('user_id', $current_user->id)->orderBy("created_at", "desc")->get();
        return view('markdown', ['tumis' => $tumis]);
    }

    public function delete(Request $request)
    {
        $current_user = Auth::user();
        $current_user_id = $current_user->id;
        $goal_id = $request->goal_id;
        $tumis = Tumi::where('user_id', $current_user->id)->orderBy("created_at", "desc")->get();
        $tumi_message = "投稿を削除しました";
        $goal_class = new Goal;
        $tumi_id = $request->tumi_id;
        DB::delete('delete from tumis where id = ' . $tumi_id);
        $param = ['tumis' => $tumis, 'goal_id' => $goal_id, 'tumi_message' => $tumi_message, 'goal_class' => $goal_class, 'current_user' => $current_user];
        return view('tumi.tumi', $param);
    }

    public function edit(Request $request)
    {
        $current_user = Auth::user();
        $users = User::get();
        $tumi_id = $request->edit_tumi_id;
        $tumi_text = $request->edit_text;
        $tumi_tittle = $request->edit_tittle;
        if ($request->file('image_name') != '') {
            $file_name = $request->file('image_name')->getClientOriginalName();
            $request->file('image_name')->storeAs('public/sample', $file_name);
            DB::update('update tumis set text = "' . $tumi_text . '",tittle = "' . $tumi_tittle . '",image = "storage/sample/' . $file_name . '" where id = ' . $tumi_id);
        } else {
            DB::update('update tumis set text = "' . $tumi_text . '",tittle = "' . $tumi_tittle . '",image = "' . $request->edit_image . '" where id = ' . $tumi_id);
        }
        $tumis = Tumi::where('user_id', $current_user->id)->orderBy("created_at", "desc")->get();
        $tumi_message = "投稿を編集しました";
        $goal_class = new Goal();
        $param = ['current_user' => $current_user, 'users' => $users, 'tumis' => $tumis, 'goal_id' => $request->goal_id, 'tumi_message' => $tumi_message, 'goal_class' => $goal_class];
        return view('tumi.tumi', $param);
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
}
