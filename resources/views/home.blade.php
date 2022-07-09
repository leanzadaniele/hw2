<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel='shortcut icon' href='img/favicon.png' type='image/png'>
    <link rel="stylesheet" href="{{ url('storage/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('storage/css/home.css') }}">
    <script src="{{ url('storage/js/postFetch.js') }}" defer></script>
</head>
<header>
    <div class="leftHeader">
    <input type='hidden' id='username' value="{{ $user->username }}">
        <a href="{{ route('home') }}"><img src="{{ url('storage/img/logo_small.png') }}"></a>
        @if($user->isAdmin())
        <!-- Mettere Admin_Home -->
            <a class='home' href="{{ route('admin_home') }}"><i class='bi bi-shield-lock'></i></a>
        @endif
        <a class="home" href="{{ route('profile') }}"><i class="bi bi-person-circle"></i></a>
    </div>

    <a class='logout_button' href="{{ route('logout') }}"><i class='bi bi-box-arrow-right'></i> logout</a>
</header>
    <div class="hero">
        <article>
            <div class="bacheca">
                <h1>Bacheca</h1>
            </div>
        
        </article>
    </div>
<footer>
    FoamCloud &copy; 2022 - Daniele Leanza
</footer>
</html>