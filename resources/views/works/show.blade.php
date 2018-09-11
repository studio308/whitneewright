@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row">
            <div id="work">
                @if(Auth::user())
                <works-page
                        api-token="{{ Auth::user()->api_token }}"
                        back-to-category="{{ route('categories.'.$work->category->alias) }}"
                        save-endpoint="{{ app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('works.update', $work->id) }}"
                        delete-endpoint="{{ app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('works.delete', $work->id) }}"
                        :work="{{ $work }}"
                        :categories="{{ $categories }}"
                        :user="{{ Auth::user() }}"
                ></works-page>
                    @else
                    <works-page
                            back-to-category="{{ route('categories.'.$work->category->alias) }}"
                            :work="{{ $work }}"
                    ></works-page>
                @endif
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