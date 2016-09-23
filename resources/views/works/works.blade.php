@extends('layouts.default')
@section('content')
@foreach($works as $work)
    <ul>
        <li>
            {{ $work->title }}
        </li>
    </ul>
    @endforeach

    @endsection