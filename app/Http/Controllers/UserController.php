<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\HelloRequest;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Person;
use App\User;
<<<<<<< HEAD
use App\Tumi;
use App\Goal;
=======
use Illuminate\Support\Facades\Mail;
use App\AuthMail;
use App\TokenService;
>>>>>>> 29e5689a371c8c7fa23ec3daed1644895d121451
use App\Match;
use App\Token;
use App\Models\Message;
use App\Models\Message_relation;
//use Config\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use DateTime;

class UserController extends Controller
{
    private $method_action_key = 'method_action_key';

    public function add(Request $request)
    {
        $add_message = '';
        return view('user.add', ['add_message' => $add_message]);
    }

    protected function create(Request $request)
    {
        $this->validate($request, User::$rules);
        $user_flg = User::where('name', $request->name)->first();

        if ($user_flg != '') {
            $add_message = 'すでに存在するユーザー名です';
            return view('user.add', ['add_message' => $add_message]);
        }

        $now = new DateTime();
        $now->format("Y-m-d H:i:s");
        //有効期限を計算(30分とした)
        $expire_at = $now->modify('+60 minutes');

        $token = new TokenService();
        //トークンを生成
        $token = uniqid('', true);

        $form = [
            'token' => $token,
            'email' => $request->email,
            'expire_at' => $expire_at,
        ];

        DB::table('tokens')->insert($form);

        //4. メールを送信
        $email = $request->email;

        if ($request->file('image') != '') {
            $file_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/sample', $file_name);
            $param = [
                'name' => $request->name,
                'password' => $request->password,
                'email' => $request->email,
                'hash_password' => Hash::make($request->password),
                'image' => 'storage/sample/' . $file_name,
                'token' => $token,
            ];
        } else {
<<<<<<< HEAD
            if ($request->file('image') != '') {
                $file_name = $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public/sample', $file_name);
                $form = [
                    'name' => $request->name,
                    'password' => Hash::make($request->password),
                    'image' => 'storage/sample/' . $file_name,
                    'profile' => ''
                ];
            } else {
                $form = [
                    'name' => $request->name,
                    'password' => Hash::make($request->password),
                    'image' => '',
                    'profile' => ''
                ];
            }
            $action = session()->get($this->method_action_key);
            $is_reload = ($action == '');
            if (is_null($action)) {
                DB::table('users')->insert($form);
            } else if ($is_reload) { }
            $current_user_id = $current_user->id;
            $goals = Goal::where('user_id', $current_user->id)->get();
            $top_message = $request->name . 'さんがログインしました';
            $param = ['goals' => $goals, 'top_message' => $top_message];
            if (Auth::attempt([
                'name' => $request->name,
                'password' => $request->password
            ])) {
                return view('top.index', $param);
            }
=======
            $param = [
                'name' => $request->name,
                'password' => $request->password,
                'email' => $request->email,
                'hash_password' => Hash::make($request->password),
                'image' => 'storage/sample/noimage.jpg',
                'token' => $token,
            ];
        }

        DB::table('preusers')->insert($param);

        //メールに記載する認証用URlを組み立てている(認証用ページURL+トークン)。
        $url = request()->getSchemeAndHttpHost() . "/user/register?token=" . $token;

        Mail::to($email)->send(new AuthMail($url));

        //メール送信完了画面へリダイレクト
        return view('join', ['email' => $email]);

        // if ($user_flg != '') {
        //     $add_message = 'すでに存在するユーザー名です';
        //     return view('user.add', ['add_message' => $add_message]);
        // } else {
        //     if ($request->file('image') != '') {
        //         $file_name = $request->file('image')->getClientOriginalName();
        //         $request->file('image')->storeAs('public/sample', $file_name);
        //         $param = [
        //             'name' => $request->name,
        //             'password' => $request->password,
        //             'email' => $request->email,
        //             'hash_password' => Hash::make($request->password),
        //             'image' => 'storage/sample/' . $file_name,
        //             'profile' => '',
        //         ];
        //     } else {
        //         $param = [
        //             'name' => $request->name,
        //             'password' => $request->password,
        //             'email' => $request->email,
        //             'hash_password' => Hash::make($request->password),
        //             'image' => 'storage/sample/noimage.jpg',
        //             'profile' => '',
        //         ];
        //     }
        //     return view('user.edit_detail', $param);
        // }
    }

