@extends('layouts.default')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="pull-left" style="margin-left: 10px;">{{ $category->alias }}</h1>
        </div>
    </div>
    <div class="row">
        @if($category->works && $category->works->count())
            @foreach($category->works as $work)
            <div class="col-lg-2 col-md-3 col-sm-5 col-xs-5">
                <a href="{{ $work->alias ? route('works.show', $work->alias) : route('works.show-id', $work->id) }}">
                    <img class="photo-max" src="{{URL::asset( $work->primaryMedia() )}}">
                </a>
                    <div class="row">
                        {{ $work->title }}
                    </div>
            </div>
            @endforeach
        @else
            <p>There are no {{ $category->name }} art. Please check back later</p>
        @endif
    </div>
</div>
@endsection