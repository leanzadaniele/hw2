<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel='shortcut icon' href='img/favicon.png' type='image/png'>
    <link rel="stylesheet" href="{{ url('storage/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('storage/css/signup_in.css') }}">
    <script src="{{ url('storage/js/su_validation.js') }}" defer></script>
    
</head>
<body>

    <div class="topline"></div>

    <section>
        <div class="logo">
            <img src="{{ url('storage/img/logo_small.png') }}">
        </div>

        <h1>Register</h1>
        <div class="form">

            <form method="POST" action="/signup/save">
                <div id="errors" class="hidden">
                    <p id="errMsg" class="err"></p>
                </div>
                <label><input type="text" name="username" id="user" placeholder="username"></label>
                <label><input type="text" name="name" id="name" placeholder="nome"></label>
                <label><input type="text" name="surname" id="surname" placeholder="cognome"></label>
                <label><input type="email" name="email" id="email" placeholder="example@example.com"></label>
                <label><input type="password" name="password" id="pass" placeholder="password"></label>
                <label><input type="password" name="passcheck" id="passCheck" placeholder="conferma password"></label>
                <p><a href="/login">già registrato?</a> &nbsp; <input type="submit" value="registrati"></p>
                @csrf
            </form>
        </div>
        <div class="copyright">
            Copyright &copy; 2022 - all rights reserved
        </div>
    </section>

</body>
</html>