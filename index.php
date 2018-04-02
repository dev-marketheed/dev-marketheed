<?php
error_reporting(0);
session_start();
include("includes/config.inc.php");
include("includes/functions.inc.php");
include("includes/header.inc.php");
$login_page = 1;
connect_db();

$err	= $_GET['err'];

$error	= "";


	if (isset($_POST['userlogin']) )
	{

		$usr_name		= $_POST['usr_name'];
                $usr_password	= $_POST['usr_password'];
                if ( verify_login($usr_name,$usr_password) )
                {

			header("Location: main.php");
                }

		else

		{

			$error	= "Invalid User Name/Password";

		}

	}
	
	
	
	
      if (isset($_POST['resetpassword']) )
      {
		$usr_name	= $_POST['usr_name'];
		$usr_repassword	= $_POST['reset_password'];
		$user_pass_re      = md5($usr_repassword);
		$sql_u          = "SELECT * FROM users WHERE `username` = '$usr_name'";
		$res_u = mysql_query($sql_u);
		if (!mysql_num_rows($res_u)) {
		$name_error = "Sorry... Username Not Exist";
		}
		elseif(!$usr_repassword)
		{
		echo "<script>
		alert('Reset password field is not empty. Please fill new password');
		window.location.href='index.php';
		</script>";
		$not_pass_error = "";
		}
		elseif(mysql_num_rows($res_u) > 0){
		
		$updated = "UPDATE `users` SET  `password` = '$user_pass_re' WHERE `username` = '$usr_name'";
		$user_edit = mysql_query($updated);
		if($user_edit) {
		echo "<script>
		alert('Password Update Successfully');
		window.location.href='index.php';
		</script>";
		
		} 
		}

       }
	
	
	
	


?>
<div id="first">
<?php if(!$_SESSION['user_id'])
{?>
<form action="" class="jNice" method="POST" id="login_form">

<center>

<div>

	<h3> Admin Login </h3>

	<fieldset style="width:16%;">

		<?php

		if( $error )

		{

		?>

			<center><p style="color:#FF0000"><label><b><?php echo $error;?></b></label></p></center>

		<?php

		}

		?>

		<p><label style="text-align: left"><b>User Name : </b></label><input id="loginemail" type="text" name="usr_name" class="text-long validate[required]" /></p>
		<p id="password_block"><label style="text-align: left"><b>Password :</b></label><input id="loginpassword" type="password" name="usr_password" class="text-long validate[required]" 
                /></p>
                <p style="color:red;" id="reset_message"><?php echo $name_error;  ?></p>
                
                <p id="resetpassword_block" class="resetpassword_block" style="display:none;"><label style="text-align: left"><b>Reset Password :</b></label><input id="resetpassword" type="password" name="reset_password"  class="text-long 
                validate[required]" 
                /></p>
                <?php echo $not_pass_error; ?>
		<div class="user_su_rstyle">
		<div class="reset_btn" id="reset_pass" />Reset Password</div>
		<a href="/admin/" class="reset_btn" id="cancel_repass" />Cancel</a>
		<input type="submit" value="Login" name="userlogin" class="login_btn" id="login_btn"/>
		<input type="submit" value="Reset Password" name="resetpassword" class="login_btn" id="reset_pass_btn"/>
		
		</div>
	</fieldset>

</div>

</center>	

</form>
</div>
<?php }

else
{
header("location:main.php");
}?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){

    $("#resetpassword_block").hide();
    $("#reset_pass_btn").hide();
    $("#cancel_repass").hide();
    $("#reset_pass").click(function(){
    
        $("#password_block").hide();
        $("#reset_message").hide();
        $("#reset_pass").hide();
        $("#login_btn").hide();
        $("#cancel_repass").show();
        $("#reset_pass_btn").show();
        $("#resetpassword_block").show();
    });
   
});
</script>
