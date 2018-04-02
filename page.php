<?php
error_reporting(0);
include("includes/config.php");
include("includes/functions.php");
include("includes/header.php");
connect_db();
ob_start( );

?>
<?php
    $currentFile = $_SERVER["PHP_SELF"];
    $parts = Explode(".", $currentFile);
    $cou = $parts[0];
    $file_name = Explode("/", $cou);
    $file_res = $file_name[1];
    $page_name = $_GET['c'];
  
?>

<?php $view_pdf	= mysql_query("SELECT * FROM `pdf_pages` WHERE `page_url_link` =  '".$file_res."'");?>
<ul>
				
<?php while($view = mysql_fetch_array($view_pdf)){
$select_page  = $view['page_title'];
$page_url_link  = $view['page_url_link'];
$page_url  = $view['assign_url'];
$select_pdf  = $view['assign_pdf'];
$pdf_data = explode("||",$select_pdf);
$url_name_fetch = $view['assign_url_name'];
$assing_url_name = explode("||",$url_name_fetch);
$assing_url_name_url = explode("||",$page_url);
$a = $assing_url_name_url;
$b = $assing_url_name;
$c = array_combine($b,$a);
$common_values = array_intersect($assing_url_name,$pdf_data);
$key = array_search($page_name, $pdf_data);
$next_content = array_slice($pdf_data,$key);
$get_url_name = $assing_url_name;
$url_source_link =  $c[$_GET['c']];
$path_parts = pathinfo($url_source_link);
$pdf_ext =  $path_parts['extension'];
?>
<ul>
<?php 
foreach($pdf_data as $all_pdfs => $value)
{
if (in_array($value, $common_values))
{ ?>
<li><a href="/<?php echo $page_url_link.'';?>/?c=<?php echo $value ?>" class="url_link" target = "_self">
<?php echo $value; ?>
</a></li>
<?php } }  ?>	
</ul>
</div>
<div class="right-block">
<?php 
if($page_name)
{?>
<iframe src="<?php echo $url_source_link;?>" width='100%' height='100%'></iframe>
<?php  }
else
{
$location_onload = '/' .$page_url_link.'.php/';
$get_d = $pdf_data[0]; 
$default_url = $location_onload.'?c='.$get_d;
header("Location: $default_url");
}
?>
<div class="bottom-hover-sec">
<a href="/<?php echo $page_url_link.'';?>/?c=<?php echo next($next_content); ?>" target = "_self">
<div class="next">
Next <i class="fa fa-arrow-right"></i>
</div>
</a>
</div>
</div>
<div class="mobile-block">
<?php 
if($page_name)
{
if($pdf_ext == "pdf")
{?>
<embed src='https://docs.google.com/viewer?url=<?php echo $url_source_link;?>&embedded=true' width='100%' height='100%'></embed>
<?php  }
else
{?>
<iframe src="<?php echo $url_source_link;?>"></iframe>
<?php  }
}
else
{
$location_onload = '/' .$page_url_link.'/';
$get_d = $pdf_data[0]; 
$default_url = $location_onload.'?c='.$get_d;
header("Location: $default_url");
}
?>
</div>
</div>
	
<div class="mobile-tabs">
<span href="#collapse1" class="nav-toggle">Continue Reading</span>
<div id="collapse1">
<div id="owl-example" class="owl-carousel">

 <?php
foreach($pdf_data as $all_pdfs => $value)
{
?>
	<div class="item">
	<a href="/<?php echo $page_url_link.'.php';?>/?c=<?php echo $value ?>" target = "_self">
		<?php echo $value; ?>
			</a>
	</div>
	
	<?php }?>
	
</div>
<?php }?>
<div class="customNavigation">
	<a class="btn prev"><i class="fa fa-angle-left" style=""></i></a>
	<a class="btn next"><i class="fa fa-angle-right" style=""></i></a>
</div>
</div>
</div>

</div>


<?php include("includes/footer.php"); ?>