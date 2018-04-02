<?php
ob_start( );
include("includes/config.inc.php");
connect_db();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   
<title>Market Heed</title>

<!-- CSS -->
<link href="style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</head>

<body>
	<div id="wrapper">
	<div class="container admin-header">
	 
		<div class="logo">
		
     <img src="uploads/header-logo.png" />
		</div>
		</div>
		<div id="main">
		<?php if($_SESSION['user_id'])
		{?>
		<ul id="mainNav2">
<li><a href="/dev/main" class="" >Manage Company Profile</a></li>
<li><a href="/dev/add-pages" >Manage Nurture Tracks</a></li>
<li><a href="/dev/popup-option" >Popup Setting</a></li>
<li class="logout" style="border-left:0px;"><a href="/dev/logout">LOGOUT</a></li></ul>
		<?php }?>
	
