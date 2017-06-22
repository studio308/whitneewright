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
                <events-page
                :events="{{ $events }}">
                </events-page>
            </div>
        </div>
    </div>
@endsection

@push('footer-scripts')
<script src="{{ URL::asset('/assets/js/eventspage.js') }}"></script>
@endpush