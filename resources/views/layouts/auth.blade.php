<!DOCTYPE html>

<html lang="en">

<head>
    @include('partials.head')
    <link rel="stylesheet" href="assets/css/login.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"> -->
    <link href="/css/app.css" rel="stylesheet">

</head>

<body class="page-header-fixed" style="background-color: #d82247">
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