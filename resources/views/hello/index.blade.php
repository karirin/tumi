@extends('layouts.top')
@section('title', 'pair code')
@section('menubar')
@parent
@endsection
@section('content')
@if (Auth::check())
<p>USER: {{$user->name . ' (' . $user->email . ')'}}</p>
@else
<div class="description">
    <span>
        Test Appは自分のサービスをユーザーに<br>テストしてもらうサービスです。<br>
        他ユーザーのサービスをテストすることもできます。
    </span>
</div>
@endif
@endsection
@section('footer')
@parent
@endsection