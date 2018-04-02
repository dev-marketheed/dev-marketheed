<?php
error_reporting(0);
session_start();
include("includes/config.inc.php");
include("includes/functions.inc.php");
connect_db();


if (isset($_GET['id']) && is_numeric($_GET['id']))

{
$path ="/home/behavi45/public_html/dev.instaspiel.com/";
$id = $_GET['id'];
$sql = mysql_query("SELECT * FROM `pdf_pages` WHERE `page_id` = $id");
while($delete_page = mysql_fetch_array($sql))
{
$file_del =  $delete_page['page_url_link'];
$result_file = $file_del . '.php';
$my_file = $result_file;
unlink($path.$my_file);
}
$result = mysql_query("DELETE FROM `pdf_pages` WHERE `page_id`=$id")or die(mysql_error());
$result = mysql_query("DELETE FROM `all_pdf` WHERE `page_id`=$id ")or die(mysql_error());

header("Location:add-pages.php");

}
?>