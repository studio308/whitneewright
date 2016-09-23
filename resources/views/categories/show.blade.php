@extends('layouts.default')
@section('content')
 <div class="container">
     <div class="pull-left">
        <h1>{{ $category->name }}</h1>
     </div>
</div>

<div class="container">
    <div class="row">
        @if($category->works && $category->works->count())
            @foreach($category->works as $work)
            <div class="col-lg-3 col-md-4 col-xs-6">
                <a href="{{ route('works.show', $work->alias) }}">
                    <img class="img-responsive" src="{{URL::asset( $work->medias->where('primary', 1)->pluck('path')->first())}}">
                    {{ $work->title }}
                </a>
            </div>
            @endforeach
        @else
            <p>There are no {{ $category->title }}. Please check back later</p>
        @endif
    </div>
</div>
@endsection