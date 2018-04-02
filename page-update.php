<?php
include("includes/config.inc.php");
include("includes/functions.inc.php");
connect_db();


 
$pdf_ids = $_POST["page_id_array"];
$page_id = $_POST["get_page_id"];
$assing_pdf_ids =  implode("||",$pdf_ids);


mysql_query("UPDATE `pdf_pages` SET `assign_pdf` = '".$assing_pdf_ids."' WHERE `page_id` = '".$page_id."'");

 
echo 'Page Order has been updated'; 


?>
