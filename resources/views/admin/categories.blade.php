@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row">
            @include('admin.partials._adminpanel')
            <div class="col-lg-1">
            </div>
            <div class="container">
                <div class="col-lg-5">
                    <div id="categories">
                        <categories
                                :categories="{{ $categories }}"
                                api-token="{{ Auth::user()->api_token }}"
                                delete-endpoint="{{ app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('categories.delete') }}"
                                save-endpoint="{{ app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('categories.store') }}"
                        ></categories>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer-scripts')
    <script src="{{ URL::asset('/assets/js/categories.js') }}"></script>
@endpush