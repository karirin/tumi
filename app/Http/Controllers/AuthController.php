<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Message_relation;
use App\Match;
use App\Models\SocialUser;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Socialite;

class AuthController extends Controller
{
    public function login()
    {
        return Socialite::with('Twitter')->redirect();
    }

    public function callback()
    {
        $providerUser = Socialite::driver('Twitter')->user();

        // 既に存在するユーザーかを確認
        $socialUser = SocialUser::where('provider_user_id', $providerUser->id)->first();

        if ($socialUser) {
            // 既存のユーザーはログインしてトップページへ
            Auth::login($socialUser->user, true);
            return redirect('/');
        }

        // 新しいユーザーを作成
        $current_user = new User();
        $current_user->unique_id = $providerUser->nickname;
        $current_user->name = $providerUser->name;
        $current_user->image = 'https://twitars.now.sh/' . $providerUser->id . '/original';
        $current_user->profile = $providerUser->user['description'];
        $socialUser = new SocialUser();
        $socialUser->provider_user_id = $providerUser->id;

        DB::transaction(function () use ($current_user, $socialUser) {
            $current_user->save();
            $current_user->socialUsers()->save($socialUser);
        });

        Auth::login($current_user, true);
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
        $match_flg = Match::where('matched_user_id', $current_user->id)->where('match_flg', '!=', 1)->where('unmatch_flg', '!=', 1)->first();

        $param = ['current_user' => $current_user, 'profile' => $current_user->profile, 'name' => $current_user->name, 'password' => '', 'hash_password' => '', 'image' => $current_user->image, 'users' => $users, 'skills' => $skills, 'licences' => $licences, 'message_count' => $message_count, 'message' => $message, 'top_message' => '', 'match_flg' => $match_flg];
        return view('user.edit_detail', $param);
    }
}
