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
            <img class="img-responsive" src="{{URL::asset( $work->primaryMedia())}}">
            <p>{{ $work->price }}</p>
        </div>
        <div class="row">
            <div class="thumbnail">
                <p>@foreach($work->otherMedia() as $media)
                        <img src="{{ URL::asset( $media->path ) }}" width="304" height="236">
                @endforeach</p>
            </div>
        </div>
    </div>

@endsection