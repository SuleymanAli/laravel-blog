<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">

    @yield('stylesheets')

    <title>Laravel Blog @yield('title')</title> <!-- CHANGE THIS TITLE FOR EACH PAGE -->
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="/">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ Request::is('/') ? "active" : null }}">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item {{ Request::is('blog') ? " active " : null }}">
                <a class="nav-link" href="/blog">Blog</a>
            </li>
            <li class="nav-item {{ Request::is('about') ? "active" : null }}">
                <a class="nav-link" href="/about">About</a>
            </li>
            <li class="nav-item {{ Request::is('contact') ? "active" : null }}">
                <a class="nav-link" href="/contact">Contact</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            @if(Auth::check())
            <li class="nav-item dropdown mr-2">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                Hi, {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('posts.index') }}">Posts</a>
                <a class="dropdown-item" href="{{ route('category.index') }}">Categories</a>
                <a class="dropdown-item" href="{{ route('tags.index') }}">Tags</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}">Log Out</a>
            </div>
            @else
            <a href="{{ route('login') }}" class="btn btn-primary mr-md-4">Login</a>
            @endif
        </li>
    </ul>                
</div>
</nav>
        {{-- {{ Auth::check() ? 'You`re Logged In' : 'You`re Not Logged In' }} --}}
        {{-- <main role="main">
        
            <!-- Main jumbotron for a primary marketing message or call to action -->
            <div class="jumbotron">
                <div class="container">
                    <h1 class="display-3">Hello, world!</h1>
                    <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron
                        and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
                    <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
                </div>
            </div>
        
            <div class="container">
                <!-- Example row of columns -->
                <div class="row">
                    <div class="col-md-4">
                        <h2>Heading</h2>
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris
                            condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod.
                            Donec sed odio dui. </p>
                        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                    </div>
                    <div class="col-md-4">
                        <h2>Heading</h2>
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris
                            condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod.
                            Donec sed odio dui. </p>
                        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                    </div>
                    <div class="col-md-4">
                        <h2>Heading</h2>
                        <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta
                            felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum
                            massa justo sit amet risus.</p>
                        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                    </div>
                </div>
        
                <hr>
        
            </div>
            <!-- /container -->
        
        </main> --}}

        <div class="container mt-4">
            @include('partials._messages')

            @yield('content')
        </div>
        
        <footer class="container">
            <p>&copy; Company 2017-2018</p>
        </footer>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
        @yield('scripts')
    </body>

    </html>