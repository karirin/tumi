@extends('layouts.top')
@section('title', 'pair code')
@section('header')
@parent
@endsection
@section('content')
<h2 class="user_detail_message1">メール認証が完了しました</h2>
<h2 class="user_detail_message2" style="display: none;">ユーザー詳細情報の登録をお願いします</h2>

<form method="post" class="edit_detail_top_form" style="display:none;" action="{{ asset('user/edit_detail') }}" enctype="multipart/form-data">
    @csrf
    <h2 class="edit_detail_top_tittle" style="text-align: center;display:none;">新規登録</h2>
    <div class="row edit_detail_top" style="margin-left: 30%;height: 66%;display: flex;">
        <div class="col-3">
            <div class="user_age">
                <p class="tag_tittle">年齢</p>
                <input class="edit_age form-control" type="number" name="age" style="width: 35%;display: inline-block;margin-right: 0.5rem;"><span class="sai">歳</span>
                <div class="error_age_form" style="height: 8px;text-align:left;">
                    <span class="user_age_error" style="display:none;color: #dc3545;">年齢を入力してください</span>
                </div>
            </div>
            <div class="user_address" style="margin-top: 0.5rem;">
                <p class="tag_tittle" style="display: inline-block;">住所</p>
                <select name="address" class="form-control edit_address">
                    <option value="">--選択してください--</option>
                    <option value="北海道">北海道</option>
                    <option value="青森県">青森県</option>
                    <option value="岩手県">岩手県</option>
                    <option value="宮城県">宮城県</option>
                    <option value="秋田県">秋田県</option>
                    <option value="山形県">山形県</option>
                    <option value="福島県">福島県</option>
                    <option value="茨城県">茨城県</option>
                    <option value="栃木県">栃木県</option>
                    <option value="群馬県">群馬県</option>
                    <option value="埼玉県">埼玉県</option>
                    <option value="千葉県">千葉県</option>
                    <option value="東京都">東京都</option>
                    <option value="神奈川県">神奈川県</option>
                    <option value="新潟県">新潟県</option>
                    <option value="富山県">富山県</option>
                    <option value="石川県">石川県</option>
                    <option value="福井県">福井県</option>
                    <option value="山梨県">山梨県</option>
                    <option value="長野県">長野県</option>
                    <option value="岐阜県">岐阜県</option>
                    <option value="静岡県">静岡県</option>
                    <option value="愛知県">愛知県</option>
                    <option value="三重県">三重県</option>
                    <option value="滋賀県">滋賀県</option>
                    <option value="京都府">京都府</option>
                    <option value="大阪府">大阪府</option>
                    <option value="兵庫県">兵庫県</option>
                    <option value="奈良県">奈良県</option>
                    <option value="和歌山県">和歌山県</option>
                    <option value="鳥取県">鳥取県</option>
                    <option value="島根県">島根県</option>
                    <option value="岡山県">岡山県</option>
                    <option value="広島県">広島県</option>
                    <option value="山口県">山口県</option>
                    <option value="徳島県">徳島県</option>
                    <option value="香川県">香川県</option>
                    <option value="愛媛県">愛媛県</option>
                    <option value="高知県">高知県</option>
                    <option value="福岡県">福岡県</option>
                    <option value="佐賀県">佐賀県</option>
                    <option value="長崎県">長崎県</option>
                    <option value="熊本県">熊本県</option>
                    <option value="大分県">大分県</option>
                    <option value="宮崎県">宮崎県</option>
                    <option value="鹿児島県">鹿児島県</option>
                    <option value="沖縄県">沖縄県</option>
                </select>
                <div class="error_address_form" style="height: 8px;text-align:left;">
                    <span class="user_address_error" style="display:none;color: #dc3545;">住所を入力してください</span>
                </div>
            </div>
            <div class="user_occupation" style="margin-top: 0.5rem;">
                <p class="tag_tittle" style="display: inline-block;">職種</p>
                <select name="occupation" class="form-control edit_occupation" style="width: auto;">
                    <option value="">--選択してください--</option>
                    <option value="ネットワークエンジニア">ネットワークエンジニア</option>
                    <option value="Webエンジニア">Webエンジニア</option>
                    <option value="フロントエンドエンジニア">フロントエンドエンジニア</option>
                    <option value="インフラエンジニア">インフラエンジニア</option>
                    <option value="サーバーエンジニア">サーバーエンジニア</option>
                    <option value="データベースエンジニア">データベースエンジニア</option>
                    <option value="IoTエンジニア">IoTエンジニア</option>
                    <option value="制御・組み込みエンジニア">制御・組み込みエンジニア</option>
                    <option value="テストエンジニア">テストエンジニア</option>
                    <option value="その他">その他</option>
                </select>
                <div class="error_occupation_form" style="height: 14px;text-align:left;">
                    <span class="user_occupation_error" style="display:none;color: #dc3545;">職種を入力してください</span>
                </div>
            </div>
            <p class="tag_tittle">スキル</p>
            <div id="myprofile_skill">
                <input type="hidden" name="myprofile_skills" id="myprofile_skills">
                <input type="hidden" name="skill_count" id="myprofile_skill_count">
                <input type="hidden" name="myskills">
            </div>
            <input placeholder="PHP　JavaScript" name="skills" id="skill_myprofile_input" style="display:block;width: 125%;" class="ui-autocomplete-input" autocomplete="off">
            <p class="tag_tittle">取得資格</p>
            <div id="licence">
                <input type="hidden" name="myprofile_licences" id="myprofile_licences">
                <input type="hidden" name="licence_count" id="licence_count">
                <input type="hidden" name="mylicences">
            </div>
            <input placeholder="ITパスポート　基本情報技術者" name="name" id="licence_input" style="display: block;width: 125%;" />
        </div>
        <div class="col-7" style="margin-left: 4rem;">
            <div class="skill_smartphone" style="display:none;">
                <input type="text" class="skill_select" name="skills" placeholder="PHP JavaScript">
                <div class="image_size" style="font-size:0.9rem;">※スキル単位で半角スペースを空けてください</div>
            </div>
            <div class="licence_smartphone" style="display:none;">
                <input type="text" class="licence_select" name="licences" placeholder="ITパスポート 基本情報技術者試験">
                <div class="image_size" style="font-size:0.9rem;">※資格単位で半角スペースを空けてください</div>
            </div>
            <div class="my_profile">
                <p class="tag_tittle">自己紹介</p>
                <textarea placeholder="100文字以内" class="edit_profile form-control" style="width: auto;" type="text" name="user_profile">{{$profile}}</textarea>
                <div class="error_profile_form" style="height: 8px;text-align:left;width: 13rem;">
                    <span class="user_profile_error" style="display:none;color: #dc3545;">自己紹介を入力してください</span>
                </div>
            </div>
            <div class="background">
                <p class="tag_tittle">職歴</p>
                <textarea placeholder="2018年～2022年　
