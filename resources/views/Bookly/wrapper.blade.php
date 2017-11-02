<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('title')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bookshelf.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-nav">
        <a class="navbar-brand" href="/">
            <img class="img-fluid mr-1" width="40px" height="40px" src="img/logo.png" alt="logo">
            <span>BookLy</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/') {echo 'active';};?>" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/books') {echo 'active';};?>" href="/books">Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/authors') {echo 'active';};?>" href="/authors">Authors</a>
                </li>
                <div class="dropdown">
                    <button class="btn btn-bookly dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if(Auth::check())
                            {{ Auth::user()->name }}
                        @else
                            Account
                        @endif
                    </button>
                    <div class="dropdown-menu bg-dropdown" aria-labelledby="dropdownMenuButton">
                        @if(Auth::check())
                            <li>
                                <a class="dropdown-item bg-dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @else
                            <a class="dropdown-item bg-dropdown-item" href="#" data-toggle="modal" data-target="#loginModal">Login</a>
                            <a class="dropdown-item bg-dropdown-item" href="#" data-toggle="modal" data-target="#registerModal">Register</a>
                        @endif
                    </div>
                </div>
            </ul>
        </div>
    </nav>

    @yield('content')

<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

<script>
    $( function() {
       $('.toggleBtn').click( function() {
           if ($(this).text()=='Edit'){
               $(this).text('Detail');
               $('.togglemodals').toggleClass('d-none');
           } else {
               $(this).text('Edit');
               $('.togglemodals').toggleClass('d-none');
           }
       });
    });
</script>
</body>
</html>