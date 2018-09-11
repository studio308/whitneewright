@extends('layouts.default')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 style="margin-left: 10px;">Events</h1>
                <hr/>
            </div>
        </div>
        <div class="row">
            <div id="events">
                @if(Auth::user())
                    <events-page
                            api-token="{{ Auth::user()->api_token }}"
                            :events="{{ $events }}"
                            save-endpoint="{{ app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('events.update') }}"
                            delete-endpoint="{{ app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('events.delete') }}"
                            :user="{{ Auth::user() }}">
                    </events-page>
                @else
                    <events-page
                            :events="{{ $events }}">
                    </events-page>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('footer-scripts')
<script src="{{ URL::asset('/assets/js/eventspage.js') }}"></script>
@endpush