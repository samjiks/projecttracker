<!DOCTYPE html>
<html lang="en">
<head>
<?php 
/*    $PROJECTNAME = "projecttracker";
   // $BASENAME = dirname(dirname($_SERVER['SCRIPT_FILENAME'])); 
    $PATH = "../$PROJECTNAME";*/
 ?>
<!-- <base href="<?php echo "http://localhost/projecttracker" ?>" -->
<title>Project Tracker - <?php $title ?> </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Project Tracker">
<meta name="author" content="Samuel Thampy">
<link href="<?php echo base_url("/assets/css/bootstrap.css"); ?>" rel="stylesheet"> 
<link href="<?php echo base_url("/assets/css/bootstrap.min.css"); ?>" rel="stylesheet"> 
<!-- <link href="<?php echo base_url("/assets/css/jquery-ui-1.10.4.css"); ?>" rel="stylesheet">  -->
<link href="<?php echo base_url("/assets/css/jquery-ui-1.10.4.min.css"); ?>" rel="stylesheet"> 
<link href="<?php echo base_url("/assets/css/mystyles.css"); ?>" rel="stylesheet"> 
<link href="<?php echo base_url("/assets/css/simple-sidebar.css"); ?>" rel="stylesheet"> 
<script src="<?php echo base_url("/assets/js/jquery-2.1.0.min.js") ?>" type="text/javascript"></script>
<script src="<?php echo base_url("/assets/js/bootstrap.js") ?>" type="text/javascript"></script>
<script src="<?php echo base_url("/assets/js/bootstrap.min.js") ?>" type="text/javascript"></script>
<!-- <script src="<?php echo base_url("/assets/js/jquery.session.js") ?>" type="text/javascript"></script> -->
<!-- <script src="<?php echo base_url("/assets/js/kickstart.js") ?>" type="text/javascript"></script>* -->
<!--<script src="<?php echo base_url("/assets/js/jquery-ui-1.10.4.js") ?>" type="text/javascript"></script> -->
<script src="<?php echo base_url("/assets/js/jquery-ui-1.10.4.min.js") ?>" type="text/javascript"></script>
<script src="<?php echo base_url("/assets/js/jquery-1.10.2.js") ?>" type="text/javascript"></script>
<script src="<?php echo base_url("/assets/js/jquery-ui.js") ?>" type="text/javascript"></script>


</head>
<body>
<nav class="navbar navbar-inverse" role="navigation">
   <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo base_url(); ?>index.php">Project Tracker</a>
   </div>
   <div>
      <ul class="nav navbar-nav navbar-right">
           <li><a class="active" href="<?php echo base_url(); ?>index.php/user/registration">Sign Up</a></li>
          <li><a class="login" value="login" href="<?php echo base_url(); ?>index.php/user/login_page">Login</a></li>
<!--           <li><a class="logout" style="display: none;">Logout</a></li>  -->
         <li><a class="logout" style="display: none;" href="<?php echo base_url(); ?>index.php/user/logout_page">Logout</a></li>  
      </ul>
   </div>
</nav>
 <div class="container">
 <div class="wrapper">





