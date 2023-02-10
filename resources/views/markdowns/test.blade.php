@extends('layouts.top')
@section('title', 'tumitumi')
@section('header')
@parent
@endsection
@section('content')
@foreach ($tumis as $tumi)
<h1 class="text-muted">{{$tumi->text}}</h1>
<div class="text-muted">
{!! $tumi->text !!}
</div>
@endforeach
        @endsection
        @section('footer')
        @parent
        @endsection