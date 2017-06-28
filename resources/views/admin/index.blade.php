@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row">
            @include('admin.partials._adminpanel')
            <div class="col-lg-5 col-lg-offset-1">
                <h2>Admin</h2>
                <hr/>
                <p>
                    This is the landing page for the admin. Using the navigation bar to the left, you can add works,
                    events, and add or delete categories. If you wish you edit or delete any work or event, go to that
                    works page or to the event page and proceed to make any changes you wish.
                    <br><br>
                    This is a work in process project.
                </p>
            </div>
        </div>
    </div>
@endsection