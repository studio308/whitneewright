@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>About the Artist</h1>
                <hr/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p>
                    Utah based mixed media artist.
                </p>
                <img src="{{URL::asset('image/about.jpg')}}">
            </div>
            </div>
        </div>
    </div>
@endsection
