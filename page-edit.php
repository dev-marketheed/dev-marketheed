<?php
session_start();
error_reporting(0);
include("includes/config.inc.php");
include("includes/functions.inc.php");
include("includes/header.inc.php");
access_denied();
connect_db();
$id = $_GET['id'];
 if(isset($_POST['update']))
  { 
  page_edit();
  }
 ?>
<div class="container">
<div style="color:red; font-size:16px; text-align:center"><b><?php echo $err;?></b></div>
<div class="sec-heading"><h3>Edit Nuture Tracks</h3></div>
<?php
  if(isset($_GET['id']))
  {
  $id=$_GET['id'];
  $getselect = mysql_query("SELECT * FROM `pdf_pages` WHERE `page_id` = '$id'");
  while($update=mysql_fetch_array($getselect))
  {
  $page_id = $update['page_id'];
  $current_pdf = $update['assign_pdf'];
  $current_url = $update['assign_url'];
  $assing_current_url_name = $update['assign_url_name'];
  $current_url_assign = explode("||",$update['assign_url']);
  $current_url_name_assign = explode("||",$update['assign_url_name']);
  $pdf = explode("||",$current_pdf );
  $result = remove_element($pdf,$resu[0]);
 ?>
<form action="" method="post" enctype="multipart/form-data" class="page-edit-form">
<div class="form-fields">
<label>Nuture Tracks Name</label><br/>
<input type="text" name="page_title" value="<?php echo $update['page_title'] ; ?>"></div>
<div class="form-fields">
<label>Nuture Tracks Description</label><br/>
<textarea name="page_desc" rows="2" cols="50"><?php echo $update['page_desc'] ; ?></textarea></div>
<div class="table-responsive">  
<button type="button" name="add" id="add" class="btn btn-success">ADD MORE LINKS</button>
<table class="table table-bordered" id="dynamic_field">  
<tr><th>Add Url Links With Https/Http</th><th>Assign Url Name</th></tr>
<?php
$count = 1; 
while ((list(, $value) = each($current_url_assign)) &&  (list(, $value1) = each($current_url_name_assign))) {?>
<tr id="row<?php echo $count; ?>" class="dynamic-added">
<td><input type="text" name="assign_url[]" value="<?php echo $value; ?>" class="form-control name_list"/></td>  
<td><input type="text" name="embed_assign_name[]" value="<?php echo $value1; ?>" /> </td> 
</tr>
<?php } ?>
<tr>
<td></td>  </tr>
</table>  
<div class="form-fields">
<input type="submit" name="update"  class="main_link" value="Update">
</div>
</form>
<?php } }?></div></div>
<div class="sec-heading"><h3>ALL NUTURE TRACKS</h3></div>
<?php $query = mysql_query("SELECT * FROM `pdf_pages` WHERE `page_id` = $id "); ?>
<div class="container">
	<table>
	<tr>
	<th>NUTURE TRACKS NAME</th>
	<th>NUTURE TRACKS DESCRIPTION</th>
	<th>ASSIGN PDFs/IMAGES</th>
	<th>NUTURE TRACKS ACTION</th>
	</tr>
	<?php 
	while($row = mysql_fetch_array($query))
	{
	$pdf_assigns = $row['assign_pdf'];
	$result_pdfs = explode("||",$pdf_assigns);
	?>
	<tr>
	<td width="110"><?php echo $row['page_title']; ?></td>
	<td width="110"><?php echo $row['page_desc']; ?></td>
	<td><div class="container box">
	<ul class="list-unstyled" id="page_list">
	<?php foreach ( $result_pdfs as $all_pdfs )
	{
	$id = $_GET['id'];?>
	<li id=<?php echo $count; ?> name="<?php echo  $all_pdfs;?>">
	<?php echo  $all_pdfs;?>
	<a href = "/delete-pdf?id=<?php echo $id; ?>&pdf=<?php echo $all_pdfs;?>" onclick=" return confirm('Are you sure want to delete this?');" class="delete-btn" >DELETE</a>
	</li>
	<?php  } ?>
	</ul>
	<input type="hidden" name="page_order_list" id="page_order_list" value =""/>
	</div>          
	</td>
	<td><a href="http://dev.instaspiel.com/<?php echo $row['page_url_link'];?>" target="_blank">View</a></td>
	</tr>
	<?php }
	?>
	</table>
</div>

	<script>
	$(document).ready(function(){
	$( "#page_list" ).sortable({
	placeholder : "ui-state-highlight",
	update  : function(event, ui)
	{
	var page_id_array = new Array();
	var get_page_id = <?php echo $_GET['id'] ?>;
	$('#page_list li').each(function(){
	page_id_array.push($(this).attr("name"));
	});
	$.ajax({
	url:'page-update',
	method:'POST',
	data:{page_id_array:page_id_array,get_page_id:get_page_id},
	success:function(data)
	{alert(data);
	}});}});});
	</script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script type="text/javascript">
       $(document).ready(function(){      
       var i=1;  
       $('#add').click(function(){  
      i++;  
 $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="assign_url[]" placeholder="https://www.example.co" class="form-control name_list" required /></td><td><input type="text" name="embed_assign_name[]" value="" placeholder="Url Name Assign"  /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  });
 $(document).on('click', '.btn_remove', function(){  
 var button_id = $(this).attr("id");   
 $('#row'+button_id+'').remove();  
});  
});  
</script>
<?php
include("includes/footer.inc.php");
?>
</body>
</html>