<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Models\Message_relation;
use App\Match;
// use Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Goal;

class GoogleLoginController extends Controller
{
    public function getGoogleAuth()
    {
        return Socialite::driver('google')
            ->redirect();
    }

    public function authGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        // 既に存在するユーザーかを確認
        $check_googleUser = DB::table('users')->where('google_id', $googleUser->getId())->first();
        //dd($check_googleUser);
        $gUser = Socialite::driver('google')->stateless()->user();
        // email が合致するユーザーを取得
        $user = User::where('email', $gUser->email)->first();

        // $disk = Storage::disk('s3');

        // S3にファイルを保存し、保存したファイル名を取得する
        // $fileName = $disk->put('', $googleUser->avatar);

        if ($user) {
            // $current_user = new User();
            // $current_user->google_id = $googleUser->google_id;
            // 既存のユーザーはログインしてトップページへ
            Auth::login($user, true);
            return redirect('/');
        }
        $form = [
            'name' => $googleUser->name,
            'password' => $googleUser->getId(),
            'image' => $googleUser->avatar,
            'email' => $googleUser->email,
            'google_id' => $googleUser->getId(),
            'provider' => 'Google',
            'social_flg' => 1
        ];
        DB::table('users')->insert($form);

        $param = [
            'name' => $googleUser->name,
            'password' => $googleUser->getId(),
            'email' => $googleUser->email,
            'hash_password' => Hash::make($googleUser->getId()),
            'image' => $googleUser->avatar
        ];

        DB::table('preusers')->insert($param);

        $user = User::where('email', $gUser->email)->first();
        // $user = DB::table('users')->where([
        //     'google_id' => $googleUser->id
        // ])->first();
        Auth::login($user, true);
        $current_user = Auth::user();
        $users = User::get();
        $skills = explode(" ", $user->skill);
        $licences = explode(" ", $user->licence);
        $goals = Goal::where('user_id', $current_user->id)->get();
        $message = new Message_relation;
        $message_cs = Message_relation::where('user_id', $user->id)->get();
        $message_count = 0;
        $email = $googleUser->email;
        foreach ($message_cs as $message_c) {
            if ($message_c->message_count != 0 || $message_c->message_match == 'match') {
                $message_count++;
            }
        }
        $google_user_id = $googleUser->id;

        //$match_flg = Match::where('matched_user_id', $user->id)->where('match_flg', '!=', 1)->where('unmatch_flg', '!=', 1)->first();

        $param = ['current_user' => $user, 'profile' => $user->profile, 'name' => $googleUser->name, 'password' => '', 'hash_password' => '', 'image' => $user->image, 'users' => $users, 'skills' => $skills, 'licences' => $licences, 'message_count' => $message_count, 'message' => $message, 'top_message' => '', 'email' => $email, 'google_id' => $googleUser->id, 'goals' => $goals, 'goal_message' => ''];
        log::debug("google");
        return view('top.index', $param);
    }
}
