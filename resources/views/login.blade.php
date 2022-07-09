<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel='shortcut icon' href='img/favicon.png' type='image/png'>
    <link rel="stylesheet" href="{{ url('storage/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('storage/css/signup_in.css') }}">
    <script src="js/su_validation.js" defer></script>
</head>
<body>

    <div class="topline"></div>

    <section>
        <div class="logo">
            <img src="{{ url('storage/img/logo_small.png') }}">
        </div>

        <h1>Login</h1>
        <div class="form">

            <form method="POST" action="/login/controllaLogin">
                <div id="errors" class="hidden">
                    <p id="errMsg" class="err"></p>
                </div>
                <label><input type="email" name="email" placeholder="example@example.com" id="email"></label>
                <label for="email"></label>
                <label><input type="password" name="password" placeholder="password" id="password"></label>
                <p><a href="/signup">nuovo utente?</a> &nbsp; <input type="submit" value="accedi"></p>
                {{session('error')}}
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                @csrf
            </form>
        </div>
        <div class="copyright">
            Copyright &copy; 2022 - all rights reserved
        </div>
    </section>

</body>
</html>