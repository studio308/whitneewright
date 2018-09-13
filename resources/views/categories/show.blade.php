@extends('layouts.default')
@section('content')
    <style>
        #images {
            /* Prevent vertical gaps */
            line-height: 1;

            -webkit-column-count: 5;
            -webkit-column-gap:   0;
            -moz-column-count:    5;
            -moz-column-gap:      2px;
            column-count:         5;
            column-gap:           0;
        }
        #images img {
            /* Just in case there are inline attributes */
            width: 100% !important;
            height: auto !important;
        }
        @media (max-width: 1200px) {
            #images {
                -moz-column-count:    4;
                -webkit-column-count: 4;
                column-count:         4;
            }
        }
        @media (max-width: 1000px) {
            #images {
                -moz-column-count:    3;
                -webkit-column-count: 3;
                column-count:         3;
            }
        }
        @media (max-width: 800px) {
            #images {
                -moz-column-count:    2;
                -webkit-column-count: 2;
                column-count:         2;
            }
        }
        @media (max-width: 400px) {
            #images {
                -moz-column-count:    1;
                -webkit-column-count: 1;
                column-count:         1;
            }
        }
    </style>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="pull-left" style="margin-left: 10px;">{{ $category->alias }}</h1>
        </div>
    </div>
    <div class="row" id="images">
        @if($category->works && $category->works->count())
            @foreach($category->works as $work)
            <div>
                <a href="{{ !empty($work->alias) ? route('works.show', $work->alias) : route('works.show-id', $work->id) }}">
                    <img class="" src="{{URL::asset( $work->primaryMedia() )}}">
                </a>
                    <div class="row">
                        {{ $work->title }}
                    </div>
            </div>
            @endforeach
        @else
            <p>There are no {{ $category->name }} art. Please check back later</p>
        @endif
    </div>
</div>
@endsection