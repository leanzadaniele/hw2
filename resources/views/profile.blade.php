<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profilo - <?= $user->name ?></title>
    <link rel='shortcut icon' href="{{ url('storage/img/favicon.png') }}" type='image/png'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    
    <link rel='shortcut icon' href='img/favicon.png' type='image/png'>
    <link rel="stylesheet" href="{{ url('storage/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('storage/css/profile.css') }}">

    <script src="{{ url('storage/js/propic.js') }}" defer></script>
    <script src="{{ url('storage/js/profile.js') }}" defer></script>
    <script src="{{ url('storage/js/myComments.js') }}" defer></script>
</head>
<body>
<header>
    <div class="leftHeader">
        <a href="{{ route('home') }}"><img src="{{ url('storage/img/logo_small.png') }}"></a>
        @if($user->isAdmin())
        <!-- Mettere Admin_Home -->
            <a class='home' href="{{ route('home') }}"><i class='bi bi-shield-lock'></i></a>
        @endif
        
        <a class="home" href="home"><i class="bi bi-house-fill"></i></a>
    </div>

    <a class='logout_button' href="{{ route('logout') }}"><i class='bi bi-box-arrow-right'></i> logout</a>
</header>
<article>
    <div class="propic">
        <div class="overlay">
            <i class="bi bi-pencil"></i>
        </div>
        
        <img src="{{ trim($user->propic, '\'') }}" id='propic'>
    </div>

    <h1><?= $user->name ?></h1>
    <p>clicca sulla foto per poterla cambiare</p>

    <div id="container" class="hidden">
        
        <h2>modifica foto profilo:</h2>
        <input type="text" placeholder="es(ferrari, computer...)" id="search">
        <div class="modal">

            <p>cerca immagini</p>
        </div>

        <a id="save">
            salva&nbsp;<i class="bi bi-upload"></i>
        </a>
        <div class="powered">
            powered by <img src="{{ url('storage/img/unsplash.png') }}">
        </div>
    </div>

    <div class="commentsDiv">
        <h2>i miei commenti:</h2>
    </div>

    <div class="deleteMe">
        <a href="deleteMe"><div id="deleteUser">elimina account</div></a>
    </div>

</article>

<footer>
    FoamCloud &copy; 2022 - Daniele Leanza
</footer>
</body>
</html>
