@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row">
            @include('admin.partials._adminpanel')
            <div class="container">
                <div class="col-lg-7">
                    <div id="event">
                        <add-event
                                api-token="{{ Auth::user()->api_token }}"
                                save-endpoint="{{ app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('events.store') }}"
                                save-image-endpoint="{{ app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('works.storeImage') }}"
                        ></add-event>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer-scripts')
    <script src="{{ URL::asset('/assets/js/addevent.js') }}"></script>
<script src="//unpkg.com/vue/dist/vue.js"></script>
<script src="//unpkg.com/element-ui@1.3.5/lib/index.js"></script>
@endpush