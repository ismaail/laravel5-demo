<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <title>Laravel 5.1 Demo</title>
    <link rel="stylesheet" href="/lib/bootstrap-css/css/bootstrap.min.css"/>
</head>
<body>
    <header class="main-header container-fluid">
        <div class="logo col-sm-8"><a href="/"><h1>Book Keeper</h1></a></div>
        <div class="user-box col-sm-4 pull-right">
        @if (Auth::user())
            <span>{{ Auth::user()->username }}</span> | <a href="/user/logout">Logout</a>
        @else
            <a href="/user/register">Sign-up</a> |
            <a href="/user/login">Login</a>
        @endif
        </div>
    </header>
    <div class="container">
        @if (count($errors))
            <div class="alert alert-danger">
                <strong>Error:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield("content")
    </div>
</body>
</html>