

<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="{{ url('/') }}">Whitnee Wright</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                <li class="hidden">
                    <a class="page-scroll" href="#page-top"></a>
                </li>
                <li>
                    <a href="{{ url('/about') }}">About the Artist</a>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Work<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        @foreach($categories as $category)
                            <li><a href="{{ route('categories.'.$category->alias) }}">{{ $category->alias }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a class="page-scroll" href="{{ url('/contact') }}">Contact</a>
                </li>
                <li>
                    <a class="page-scroll" href="#">Events</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- jQuery -->
<script src="{{ URL::asset('js/jquery.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

<!-- Scrolling Nav JavaScript -->
<script src="{{ URL::asset('js/jquery.easing.min.js') }}"></script>
<script src="{{ URL::asset('js/scrolling-nav.js') }}"></script>

