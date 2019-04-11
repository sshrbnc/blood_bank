<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ 'Blood Bank Management System' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Actor">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand">
    <link rel="stylesheet" href="assets/css/Article-Clean.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="assets/css/Header-Dark.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/OcOrato---Login-form.css">
    <link rel="stylesheet" href="assets/css/Pretty-Search-Form.css">
    <link rel="stylesheet" href="assets/css/Projects-Clean.css">
    <link rel="stylesheet" href="assets/css/Projects-Horizontal.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Team-Boxed.css">
    <link rel="stylesheet" href="assets/css/Navbar.css">
    <link rel="stylesheet" href="assets/css/User-Article.css">
    <link rel="stylesheet" href="assets/css/Status.css">
    <link rel="stylesheet" href="assets/css/Transaction.css">
    <link rel="shortcut icon" type="image/png" href="assets/img/prc_logo.png"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>

    <nav class="navbar navbar-dark navbar-expand-md navigation-clean-search" style="background-color: #c30000;">
        <div class="container1"><img class="prc_logo" src="assets/img/prc_logo.png"><a class="navbar-brand" href="/">&nbsp;Philippine Red Cross - Iloilo Chapter</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
           


            <div class="col-lg-20 text-right" style="margin-top: -50px" >
                @if (Auth::check())
                    <div style="color:white; width: 200%;">
                        Logged in as {{ Auth::user()->name }}
                        <form action="{{ route('auth.logout') }}" method="post">
                            {{ csrf_field() }}
                            <input type="submit" value="Logout" class="btn btn-success">
                        </form>

                        {!! Form::open(['method'=>'POST','url'=>'/login'])  !!}
                            <input type="submit" value="Admin Panel" class="btn btn-primary">
                        {!! Form::close() !!}

                    </div>
                @endif

                 <div>
        </div>

            </div>
        </div>


        <form action="/transaction" method="POST" role="search">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" class="form-control" name="q" placeholder="Search users"> 
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>

   
    </nav>
<div style="background-color:rgb(238,244,247);">
<div class="container2" style="margin: 0;">
    <div class="row" style="margin:0px;">

        @yield('main')


    </div>
</div>

</div>

<div class="projects-clean"></div>
<div class="footer-dark" style="background-color:rgb(0,0,0);">
    <footer>
        <div class="container3">
            <div class="row">
                <div class="col-sm-6 col-md-3 item">
                    <h5>Important Links:</h5>
                    <ul>
                        <li><a href="#">Ambulance</a></li>
                        <li><a href="http://www.infoblood.org">Blood Bank</a></li>
                        <li><a href="#">Dhaka Medical</a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-3 item">
                    <h5>Others: </h5>
                    <ul>
                        <li><a href="#">Company</a></li>
                        <li><a href="#">Team</a></li>
                        <li><a href="#">Careers</a></li>
                    </ul>
                </div>
                <div class="col-md-6 item text">
                    <h5>About Us:</h5>
                    <p>
                        At present, the Philippine Red Cross provides six major services: Blood Services, Disaster Management Services, Safety Services, Health Services, Social Services, Red Cross Youth and Volunteer Services. All of them embody the fundamental principles of the International Red Cross and Red Crescent Movement – humanity, impartiality, neutrality, independence, voluntary service, unity and universality. These values guide and inspire all Red Cross staff and volunteers, to whom being a Red Crosser is more than just a philosophy but a way of life.
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <div class="col item social">
        <a href="https://github.com/MinhazulKabir"><i class="icon ion-social-github-outline"></i></a>
        <a href="https://bd.linkedin.com/in/minhazulkabir"><i class="icon ion-social-linkedin-outline"></i></a>
        <a href="https://www.facebook.com/MinhazulKabir"><i class="icon ion-social-facebook-outline"></i></a>
        <a href="https://twitter.com/mminhazulkabir"><i class="icon ion-social-twitter-outline"></i></a>
        <a href="https://www.instagram.com/minhazulkabir/"><i class="icon ion-social-instagram-outline"></i></a>
    </div>
    <p class="copyright" style="font-size:15px;padding-top:10px;">All Rigths Reserved © <?php echo date("Y"); ?>  </p>

</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>
</body>

</html>