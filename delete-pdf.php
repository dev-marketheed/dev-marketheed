<?php
error_reporting(0);
session_start();
include("includes/config.inc.php");
include("includes/functions.inc.php");
connect_db();


if (isset($_GET['id']))
{
$pdf = $_GET['pdf'];
$id = $_GET['id'];
$sql = mysql_query("SELECT * FROM `pdf_pages` WHERE `page_id` = $id");
while($update=mysql_fetch_array($sql))
  {
  $current_pdf = $update['assign_pdf'];
  $pdf_array = explode("||",$current_pdf);
  $current_url_name_assign = $update['assign_url_name'];
  $current_url_name_array = explode("||", $current_url_name_assign );
  $current_url = $update['assign_url'];
  $current_assign_url = explode("||",$current_url);
  $array_com = array_combine($current_url_name_array, $current_assign_url);
  $var_assign_url = $array_com[$pdf];
  $rev = remove_element($current_url_name_array,$pdf);
  $update_url_name = implode("||", $rev);
  $update_url_links = remove_element($current_assign_url,$var_assign_url );
  $final_update_url_links = implode("||", $update_url_links);
  $result = remove_element($pdf_array,$pdf);
  $final_res = implode("||", $result);
  $updated = mysql_query("UPDATE `pdf_pages` SET `assign_pdf` = '$final_res' , `assign_url_name` ='$update_url_name' , `assign_url` = '$final_update_url_links'   WHERE `page_id` = $id");
  if($current_url == $pdf )
  {
  $updated = mysql_query("UPDATE `pdf_pages` SET `assign_url` = ' ', `assign_url_name` = '' WHERE `page_id` = $id");
  }
}
?>
<script>
window.history.go(-1);
</script>

<?php }
?>