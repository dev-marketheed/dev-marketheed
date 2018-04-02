<?php
session_start();
include("includes/config.inc.php");
include("includes/functions.inc.php");
include("includes/header.inc.php");
access_denied();


	
if($_SERVER['REQUEST_METHOD'] == "POST")
{
 if(isset($_POST['submit']))
 {
        $title = $_POST['page-name'];
	$page_url_link =  str_replace(" ", "-", $title);
	$page_desc = $_POST['page_desc'];
	create_pages($title,$page_desc,$page_url_link);
 }
 
} ?>

<!---end pages created -->	

<div class="container">
<div style="color:red; font-size:16px; text-align:center"><b><?php echo $err;?></b></div>
<div class="sec-heading"><h3>Manage Nurture Tracks</h3></div>
<form action="" method="post" enctype="multipart/form-data" class="add_pages">
<div class="form-fields">
<label>Nurture Track Name</label><br/>
<input type="text" name="page-name" placeholder="Enter Nurture Tracks Name"></div>
<div class="form-fields">
<label>Nurture Track Description</label><br/>
<textarea name="page_desc"></textarea
</div><div class="form-fields">
<input type="submit" value="Submit" name="submit" /></div>
</form>
</div>
</div>

<!--- show all pages table -->	

<div class="sec-heading"><h3>All Nurture Tracks</h3></div>
<?php $query = mysql_query("SELECT * FROM pdf_pages"); ?>

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
{?>
<tr>

<td><?php echo $row['page_title']; ?></td>
<td><?php echo $row['page_desc']; ?></td>
<td><?php echo $row['assign_pdf']; ?></td>
<td><a href="page-edit?id=<?php echo $row["page_id"];?>" target="_blank">EDIT</a>/<a href="delete-pages?id=<?php echo $row['page_id'];?>" onclick ="return confirm('Are you sure you want to delete this?')">Delete</a>/<a href="http://dev.instaspiel.com/<?php echo 
$row['page_url_link'];?>" target="_blank">View</a></td>
</tr>
<?php }
?>
</table>
</div>

<!--- end all pages table -->	

<?php
include("admin/includes/footer.inc.php");
?>
</body>
</html>