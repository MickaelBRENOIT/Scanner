<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <!-- allow to use accents llll-->

    <!-- allow to use accents -->
    <meta charset="utf-8">

    <!-- Basic SEO Optimization -->
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- allow compatibility with IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- allow compatibility with small devices like tablets and phones -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- title of the website -->
    <title>Port Scanner</title>

    <!-- icon of the website -->
    <link rel="shortcut icon" href="">

    <!-- Fonts : need to be load before any others css files (Default Font "Roboto") -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">

    <!-- Bootstratp CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css.map">
	

</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">ScanYourPC</a>
            
            <ul class="navbar-nav mr-auto">
                <?php if(isset($_SESSION) && isset($_SESSION['loggedin']) && $_SESSION['role'] == 1) { ?>
                <li class="nav-item">
                  <a class="nav-link" href="indexadmin.php">Manage Users</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="port_list.php">XML</a>
                </li>
                <?php } ?>
				<?php if(isset($_SESSION) && isset($_SESSION['loggedin'])) { ?>
				<li class="nav-item">
                  <a class="nav-link" href="yourscans.php">Check your scans</a>
                </li>
                <?php } ?>
            </ul>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                   <?php if(!isset($_SESSION) || !isset($_SESSION['loggedin'])) { ?>
                    <button class="btn btn-outline-primary my-2 my-sm-0 mr-2" type="button" data-toggle="modal" data-target="#SignUpModal">Sign Up</button>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="button" data-toggle="modal" data-target="#SignInModal">Sign In</button>
                    <?php } else { ?>
                    <p style="color: white;" class="pt-2 my-sm-0 mr-3">Hello, <?php if(isset($_SESSION['username'])) { echo $_SESSION["username"]; } ?></p>
					<p style="display:none" id="userName"><?php if(isset($_SESSION['username'])) { echo $_SESSION["username"]; } ?></p>

                    <button class="btn btn-outline-danger my-2 my-sm-0" type="button" id="processLogout">Sign Out</button>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </header>