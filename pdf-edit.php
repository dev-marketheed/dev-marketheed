<?php
session_start();
error_reporting(0);
include("includes/config.inc.php");
include("includes/functions.inc.php");
include("includes/header.inc.php");
access_denied();
connect_db();


if(isset($_GET['id']))
{
  $id=$_GET['id'];
  
  if(isset($_POST['update']))
  {
                         
                        $id=$_GET['id'];
                        $pdf_title          = $_POST['pdf-title'];
			$assign_page        = $_POST['page-assign'];
			$pdf_name           = $_POST['pdf-file'];
			$files_dir          = $_POST['files_dir'];
			
if ($_FILES['pdf-file']['size'] != 0 && !$files_dir)
{			
if (isset($_FILES['pdf-file']['tmp_name'])) {
 $targetfolder = "uploads/";
 $targetfolder_name = basename($_FILES["pdf-file"]["name"]) ;
 
$ok=1;
 $file_type=$_FILES['pdf-file']['type'];
 
if ($file_type != "application/pdf") {
	 echo '<div style="font-size:16px; color:green; text-align:center;">Sorry, only pdf files are allowed.</div>';
     $ok=0;
}

  move_uploaded_file($_FILES["pdf-file"]["tmp_name"],"$targetfolder/".$targetfolder_name);

 $updated = mysql_query("UPDATE `all_pdf` SET `pdf_title` = '$pdf_title', `pdf_name` = '$targetfolder_name' WHERE `pdf_id` = $id");
 }
 }
 elseif($files_dir && $_FILES['pdf-file']['size'] == 0)
 {
 $updated = mysql_query("UPDATE `all_pdf` SET `pdf_title` = '$pdf_title', `pdf_name` = '$files_dir' WHERE `pdf_id` = $id");
 }
elseif(!$files_dir && $_FILES['pdf-file']['size'] == 0)
  {
 $updated = mysql_query("UPDATE `all_pdf` SET `pdf_title` = '$pdf_title' WHERE `pdf_id` = $id");
  
  }
elseif($_FILES['pdf-file']['size'] != 0 && $files_dir)
{
 echo "<h3>You are selected Both Options from media file and browse file, Please select one option</h3>";

}

if($updated)
  {
  echo "<script>
alert('Successfully Updated Record');
window.location.href='/admin/pdf.php';
</script>";
 }
 else
{
echo "<h3>Some Problem For Update Record</h3>";
}
}
  }

?>
<div class="container">
<div style="color:red; font-size:16px; text-align:center"><b><?php echo $err;?></b></div>

<div class="sec-heading"><h3>Edit Nurture Track Records</h3></div>
<?php 
  if(isset($_GET['id']))
  {
  $id=$_GET['id'];
  $getselect = mysql_query("SELECT * FROM `all_pdf` WHERE `pdf_id` = '$id'");
  while($update=mysql_fetch_array($getselect))
  {
  $page_id = $update['page_id'];?>
 
<form action="" method="post" enctype="multipart/form-data">

		
<div class="form-fields">
<label>Nurture Track Title</label><br/>
<input type="text" name="pdf-title" value="<?php echo $update['pdf_title'] ; ?>"></div>
<div class="form-fields">
<label>Choose Nurture Track </label><br/>
<input type="file" name="pdf-file" size="50" value="<?php echo $update['pdf_name'] ; ?>" /> <div id="myBtn">Select PDF from Media Library</div><br/>
<label>CURRENT PDF FILE:</label>  <?php echo $update['pdf_name'] ; ?>
</div>


<!-- The Modal -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <?php $dir = "uploads";
    
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    $count = 1;
    while (($file = readdir($dh)) !== false){
    $count_res = $count++ ;?>
    
      <input type="radio" name ="files_dir" value='<?php echo $file; ?>' id="files<?php echo $count_res ;?>"><label for="files<?php echo $count_res ;?>"><h3><?php echo $file; ?></h3></label>
   <?php }
    closedir($dh);
  }
}?>
  </div><!-- end model popup --->





</div><div class="form-fields">
<input type="submit" name="update"  class="main_link" value="Update">


</form>
<?php } }?>
</div>				 
				
</div>

<div class="sec-heading"><h3>ALL PDF</h3></div>
<?php $query = mysql_query("SELECT * FROM all_pdf ORDER BY post_order_no"); ?>

  <div class="container box">
  
   <ul class="list-unstyled" id="page_list">
   <?php 
   while($row = mysql_fetch_array($query))
   {
    $page_id = $row["page_id"];?>
    <li id=<?php echo $row["pdf_id"]; ?>>
    <table><tr>
   <td><?php echo $row["pdf_title"]; ?></td>
   <?php $res = mysql_query("SELECT * FROM `pdf_pages` WHERE `page_id` = $page_id "); 
   
    while($rows_page = mysql_fetch_array($res))
    {?>
    <td><?php echo $rows_page["page_title"]; ?></td><?php }?>
   <td><a href="pdf-edit.php?id=<?php echo $row["pdf_id"];?>">EDIT</a>/<a class="delete-btn" href="delete_pdf.php?id=<?php echo $row["pdf_id"]?>"> Delete </a></td></tr>
    </table>
  </li>
   
 <?php  }
   ?>
   </ul>
   <input type="hidden" name="page_order_list" id="page_order_list" />
  </div>
 

<script>

 // Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
  }

 jQuery(document).ready(function(){
 $('#myModal label').on('click', function(){
    $('label.current').removeClass('current');
    $(this).addClass('current');
});
  jQuery( "#page_list" ).sortable({
  placeholder : "ui-state-highlight",
  update  : function(event, ui)
  {
   var page_id_array = new Array();
    jQuery('#page_list li').each(function(){
    page_id_array.push(jQuery(this).attr("id"));
   });
    jQuery.ajax({
    url:'update.php',
    method:'POST',
    data:{page_id_array:page_id_array},
    success:function(data)
    {
     alert(data);
    }
   });
  }
 });

});


</script>


<?php
include("includes/footer.inc.php");
?>
</body>
</html>