    protected function register(Request $request)
    {
        $token = $request->token;

        $tokenService = new TokenService();

        $userService = new User();

        $data = Token::where([
            'token' => $token
        ])->first();

        //6~8. トークン検索からチェックまでを行う
        $authResult = $tokenService->matchToken($token);

        if ($authResult == "OK") {
            //9. 認証処理(ユーザテーブルのメールアドレス認証フラグ立てる)
            //$userService->changeEmailFlag($data->email);

            //$email = $tokenService->getEmailByToken($token);
            //$id = $userService->getIdByEmail($data->$email);

            //10. ログイン状態にしてユーザトップページへリダイレクト
            // $request->session()->put('logind', 'true');
            // $request->session()->put('id', $id);
            //return redirect('/user/'.$id);
            // $user = User::where([
            //     'token' => $token
            // ])->first();

            $user = DB::table('preusers')->where([
                'token' => $token
            ])->first();

            //log::debug($user);

            $param = [
                'name' => $user->name,
                'password' => $user->password,
                'email' => $user->email,
                'hash_password' => $user->hash_password,
                'image' => $user->image,
                'profile' => '',
            ];

            return view('user.edit_detail', $param);
        } else if ($authResult == "ALREADY") {
            //10. エラーメッセージとともにトップページへリダイレクト
            return redirect('/')->with('message', 'このメールアドレスはすでに認証されています。');
        } else if ($authResult == "WRONG") {
            //10. エラーメッセージとともにトップページへリダイレクト
            return redirect('/')->with('message', 'メールアドレス認証に失敗しました。URLを確認してもう一度やり直してください。');
        } else if ($authResult == "EXPIRE") {
            //10. エラーメッセージとともにトップページへリダイレクト
            return redirect('/')->with('message', '認証URLの有効期限が切れています。最初からもう一度やり直してください。');
        } else {
            //一応
            return redirect('/');
>>>>>>> 29e5689a371c8c7fa23ec3daed1644895d121451
        }
    }

    protected function edit_detail(Request $request)
    {
        $form = [
            'name' => $request->name,
            'password' => $request->hash_password,
            'email' => $request->email,
            'image' => $request->image,
            'age' => $request->age,
            'address' => $request->address,
            'profile' => $request->user_profile,
            'occupation' => $request->occupation,
            'skill' => $request->myprofile_skills,
            'licence' => $request->myprofile_licences,
            'workhistory' => $request->user_workhistory,
        ];
        //3. ユーザデータを保存
        //DB::table('users')->insert($form);

        $action = session()->get($this->method_action_key);
        $is_reload = ($action == '');
        if (is_null($action)) {
            DB::table('users')->insert($form);
        } else if ($is_reload) { }
        if (Auth::attempt([
            'name' => $request->name,
            'password' => $request->password
        ])) {
            $current_user = Auth::user();
            $users = User::get();
            $skills = explode(" ", $current_user->skill);
            $licences = explode(" ", $current_user->licence);
            $message = new Message_relation;
            $message_cs = Message_relation::where('user_id', $current_user->id)->get();
            $message_count = 0;
            foreach ($message_cs as $message_c) {
                if ($message_c->message_count != 0 || $message_c->message_count == 'match') {
                    $message_count++;
                }
            }
            $top_message = $request->name . 'さんがログインしました';
            $match_flg = DB::table('users')->where('matched_user_id', $current_user->id)->where('match_flg', '!=', 1)->where('unmatch_flg', '!=', 1)->first();
            $param = ['current_user' => $current_user, 'users' => $users, 'skills' => $skills, 'licences' => $licences, 'message_count' => $message_count, 'message' => $message, 'top_message' => $top_message, 'match_flg' => $match_flg];
            return view('user.add_match', $param);
        }
    }

