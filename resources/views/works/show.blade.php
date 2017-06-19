@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row">
            <div id="work">
                <works-page
                        back-to-category="{{ route('categories.'.$work->category->alias) }}"
                        :work="{{ $work }}"
                ></works-page>
            </div>
            {{--<h1>{{ $work->title }}</h1>--}}
            {{--<img class="img-responsive" src="{{URL::asset( $work->primaryMedia())}}">--}}
            {{--<p>{{ $work->price }}</p>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="thumbnail">--}}
                {{--<p>@foreach($work->otherMedia() as $media)--}}
                        {{--<img src="{{ URL::asset( $media->path ) }}" width="304" height="236">--}}
                {{--@endforeach</p>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>

@endsection
@push('footer-scripts')
<script src="{{ URL::asset('/assets/js/workspage.js') }}"></script>
@endpush