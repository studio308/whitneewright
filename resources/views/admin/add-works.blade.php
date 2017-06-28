@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row">
            @include('admin.partials._adminpanel')
            <div class="col-lg-7">
                <div id="works">
                    <works
                            save-endpoint="{{ app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('works.store') }}"
                            save-image-endpoint="{{ app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('works.storeImage') }}"
                            delete-image-endpoint="{{ app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('works.deleteImage') }}"
                            :categories="{{ $categories }}"
                    ></works>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer-scripts')
<script src="{{ URL::asset('/assets/js/works.js') }}"></script>
@endpush