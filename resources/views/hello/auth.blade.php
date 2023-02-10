@extends('layouts.top')
@section('title', 'ユーザー認証')
@section('menubar')
@parent
ユーザー認証ページ
@endsection
@section('content')

<table>
    <form action="/user/login" method="post">
        @csrf
        <tr>
            <th>name: </th>
            <td><input type="text" name="name"></td>
        </tr>
        <tr>
            <th>pass: </th>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <th></th>
            <td><input type="submit" value="send"></td>
        </tr>
    </form>
</table>
@endsection
@section('footer')
copyright 2020 tuyano.
@endsection