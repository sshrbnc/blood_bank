<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <link rel="stylesheet" href="adminlte/css/skins/skin-blue.css">

    <link rel="stylesheet" type="text/css" href="assets/css/index-page.css"">   

    <link rel="shortcut icon" type="image/png" href="assets/img/prc_logo.png"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

    <link rel="shortcut icon" type="image/png" src="../assets/img/prc_logo.png" style="width: 15px; height: 15px;"/>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<body style="background-color: #d82247">

    <div class="container-fluid">
        <div class="row no-gutters justify-content-center" id="searchPanel" >
            <div id="searchSec" class="col-md-3">
                <div class="row no-gutters">
                   
                    <input type="text" name="searchInput" class="form-control" id="searchInput" placeholder="Input transaction code" style="border-radius: 0px;">

                    <button id="search_trans" class="btn btn-xs"><i id="searchIcon" class="fas fa-search"></i></button>
                    
                </div>
                <div class="">
                    <img id="searchPic" src="assets/img/pic4.jpg">
                </div>
            </div>

            <div class="col-md-4" id="resultPanel">
                <div class="col-md-12" id="logo_row">
                    <img id="logo_rc" src="assets/img/prc_logo.png">
                </div>

                <div id="results" class="col-md-12">
                    
                </div>
                
            </div>
        </div>
        
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script type="text/javascript">
    $(document).ready(function(){
        $("#searchInput").on('keyup',function(){
            $value = $(this).val();
            $.ajax({
                type : 'get',
                url : '{{URL('search')}}',
                data:{'trans':$value},
                success:function(response){
                    $('#results').html(response);
                    console.log(response);
                }
            });
        });
    });
</script>
</body>


</html>