<?php
session_start();
error_reporting(0);
include("includes/config.inc.php");
include("includes/functions.inc.php");
include("includes/header.inc.php");
access_denied();
connect_db();

$error	= $_GET['error'];
$error	= "";?>

<?php 
/*********** add Logo **************/
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if( isset( $_POST['add_logo'] ) )
	{
	add_logo_favicon();
        }
}
?>
<div style="color:green; font-size:16px; text-align:center;" ><b><?php echo $error;?></b></div>
<form method="post" name="home_content" enctype="multipart/form-data" class="add-logo-form">
<div class="sec-heading"><h3>ADD / EDIT LOGO</h3>
<div class="form-fields">
<label>CHOOSE LOGO</label><br/>
<?php $result = mysql_query("SELECT * FROM content_management WHERE `key` = 'logo'");
 $row = mysql_fetch_array($result);?>
<input type="file" name="logo">
<img src="/dev/uploads/<?php echo $row['value']; ?>">
</div>
<div class="form-fields">
<label>ADD FAVICON</label><br/>
<input type="file" name="favicon">
<img src="/dev/uploads/<?php echo $row['favicon']; ?>"></div>
<div class="form-fields">
<label>ADD HEADER SCRIPT</label><br/>
<textarea name="header_script" value="" rows="4" cols="60"><?php echo $row['header_script']; ?></textarea>
</div>
<div class="form-fields">
<input type="submit" name="add_logo"  value="SUBMIT"></p></div>
</form>
<?php
include("includes/footer.inc.php");
?>
