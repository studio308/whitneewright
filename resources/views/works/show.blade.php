@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="container">
            <div class="pull-left">
                Back to
                    <a href="{{ route('categories.'.$work->category->alias) }}"> {{ $work->category->alias }}</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <h1>{{ $work->title }}</h1>
            <img class="img-responsive" src="{{URL::asset( $work->medias->pluck('path')->first())}}">
            <p>{{ $work->price }}</p>
        </div>
    </div>

@endsection