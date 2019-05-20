<!DOCTYPE html>

<html lang="en">

<head>
    @include('partials.head')
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" type="text/css" href="assets/css/Login-footer.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"> -->
    <link href="/css/app.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="assets/img/prc_logo.png"/>
</head>

<body class="page-header-fixed">
    <div class="container-fluid">
        @yield('content')
    </div>

    <div class="scroll-to-top"
         style="display: none;">
        <i class="fa fa-arrow-up"></i>
    </div>


    <script src="/js/app.js"></script>
    @include('partials.javascripts')
</body>
</html>