<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notifiable;
use App\Models\SocialUser;
use Socialite;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $rules = array(
        'name' => 'required',
        'password' => 'required'
    );

    public function socialUsers()
    {
        return $this->hasMany(SocialUser::class);
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
        $user = new User();
        $user->unique_id = $providerUser->nickname;
        $user->name = $providerUser->name;
        $user->avatar = $providerUser->user['profile_image_url_https'];
        $user->bio = $providerUser->user['description'];

        $socialUser = new SocialUser();
        $socialUser->provider_user_id = $providerUser->id;

        DB::transaction(function () use ($user, $socialUser) {
            $user->save();
            $user->socialUsers()->save($socialUser);
        });

        Auth::login($user, true);
        return redirect('user/add_match');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function check_user($name, $password)
    {
        $user_flg = DB::select('select * from users where name = ' . $name . ' and password = ' . $password);
        return count($user_flg);
    }

    public function check_match($user_id, $current_user_id)
    {
        $match_flg = DB::select('select user_id from matches where user_id = ' . $current_user_id . ' and matched_user_id = ' . $user_id);
        return count($match_flg);
    }

    public function check_matchs($user_id, $current_user_id)
    {
        $matchs_flg = DB::select('select * from matches where (user_id = ' . $current_user_id . ' and matched_user_id = ' . $user_id . ') or (user_id = ' . $user_id  . ' and matched_user_id = ' . $current_user_id . ')');
        return count($matchs_flg);
    }

    public function check_unmatch($user_id, $current_user_id)
    {
        $unmatchs_flg = DB::select('select * from matches where user_id = ' . $current_user_id . ' and matched_user_id = ' . $user_id . ' and unmatch_flg = 1');
        return count($unmatchs_flg);
    }

    public function check_match_current_user($current_user_id)
    {
        $current_user_matchcount = DB::select('select * from matches where user_id = ' . $current_user_id . ' and unmatch_flg IS NULL');
        return count($current_user_matchcount);
    }

    public function check_match_user($current_user_id)
    {
        $user_matchcount = DB::select('select * from matches where matched_user_id = ' . $current_user_id . ' and unmatch_flg IS NULL');
        return count($user_matchcount);
    }
}