    public function skip(Request $request)
    {
        $form = [
            'name' => $request->name,
            'password' => $request->hash_password,
            'image' => $request->image,
        ];
        DB::table('users')->insert($form);
        if (Auth::attempt([
            'name' => $request->name,
            'password' => $request->hash_password
        ])) {
            $current_user = Auth::user();
            $users = User::get();
            $skills = explode(" ", $current_user->skill);
            $licences = explode(" ", $current_user->licence);
            $message = new Message_relation;
            $message_cs = Message_relation::where('user_id', $current_user->id)->get();
            $message_count = 0;
            foreach ($message_cs as $message_c) {
                if ($message_c->message_count != 0 || $message_c->message_count == 'match') {
                    $message_count++;
                }
            }
            $top_message = $request->name . 'さんがログインしました';
            $match_flg = DB::table('matches')->where('matched_user_id', $current_user->id)->where('match_flg', '!=', 1)->where('unmatch_flg', '!=', 1)->first();
            $param = ['current_user' => $current_user, 'users' => $users, 'skills' => $skills, 'licences' => $licences, 'message_count' => $message_count, 'message' => $message, 'top_message' => $top_message, 'match_flg' => $match_flg];
            return view('top.index', $param);
        }
    }

    public function login(Request $request)
    {
        $message = null;
        $param = ['message' => $message];
        return view('user.login', $param);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return $this->loggedOut($request) ?: redirect('/');
    }

    public function auth(Request $request)
    {
        $this->validate($request, User::$rules);
        $name = $request->name;
        $password = $request->password;
        if (Auth::attempt([
            'name' => $name,
            'password' => $password
        ])) {
            $msg = 'ログインしました。（' . Auth::user()->name . '）';
        } else {
            $message = 'ユーザー名とパスワードが一致しません';
            return view('user.login', ['message' => $message]);
        }
        $current_user = Auth::user();
        $users = User::get();
        $skills = explode(" ", $current_user->skill);
        $licences = explode(" ", $current_user->licence);
        $message = new Message_relation;
        $message_cs = Message_relation::where('user_id', $current_user->id)->get();
        $message_count = 0;
        foreach ($message_cs as $message_c) {
            if ($message_c->message_count != 0 || $message_c->message_count == 'match') {
                $message_count++;
            }
        }
        $top_message = $request->name . 'さんがログインしました';
        $current_user_id = $current_user->id;
        $goals = Goal::where('user_id', $current_user->id)->get();
        $match_flg = DB::table('matches')->where('matched_user_id', $current_user->id)->where('match_flg', '!=', 1)->where('unmatch_flg', '!=', 1)->first();
        $param = [
            'current_user' => $current_user, 'users' => $users, 'skills' => $skills, 'licences' => $licences, 'message_count' => $message_count, 'message' => $message, 'top_message' => $top_message, 'match_flg' => $match_flg, 'goals' => $goals
        ];
        return view('top.index', $param);
    }