株式会社XXX 
・SEとして自社サービスの運用・保守を担当 
・チームリーダーの経験も有り" class="edit_workhistory form-control" style="height: 40%;" type="text" name="user_workhistory"></textarea>
                <div class="error_workhistory">
                    <span class="user_workhistory_error" style="color:rgb(220, 53, 69);display: none;">100文字以内で入力してください</span>
                </div>
            </div>
        </div>
        <div class="flex_btn margin_top edit_detail_btn" style="margin: 2rem 11% 2rem;width: 35%;display:none;">
            <input style="width: 90px;" class="btn btn-outline-dark edit_detail_top_btn" type="button" onclick="history.back()" value="戻る">
            <input style="width: 90px;" class="btn btn-outline-info edit_done edit_detail_top_btn" type="submit" value="登録">
        </div>
    </div>
    <input type="hidden" name="name" value="{{$name}}">
    <input type="hidden" name="email" value="{{$email}}">
    <input type="hidden" name="password" value="{{$password}}">
    <input type="hidden" name="hash_password" value="{{$hash_password}}">
    <input type="hidden" name="image" value="{{$image}}">
    <input type="hidden" id="licence_narrow" value>
    <input type="hidden" id="licence_input_narrow" value>
    <input type="hidden" id="licence_narrow" value>
    <input type="hidden" id="licence_count_narrow" value>
    <input type="hidden" id="myprofile_skill_count" value>
    <input type="hidden" id="skill_count_narrow" value>
    <input type="hidden" id="skill_narrow" value>
    <input type="hidden" id="skills_narrow" value>
</form>
</div>
@endsection
@section('footer')
@parent
<script>
    setTimeout(function() {
        $(".user_detail_message1").css("display", "none");
        $(".user_detail_message2").fadeIn();
    }, 3000);
    setTimeout(function() {
        $(".edit_detail_top_form").fadeIn();
        $(".edit_detail_top_tittle").fadeIn();
        $(".edit_detail_btn").fadeIn().css("display", "flex");
        $(".user_detail_message2").css("display", "none");
    }, 5000);
</script>
@endsection