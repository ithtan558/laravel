<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="<?= asset('public/css/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="<?= asset('public/css/bootstrap/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= asset('public/css/admin/sb-admin-2.css') ?>">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
</head>
<body id="app-layout">
    <div class="form-login container">
        @yield('content')
    </div>

    <!-- JavaScripts -->
    <script src="<?= asset('public/css/jquery/jquery.min.js') ?>"></script>
    <script src="<?= asset('public/js/bootstrap/bootstrap.min.js') ?>"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>