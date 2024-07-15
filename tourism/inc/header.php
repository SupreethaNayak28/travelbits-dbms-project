<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="assets/fontawesome/css/all.min.css"> -->
    <link rel="stylesheet" href="assets/fontawesome/css/fontawesome/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script type="text/javascript" src="assets/js/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <title>Tourism</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"  crossorigin="anonymous">
        </head>
<body>
    <!--navbar-->
<nav class="navbar navbar-default">
<div class="container-fluid" style="padding: left 25px;">
<div class="navbar-header">
<a class="navbar-brand" href="index.php"><img src="assets/img/travel-bits-logo.png"></a>
<ul class="menubar">
    <li><a href="index.php">Home</a></li>
    <li><a href="about.php">About</a></li>
    <li><a href="index.php#services">Services</a></li>
     <li><a href="register.php">Register</a></li>
        <li><a href="Login.php">Login</a></li>
</ul>
</div>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
 <ul class="nav navbar-nav navbar-right">
    <?php $url='http://' .$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];?>
    <?php if(isset($_SESSION['tourist_user_id'])){?>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
            aria-haspopup="true" aria-expanded="false">Settings<span class="caret"></span></a>
       <ul class="dropdown-menu">
        <li><a href="tourist_dashboard.php">Tourist</a></li>
        <li><a href="logout.php">Logout</a></li>
       </ul>
        </li>
    <?php } else if (isset($_SESSION['guide_user_id'])){?>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
            aria-haspopup="true" aria-expanded="false">Settings<span class="caret"></span></a>
       <ul class="dropdown-menu">
        <li><a href="guide_dashboard.php">Guide</a></li>
        <li><a href="logout.php">Logout</a></li>
       </ul>
        </li>
    <?php } else if(isset($_SESSION['admin_user_id'])){?>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
            aria-haspopup="true" aria-expanded="false">Settings<span class="caret"></span></a>
       <ul class="dropdown-menu">
        <li><a href="admin_dashboard.php">Admin</a></li>
        <li><a href="logout.php">Logout</a></li>
       </ul>
        </li>
        <?php } else if((!isset($_SESSION['admin_user_id'])
        || !isset($_SESSION['guide_user_id'])
        || !isset($_SESSION['tourist_user_id']))
        && ($url=='http://localhost/tourism/Login.php')){?>
        <?php } else if((!isset($_SESSION['admin_user_id'])
        || !isset($_SESSION['guide_user_id'])
        || !isset($_SESSION['tourist_user_id']))
        && ($url=='http://localhost/tourism/register.php')){?>
        <?php }?>
        </ul>
        </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
 <ul class="nav navbar-nav navbar-right">
    <li class="dropdown" style="display:none;">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings<span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li><a href="admin_dashboard.php">Admin</a></li>
    <li><a href="logout.php">Logout</a></li>
   </ul>
</li>
 </ul>   
</div>
</div>
    </nav>

   