    public function auth2(Request $request)
    {
        $this->validate($request, User::$rules);
        $name = $request->name;
        $password = $request->password;
        $user = DB::table('preusers')->where([
            'name' => $request->name
        ])->first();
        $user_id = $request->user_id;
        $matched_user = DB::table('users')->where([
            'id' => $user_id
        ])->first();
        if (Auth::attempt([
            'name' => $name,
            'password' => $user->password
        ])) {
            $msg = 'ログインしました。（' . Auth::user()->name . '）';
        } else {
            $message = 'ユーザー名とパスワードが一致しません';
            return view('user.login', ['message' => $message]);
        }
        $current_user = Auth::user();
        $users = User::get();
        $message_relations =  Message_relation::select([
            '*',
        ])
            ->from('message_relations as m')
            ->join('users as u', function ($join) {
                $join->on('m.destination_user_id', '=', 'u.id');
            })
            ->where('m.user_id', '=', $current_user->id)
            ->get();
        $message_relation =  new Message_relation;
        $skills = explode(" ", $current_user->skill);
        $licences = explode(" ", $current_user->licence);
        $message_cs = Message_relation::where('user_id', $current_user->id)->get();
        $message_count = 0;
        foreach ($message_cs as $message_c) {
            if ($message_c->message_count != 0 || $message_c->message_count == 'match') {
                $message_count++;
            }
        }
        $message_class = new Message;
        $match_flg = Match::where('matched_user_id', $current_user->id)->where('match_flg', '!=', 1)->where('unmatch_flg', '!=', 1)->first();
        $mail_message = $matched_user->name . "さんとマッチングしました！";
        $param = ['current_user' => $current_user, 'users' => $users, 'message_relations' => $message_relations, 'skills' => $skills, 'licences' => $licences, 'message_count' => $message_count, 'message_class' => $message_class, 'match_flg' => $match_flg, 'mail_message' => $mail_message];
        return view('message.message_top', $param);
    }

    protected function loggedOut(Request $request)
    {
        //
    }

    protected function guard()
    {
        return Auth::guard();
    }

    public function test_login(Request $request)
    {
        $name = $request->name;
        $password = $request->password;
        if (Auth::attempt([
            'name' => $name,
            'password' => $password
        ])) {
            $msg = 'ログインしました。（' . Auth::user()->name . '）';
        } else {
            $message = 'お試しログインに失敗しました';
            return view('user.login', ['message' => $message]);
        }
        $current_user = Auth::user();
        $current_user_id = $current_user->id;
        $goals = Goal::where('user_id', $current_user->id)->get();
        $users = User::get();
        $tumis = Tumi::get();
        $skills = explode(" ", $current_user->skill);
        $licences = explode(" ", $current_user->licence);
        $message_cs = Message_relation::where('user_id', $current_user->id)->get();
        $message_count = 0;
        foreach ($message_cs as $message_c) {
            if ($message_c->message_count != 0 || $message_c->message_count == 'match') {
                $message_count++;
            }
        }
        $top_message = $request->name . 'さんがログインしました';
        $match_flg = DB::table('matches')->where('matched_user_id', $current_user->id)->where('match_flg', '!=', 1)->where('unmatch_flg', '!=', 1)->first();
        $param = ['current_user' => $current_user, 'users' => $users, 'skills' => $skills, 'licences' => $licences, 'message_count' => $message_count, 'top_message' => $top_message, 'match_flg' => $match_flg, 'goals' => $goals];
        return view('top.index', $param);
    }

    public function profile(Request $request)
    {
        $current_user = Auth::user();
        $users = User::get();
        $skills = explode(" ", $current_user->skill);
        $licences = explode(" ", $current_user->licence);
        $message_cs = Message_relation::where('user_id', $current_user->id)->get();
        $message_count = 0;
        $tumis = Tumi::get();
        foreach ($message_cs as $message_c) {
            if ($message_c->message_count != 0 || $message_c->message_count == 'match') {
                $message_count++;
            }
        }
        $match_flg = DB::table('matches')->where('matched_user_id', $current_user->id)->where('match_flg', '!=', 1)->where('unmatch_flg', '!=', 1)->first();
        $param = ['current_user' => $current_user, 'users' => $users, 'skills' => $skills, 'licences' => $licences, 'message_count' => $message_count, 'match_flg' => $match_flg, 'tumis' => $tumis];
        return view('/user/profile', $param);
    }

