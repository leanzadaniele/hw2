<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NEW POST</title>
    <link rel='shortcut icon' href='img/favicon.png' type='image/png'>
    <link rel="stylesheet" href="{{ url('storage/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('storage/css/post.css') }}">
</head>
<body>
    <div class="navigator">
        <a href="{{ route('admin_home') }}"><i class="bi bi-arrow-left-circle"></i>&nbsp;back</a>
        <h1>Nuovo post</h1>
        <a href="{{ route('home') }}"><img src="{{ url('storage/img/logo_small.png') }}"></a>
    </div>
    <form method="post" action="{{ route('save_post') }}">
        <textarea name="content" placeholder="nuovo post..."></textarea>
        <label><input type="submit" value="pubblica">&nbsp;</label>
        @csrf
    </form>
    <footer>
        FoamCloud &copy; 2022 - Daniele Leanza
    </footer>
</body>
</html>
