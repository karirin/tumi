<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Match;
use App\Models\Message_relation;

class LineLoginController extends Controller
{
    // Lineログイン画面を表示
    public function lineLogin()
    {
        $state = Str::random(32);
        $nonce  = Str::random(32);

        $uri = "https://access.line.me/oauth2/v2.1/authorize?";
        $response_type = "response_type=code";
        $client_id = "&client_id=" . config('services.line.client_id');
        $redirect_uri = "&redirect_uri=" . config('services.line.redirect');
        $state_uri = "&state=" . $state;
        $scope = "&scope=openid%20profile";
        $prompt = "&prompt=consent";
        $nonce_uri = "&nonce=";

        $uri = $uri . $response_type . $client_id . $redirect_uri . $state_uri . $scope . $prompt . $nonce_uri;

        return redirect($uri);
    }

    // アクセストークン取得
    public function getAccessToken($req)
    {

        $headers = ['Content-Type: application/x-www-form-urlencoded'];
        $post_data = array(
            'grant_type'    => 'authorization_code',
            'code'          => $req['code'],
            'redirect_uri'  => config('services.line.redirect'),
            'client_id'     =>  config('services.line.client_id'),
            'client_secret' => config('services.line.client_secret'),
        );
        $url = 'https://api.line.me/oauth2/v2.1/token';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post_data));

        $res = curl_exec($curl);
        curl_close($curl);
        $json = json_decode($res);
        $accessToken = $json->access_token;

        return $accessToken;
    }

    // プロフィール取得
    public function getProfile($at)
    {

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $at));
        curl_setopt($curl, CURLOPT_URL, 'https://api.line.me/v2/profile');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $res = curl_exec($curl);
        curl_close($curl);

        $json = json_decode($res);

        return $json;
    }

    // ログイン後のページ表示
    public function callback(Request $request)
    {
        $accessToken = $this->getAccessToken($request);
        //dd($accessToken);
        $profile = $this->getProfile($accessToken);
        // ユーザー情報あるか確認
        //dd($profile);
        $user = User::where('line_id', $profile->userId)->first();

        // あったらログイン
        if ($user) {
            Auth::login($user);
            return redirect('/');

            // なければ登録してからログイン
        } else {
            $user = new User();
            $user->provider = 'line';
            $user->line_id = $profile->userId;
            $user->image = $profile->pictureUrl;
            $user->name = $profile->displayName;
            $user->social_flg = 1;
            $user->save();
            Auth::login($user);

            $param = [
                'name' => $profile->displayName,
                'password' => $profile->userId,
                'hash_password' => Hash::make($profile->userId),
                'image' => $profile->pictureUrl
            ];

            DB::table('preusers')->insert($param);

            // $user = User::where('email', $gUser->email)->first();
            $user = DB::table('users')->where([
                'line_id' => $profile->userId
            ])->first();
            // Auth::login($user, true);
            $users = User::get();
            $skills = explode(" ", $user->skill);
            $licences = explode(" ", $user->licence);
            $message = new Message_relation;
            $message_cs = Message_relation::where('user_id', $user->id)->get();
            $message_count = 0;
            //$email = $googleUser->email;
            foreach ($message_cs as $message_c) {
                if ($message_c->message_count != 0 || $message_c->message_match == 'match') {
                    $message_count++;
                }
            }
            //$match_flg = Match::where('matched_user_id', $user->id)->where('match_flg', '!=', 1)->where('unmatch_flg', '!=', 1)->first();

            $param = ['current_user' => $user, 'profile' => $user->profile, 'name' => $user->name, 'password' => '', 'hash_password' => '', 'image' => $user->image, 'users' => $users, 'skills' => $skills, 'licences' => $licences, 'message_count' => $message_count, 'message' => $message, 'top_message' => '', 'line_id' => $user->line_id];
            return view('user.edit_detail_line', $param);
        }
    }
}
