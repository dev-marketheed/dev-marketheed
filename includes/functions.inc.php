<?php

function dump_array($arr) {

	echo "<pre>\nDumping array\n\n";

	print_r($arr);

	echo "</pre>";	

}



function db_connect($p_dbhost,$u_dbname,$u_dbuser,$u_dbpasswd) {



	if ( !@mysql_connect($p_dbhost,$u_dbuser,$u_dbpasswd) ) {

		echo "Could not connect to ".$p_dbhost;

	} else if ( !mysql_select_db($u_dbname) ) {

		echo "No database selected ".mysql_error();

	}

}



function connect_db() {



	db_connect(_DB_HOST,_DB_NAME,_DB_USER,_DB_PASS);

}



function verify_login($usr_name,$usr_password)

{

	 $sql			= "SELECT * FROM users WHERE `username`='".$usr_name."' AND `password` = '".md5($usr_password)."'";
	

	$check_login	= @mysql_result(mysql_query($sql),0);



	if( $check_login )

	{

		$sql		= "SELECT * FROM users WHERE id=".$check_login;

		$user		= @mysql_result(mysql_query($sql),0);
                 $_SESSION['username']		= $user['username'];
		 
		 $_SESSION['user_id']	    = $check_login;

		return true;

	}

	else

	{

		return false;

	}

}



function access_denied()

{

	if( !$_SESSION['user_id'] )

	{

		header("Location:index.php?err=1");

	}

}



function deny_access()

{

	header("Location:index.php?err=3");

	

}



function get_classes()

{

	$sql			= "SELECT DISTINCT(class) FROM all_pdf ORDER BY id";



	$class_data	= q2a($sql);



	return $class_data;

}




   


function query($sql){

    mysql_query("SET NAMES utf8");

	mysql_query("SET collation_connection = utf8_unicode_ci");

	$res = mysql_query($sql) ;

	return $res;

}



function q2a($sql){

	$return = array();

	$res = query($sql);

	while($row = @mysql_fetch_assoc($res)){

			$return[] = $row;

	}

	return $return;

}

 function content_management($target_file,$target_file1,$header_script)
{

$sql ="SELECT * FROM content_management WHERE `key` = 'logo'";
$value = mysql_query($sql);
$result	= mysql_fetch_row($value);

if($result)
{
	$update = "UPDATE `content_management` SET `value` = '".$target_file."', `header_script` = '".$header_script."', `favicon` = '".$target_file1."' WHERE `key` = 'logo'";
	mysql_query($update);
}

else
{
	$insert ="INSERT INTO content_management(`key`,`value`,`header_script`, `favicon`)VALUES('logo','$target_file','$header_script','$target_file1')";
}
if ( query($insert) )

	{


		$error	= "Logo Added Successfully";

	}

		

	return $error;

	

}	



 function content_management_header($header_script)
{

$sql ="SELECT * FROM content_management WHERE `key` = 'logo'";
$value = mysql_query($sql);
$result	= mysql_fetch_row($value);
if($result)
{
	$update = "UPDATE `content_management` SET `header_script` = '".$header_script."' WHERE `key` = 'logo'";
	mysql_query($update);
}

if ( query($insert) )

	{
             $error	= "Header Script Added Successfully";
        }
return $error;
}	





 function content_management_fav($header_script,$target_file1)
{

$sql ="SELECT * FROM content_management WHERE `key` = 'logo'";
$value = mysql_query($sql);
$result	= mysql_fetch_row($value);
if($result)
{
	$update = "UPDATE `content_management` SET `header_script` = '".$header_script."' , `favicon` = '".$target_file1."' WHERE `key` = 'logo'";
	mysql_query($update);
}

if ( query($insert) )

	{
             $error	= "Favicon Added Successfully";
        }
return $error;
}

function content_management_logo($header_script,$target_file)
{

$sql ="SELECT * FROM content_management WHERE `key` = 'logo'";
$value = mysql_query($sql);
$result	= mysql_fetch_row($value);
if($result)
{
	$update = "UPDATE `content_management` SET `header_script` = '".$header_script."' , `value` = '".$target_file."' WHERE `key` = 'logo'";
	mysql_query($update);
}

if ( query($insert) )

	{
             $error	= "Header Logo Added Successfully";
        }
return $error;
}


