<?php

session_start();
require_once("db.php");
?>
<!DOCTYPE html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PARTIM</title>
<link href="default.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/AdminLTE.min.css">
<link rel="stylesheet" href="css/_all-skins.min.css">
<style>

	#header-wrapper
	{
		
		background-image: url("header.jpg");
		  
	}
</style>
</head>
<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="#">ParTIM</a></h1>
		</div>
		<div id="menu">
			<ul>
				<li><a href="jobs.php"  title="">JOBS</a></li>
				<li><a href="login.php"  title="">LOGIN</a></li>
				<li><a href="sign-up.php"  title="">SIGNUP</a></li>
				<li><a href="#welcome"  title="">ABOUT US</a></li>
			</ul>
		</div>
	</div>
	<div id="banner" class="container">
		<div class="title">
			<h2>LOOKING FOR A PART TIME JOB?</h2>
			<span class="byline">FIND THE JOB WHICH YOU LOVE
		</div>
		<ul class="actions">
			<li><a href="jobs.php" class="button">FIND</a></li>
		</ul>
	</div>
</div>
<div id="wrapper">
	<div id="three-column" class="container">
		<div class="title">
			<h2 style="color:black;text-align: center ">OUR STATISTICS</h2>
		</div>
		<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
             <?php
                      $sql = "SELECT * FROM job_post";
                      $result = $conn->query($sql);
                      if($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                    ?>
              <h3 style="text-align: center;"><?php echo $totalno; ?></h3>

              <p style ="text-align: center;">Job Offers</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-paper"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
                  <?php
                      $sql = "SELECT * FROM company WHERE active='1'";
                      $result = $conn->query($sql);
                      if($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                    ?>
              <h3 style="text-align: center;"><?php echo $totalno; ?></h3>

              <p style="text-align: center;">Registered Company</p>
            </div>
            <div class="icon">
                <i class="ion ion-briefcase"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
               <?php
                      $sql = "SELECT * FROM users WHERE active='1'";
                      $result = $conn->query($sql);
                      if($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                    ?>
              <h3 style="text-align: center;"><?php echo $totalno; ?></h3>

              <p style="text-align: center;">Daily Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
		</div>
	</div>
 </div>
</div>
</div>
<div id="welcome">
	<div class="container">
		<div class="title">
			<h2>ABOUT US</h2>
		    <p>Our motto of creating this website is simple
		       This website is used to provide a platform for potential candidates to get their dream job and excel in yheir career. This site can be used as      paving path for both companies and job-seekers for a better life .
</div>
<div id="copyright" class="container">
	<p >&copy;All rights reserved. Developed by <a href="team.html">OUR TEAM</a>.</p>
</div>
</body>
</html>
