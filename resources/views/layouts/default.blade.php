<!DOCTYPE html>
<html lang="en">

<head>
   @include('layouts.head')
</head>

<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    @include('layouts.header')

            <!-- Intro Section -->
    <section id="intro" class="intro-section">
        @yield('content')
    </section>

    <footer class="row">
        @include('layouts.footer')
    </footer>
</body>