function add_logo_favicon()
{
$target_dir  = "uploads/";
$header_script = $_POST['header_script'];
$target_file = basename($_FILES["logo"]["name"]);
$target_file1 = basename($_FILES["favicon"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$imageFileType1 = pathinfo($target_file1,PATHINFO_EXTENSION);
$uploadOk = 1;


if(isset($_POST["add_logo"])) {
if (is_uploaded_file($_FILES["logo"]["tmp_name"]))
{

  $check = getimagesize($_FILES["logo"]["tmp_name"]);
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
   if($check !== false) {
       $uploadOk = 1;
    } else {
        echo '<div style="font-size:16px; color:green; text-align:center;">File is not an image.</div>';
        $uploadOk = 0;
    }
}


if(is_uploaded_file($_FILES["favicon"]["tmp_name"]))
{
 $check1 = getimagesize($_FILES["favicon"]["tmp_name"]);
 if($imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg" && $imageFileType1 != "gif" ){
    echo '<div style="font-size:16px; color:green; text-align:center;">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>';
    $uploadOk = 0;
}

    if($check1 !== false) {
       $uploadOk = 1;
    } else {
        echo '<div style="font-size:16px; color:green; text-align:center;">File is not an image.</div>';
        $uploadOk = 0;
    }

}


}

if ($uploadOk == 0) {
    echo '<div style="font-size:16px; color:green; text-align:center;">Sorry, your file was not uploaded.</div>';
// if everything is ok, try to upload file
}

if($uploadOk == 1)
{
if(!$target_file && !$target_file1 )
{
 $error	=	content_management_header($header_script);
		echo '<div style="font-size:16px; color:green; text-align:center;">'.$error.'</div>';

}
elseif(!$target_file && $target_file1 )
{
move_uploaded_file($_FILES["favicon"]["tmp_name"],"$target_dir/".$target_file1);
$error	=	content_management_fav($header_script,$target_file1);
				echo '<div style="font-size:16px; color:green; text-align:center;">'.$error.'</div>';
}
elseif($target_file && !$target_file1 )
{
move_uploaded_file($_FILES["logo"]["tmp_name"],"$target_dir/".$target_file);
$error	=	content_management_logo($header_script,$target_file);
				echo '<div style="font-size:16px; color:green; text-align:center;">'.$error.'</div>';
}
else
{
move_uploaded_file($_FILES["logo"]["tmp_name"],"$target_dir/".$target_file);
move_uploaded_file($_FILES["favicon"]["tmp_name"],"$target_dir/".$target_file1);
$error	=	content_management($target_file,$target_file1,$header_script);
		echo '<div style="font-size:16px; color:green; text-align:center;">'.$error.'</div>';
}

}

else {
    
		        $error	=	content_management_header($header_script);
			echo '<div style="font-size:16px; color:green; text-align:center;">'.$error.'</div>';
                        } 
}









 function pdf_management($targetfolder_name , $pdf_title)
{

        
	$insert ="INSERT INTO all_pdf(`pdf_title` , `pdf_name`)VALUES('$pdf_title' , '$targetfolder_name')";

if ( query($insert) )

	{


		$success	= "File Added Successfully";
		echo $page_id_pdf;

	}

		

	return $success;


}	

function remove_element($array,$value) {
 foreach (array_keys($array, $value) as $key) {
    unset($array[$key]);
 }  
  return $array;
} 

function create_pages($title,$page_desc,$page_url_link)
{

        $title = $_POST['page-name'];
	$page_url_link =  str_replace(" ", "-", $title);
	$page_desc = $_POST['page_desc'];
	$myfile = fopen("page.php", "r") or die("Unable to open file!");  /********* read **********/
	$data = fread($myfile, filesize("page.php"));
	fclose($myfile);
	$name_file= $page_url_link.".php";
	$myfile = fopen($name_file, "w") or die("Unable to open2 file!");
	fwrite($myfile, $data);
	$srcPath = 'app.instaspiel.com/dev/'.$name_file.".php";
	$dir = '/home/behavi45/public_html/dev.instaspiel.com/'.$page_url_link.".php";
	copy($srcPath, $dir);
	closedir('app.instaspiel.com/dev/');
	fclose($myfile);
	if (copy($name_file,$dir)) {
	unlink($name_file);
	}
	$sql = mysql_query("INSERT INTO pdf_pages (`page_title` , `page_desc`, `page_url_link`) VALUES ('" . $title . "' ,'" . $page_desc . "', '" . $page_url_link . "')");
	if ($sql) {
	echo "<h3 class='success-msg'>Page created successfully</h3>";
	} else {
	echo "<h3 class='success-msg'>Problem for create new Page</h3>";
	}

}


function page_edit()
{
	$path = '/home/behavi45/public_html/dev.instaspiel.com/';
	$id=$_GET['id'];
	$page_desc         = $_POST['page_desc'];
	$page_title        = $_POST['page_title'];
	$page_url_link     = str_replace(" ", "-", $page_title);
	$page_url_link_rename     = str_replace(" ", "-", $page_title).'.php';
	$assing_url        = $_POST['assign_url'];
	$embed_assign_name_title = $_POST['embed_assign_name'];
	$getselect         = mysql_query("SELECT * FROM `pdf_pages` WHERE `page_id` = '$id'");
	$update            = mysql_fetch_array($getselect);
	$page_rename       = $update['page_url_link'].".php";
	$assign_urls = implode("||", $_POST["assign_url"]);
	$assign_url_name = implode("||", $_POST['embed_assign_name']);
	$files_dir         = $assign_url_name;
	rename($path.$page_rename, $path.$page_url_link_rename);
	                      
	$updated = mysql_query("UPDATE `pdf_pages` SET `page_title` = '$page_title', `page_desc` = '$page_desc', `assign_pdf` = '$files_dir', `assign_url_name` = 
       '$assign_url_name',`assign_url` = '$assign_urls', `page_url_link` = '$page_url_link'  WHERE `page_id` = $id");
	
	if($updated)
	 {
	  echo "<script>
	alert('Successfully Updated Record');
	window.history.go(-1);
	</script>";
	    }
	 else
	 {
	 echo "<h3 class='success-msg'>Problem for Update Nuture Tracks</h3>";
	 }
 }
 ?>