

<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        <title>@yield('title')</title>
        
        <style>
                main{
                    padding: 50px 0;
                }
                .fl{
                    float: left;
                }
                #edit{
                    margin-left:  0px;
                    margin-right:  5px;
                }
                #express{
                    margin-right: 2px;

                }

        </style>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


        <link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" />
        <script src="vendor/select2/dist/js/select2.min.js"></script>

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <!-- Bootstrap -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
            <!-- search -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <!-- Sidebar -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>        




<body class="w3-light-grey w3-content" style="max-width:1720px;">


<!-- Sidebar/menu -->
    
<nav class="w3-sidebar w3-collapse w3-sand w3-animate-left" style="z-index:3;width:300px;" id="mySidebar">
    
    <div class="w3-container">
        <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
            <i class="fa fa-remove" style="font-size:24px"></i>
        </a>

        <br><br><br><br>
        <center>
            <img src="/Admin-icon.png" style="width:50%;" class="w3-round"><br><br>
            <h5><b>ADMIN PAGE</b></h5>
            <p class="w3-text-brown">สวัสดี {{Auth::user()->name}}</p>
        </center>
    </div>
  
    <div class="w3-bar-block">

        
        <a href="/admin/home" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-home fa-fw w3-margin-right"></i>หน้าแรก</a> 

        <a href="/admin/showall" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-camera fa-fw w3-margin-right"></i>ข้อมูลกล้องทั้งหมด</a> 

        <a href="/admin/report" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-exclamation-triangle fa-fw w3-margin-right"></i>รายการใหม่</a> 

        <a href="/admin/camera/" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-history fa-fw w3-margin-right"></i>ประวัติการทำงาน</a> 
        
        <a href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" class="w3-bar-item w3-button w3-padding">
        <i class="fa fa-sign-out fa-fw w3-margin-right"></i>LOGOUT
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
        </form>

    </div>
</nav>
</body>






<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>


<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

<!-- Header  -->
<header id="portfolio">

    <center><img class="img-responsive" src="/header.png" width="2000" height="50"></center> 
    



    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container">


    </div>
</header>





        <div class="w3-container">
            @yield('content')
        </div>

      


     


<!-- End Section -->
<div class="w3-dark-grey w3-center w3-padding-24">Copyright © 2019 CCTV Maintenance Managing System .<br> Southern Information Technology Co., Ltd.</div>

<!-- End page content -->
</div>

<script>
// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}


$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});


</script>
</html> 

