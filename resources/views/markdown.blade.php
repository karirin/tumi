@extends('layouts.top')
@section('title', 'tumitumi')
@section('header')
@parent
@endsection
@section('content')
@foreach ($tumis as $tumi)
<div class="text-muted">
{!! $tumi->text !!}
</div>
@endforeach
        @endsection
        @section('footer')
        @parent
        @endsection