    public function edit(Request $request)
    {
        $current_user = Auth::user();
        $current_user->name = $request->user_name;
        if ($request->file('image_name') != '') {
            $file_name = $request->file('image_name')->getClientOriginalName();
            $request->file('image_name')->storeAs('public/sample', $file_name);
            $current_user->image = 'storage/sample/' . $file_name;
        }
        $current_user->age = $request->user_age;
        $current_user->occupation = $request->occupation;
        $current_user->address = $request->address;
        $current_user->skill = $request->myprofile_skills;
        $current_user->licence = $request->myprofile_licences;
        $current_user->workhistory = $request->user_workhistory;
        $current_user->profile = $request->user_profile;
        $current_user->save(); // https://yama-weblog.com/using-fill-method-to-be-a-simple-code/
        return redirect('/user/profile');
    }

    public function add_match(Request $request)
    {
        $current_user = Auth::user();
        $users = User::get();
        $param = ['users' => $users, 'current_user' => $current_user];
        return view('user.add_match', $param);
    }

    // public function edit(Request $request)
    // {
    //     $current_user = Auth::user();
    //     if ($request->current_name != $request->user_name) {
    //         $current_user->name = $request->user_name;
    //     }
    //     if ($request->current_name != $request->user_name_narrow) {
    //         $current_user->name = $request->user_name_narrow;
    //     }
    //     if ($request->current_age != $request->user_age) {
    //         $current_user->age = $request->user_age;
    //     }
    //     if ($request->current_age != $request->user_age_narrow) {
    //         $current_user->age = $request->user_age_narrow;
    //     }
    //     if ($request->current_occupation != $request->occupation) {
    //         $current_user->occupation = $request->occupation;
    //     }
    //     if ($request->current_occupation != $request->occupation_narrow) {
    //         $current_user->occupation = $request->occupation_narrow;
    //     }
    //     if ($request->current_address != $request->address) {
    //         $current_user->address = $request->address;
    //     }
    //     if ($request->current_address != $request->address_narrow) {
    //         $current_user->address = $request->address_narrow;
    //     }
    //     if ($request->current_skill != $request->myprofile_skills) {
    //         $current_user->skill = $request->myprofile_skills;
    //     }
    //     if ($request->current_skill != $request->skills) {
    //         $current_user->skill = $request->skills;
    //     }
    //     log::debug("||||||||");
    //     log::debug($request->current_licence);
    //     log::debug($request->myprofile_licences);
    //     log::debug("||||||||");
    //     if ($request->current_licence != $request->myprofile_licences) {
    //         log::debug("test1");
    //         $current_user->licence = $request->myprofile_licences;
    //     }
    //     log::debug("||||||||");
    //     log::debug($request->current_licence);
    //     log::debug($request->myprofile_licences_narrow);
    //     log::debug("||||||||");
    //     if ($request->current_licence != $request->myprofile_licences_narrow) {
    //         log::debug("test2");
    //         $current_user->licence = $request->myprofile_licences_narrow;
    //     }
    //     if ($request->current_workhistory != $request->user_workhistory) {
    //         $current_user->workhistory = $request->user_workhistory;
    //     }
    //     if ($request->current_workhistory != $request->user_workhistory_narrow) {
    //         $current_user->workhistory = $request->user_workhistory_narrow;
    //     }
    //     log::debug($request);
    //     log::debug($current_user);
    //     $current_user->save(); // https://yama-weblog.com/using-fill-method-to-be-a-simple-code/
    //     return redirect('/user/profile');
    // }

    public function ajax_flg(Request $request)
    {
        $current_user = Auth::user();
        $users = User::get();
        DB::update('update users set top_flg = 1 where id = ' . $current_user->id . '');
    }

    public function ajax_m_flg(Request $request)
    {
        $current_user = Auth::user();
        $users = User::get();
        DB::update('update users set match_flg = 1 where id = ' . $current_user->id . '');
    }

    public function chart(Request $request)
    {
        $tumis = Tumi::get();
        log::debug($tumis);
        return view('chart', ['tumis' => $tumis]);
    }
}
