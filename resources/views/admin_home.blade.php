<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home {{ $user->id }}</title>
    <link rel='shortcut icon' href='img/favicon.png' type='image/png'>
    <link rel="stylesheet" href="{{ url('storage/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('storage/css/admin.css') }}">
    <script src="{{ url('storage/js/admin.js') }}" defer></script>
</head>
<body>

    <header>
        <div class="leftHeader">
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
        <div class="LeftBar">
            <form method="post" action="{{ route('save_new_admin') }}">
                <!-- Trasforma la variabile (dove dentro c'è l'html) da stringa a html -->
                {!! $error !!} 
                <input type="email" name="newAdminEmail" placeholder="new admin's email">
                <div>
                    <input type="submit" value="add">
                    <input type="reset" value="reset">
                </div>
                @csrf
            </form>

            <a href="{{ route('new_post') }}">
                <div class="newPost">NEW POST</div>
            </a>

        </div>

        <div class="RightBar">

            <!--
            <div class="post">
                ciao
                <div class="delete">
                    <i class="bi bi-x-square"></i>
                </div>
            </div>
            <div class="noPosts">
                no posts
            </div>
            -->

        </div>


    </article>
        <div class="deleteMe">
            <a href="{{ route('remove_admin') }}"><div id="removeAdmin">Rimuovi privilegi admin</div></a>
        </div>

</div>
    <footer>
        FoamCloud &copy; 2022 - Daniele Leanza
    </footer>
</body>
</html>
