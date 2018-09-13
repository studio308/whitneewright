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
            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5">
                <a href="{{ !empty($work->alias) ? route('works.show', $work->alias) : route('works.show-id', $work->id) }}">
                    <img class="img-responsive" src="{{URL::asset( $work->primaryMedia() )}}">
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