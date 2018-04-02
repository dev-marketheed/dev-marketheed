<?php
include("includes/config.inc.php");
include("includes/functions.inc.php");

connect_db();

$page_id = $_POST["page_id_array"];
for($i=0; $i<count($_POST["page_id_array"]); $i++)
{
 mysql_query("UPDATE `all_pdf` SET `post_order_no` = '".$i."' WHERE `pdf_id` = '".$_POST["page_id_array"][$i]."'");
 }
echo 'Page Order has been updated'; 


?>
