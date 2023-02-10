@section('profile')
<div class="modal_prof"></div>
<div class="slide_prof">
    <a class="prof_close" href="#">
        <p><i class="fas fa-angle-right"></i></p>
    </a>
    <form method="post" action="{{ asset('user/edit') }}" enctype="multipart/form-data">
        @csrf
        <div class="profile">
            <div class="edit_profile_img">
                <label>
                    <div class="fa-image_range">
                        <i class="far fa-image"></i>
                    </div>
                    <input type="file" name="image_name" id="edit_profile_img_narrower" accept="image/*" multiple>
                </label>
                <img name="profile_image" class="editing_profile_img" src="{{asset($current_user->getData_image())}}">
                <label>
                    <i class="far fa-times-circle profile_clear"></i>
                    <input type="button" id="profile_clear">
                </label>
            </div>
            <img src="{{asset($current_user->getData_image())}}" class="mypage">
            <h3 class="profile_name_narrower">{{$current_user->getData_name()}}</h3>
            <input type="hidden" name="id" class="user_id" value="{{$current_user->getData_id()}}">
            <input type="file" name="image" class="image" value="{{asset($current_user->getData_image())}}"
                style="display:none;">
            <div class="tag">
                <div class="tags">
                    <div class="tag_skill">
                        <p class="tag_tittle">スキル</p>
                        <p class="tag_tittle">スキル</p>
                        @php
                        $i = 0;
                        @endphp
                        @foreach ($skills as $skill)
                        @if (3 <= $i) <span id="child-span_narrow" class="skill_tag extra" style="display: none;">
                            {{$skill}}</span>
                            @else
                            <span id="child-span_narrow" class="skill_tag">{{$skill}}</span>
                            @endif
                            @php
                            $i++
                            @endphp
                            @endforeach
                            <i class="fas fa-plus skill_btn_narrow"></i>
                    </div>
                    <div class="tag_licence">
                        <p class="tag_tittle">取得資格</p>
                        @php
                        $j = 0;
                        @endphp
                        @foreach ($licences as $licence)
                        @if (3 <= $j) <span id="child-span_narrow" class="licence_tag extra" style="display: none;">
                            {{$licence}}</span>
                            @else
                            <span id="child-span_narrow" class="licence_tag">{{$licence}}</span>
                            @endif
                            @php
                            $j++
                            @endphp
                            @endforeach
                            <i class="fas fa-plus licence_btn_narrow"></i>
                    </div>
                </div>
                <div class="background">
                    <p class="tag_tittle">職歴</p>
                    <p class="user_workhistory">{{$current_user->getData_workhistory()}}</p>
                </div>
            </div>
            <div class="myprofile_btn">
                <button class="btn btn btn-outline-dark profile_edit_btn" type="button" name="follow">プロフィール編集</button>
            </div>
        </div>
        <div class="form" style="margin:0;">
            <p class="tag_tittle" style="text-align:left;">スキル</p>
            <div id="skill_narrow">
                @php
                $k = 0;
                @endphp
                @foreach ($skills as $skill)
                @if (3 <= $k) <span id="child-span_narrow" class="skill_tag extra" style="display: none;">
                    {{$skill}}<label><input type="button" style="display:none;"><i
                            class="far  fa-times-circle skill_narrow"></i></label></span>
                    @else
                    <span id="child-span_narrow" class="skill_tag">{{$skill}}<label><input type="button"
                                style="display:none;"><i class="far  fa-times-circle skill_narrow"></i></label>
                    </span>
                    @endif
                    @php
                    $k++
                    @endphp
                    @endforeach
                    <i class="fas fa-plus skill_btn_narrow"></i>
            </div>
            <input placeholder="skill Stack" name="skills" id="skill_input_narrow" />
            <input type="hidden" name="skills" id="skills_narrow">
            <input type="hidden" name="skill_count" id="skill_count_narrow">
            <input type="hidden" name="myskills" value="{{$current_user->getData_skill()}}">
            <div id="licence">
                <p class="tag_tittle">取得資格</p>
                <div id="licence_narrow">
                    @php
                    $l = 0;
                    @endphp
                    @foreach ($licences as $licence)
                    @if (3 <= $l) <span id="child-span_narrow" class="licence_tag extra" style="display: none;">
                        {{$licence}}<label><input type="button" style="display:none;"><i
                                class="far fa-times-circle licence"></i></label></span>
                        @else
                        <span id="child-span_narrow" class="licence_tag">{{$licence}}<label><input type="button"
                                    style="display:none;"><i class="far fa-times-circle licence"></i></label></span>
                        @endif
                        @php
                        $l++
                        @endphp
                        @endforeach
                </div>
                <i class="fas fa-plus licence_btn_narrow"></i>
            </div>
            <input placeholder="licence Stack" name="name" id="licence_input_narrow" />
            <input type="hidden" name="licences" id="licences_narrow">
            <input type="hidden" name="licence_count" id="licence_count_narrow">
            <input type="hidden" name="mylicences" value={{$current_user->getData_licence()}}>
            <div class="background">
                <p class="tag_tittle">職歴</p>
                <p class="workhistory_narrow">{{$current_user->getData_workhistory()}}</p>
                <div class="error_workhistory" style="display: none;">
                    <span style="color:rgb(220, 53, 69);">100文字以内で入力してください</span>
                </div>
            </div>
            <div class="btn_flex">
                <button class="btn btn-outline-info profile_close" type="button">閉じる</button>
                <button class="btn btn-outline-dark profile_narrow_close" type="button"
                    style="width: 100%;">閉じる</button>
                <input type="submit" class="btn btn-outline-dark edit_done" value="編集完了">
            </div>
        </div>

</div>
</form>
</div>
@endsection