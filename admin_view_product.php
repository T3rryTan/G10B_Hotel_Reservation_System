<?php 
/* ----------- ADMIN VIEW PRODUCT PAGE ----------------*/
include("dataconn.php");

/* get room ID using GET in URL*/
if(isset($_GET['id']) && $_GET['id'] != null)
{
	$catID = $_GET['id'];
} 
else
{
	$catID = 1; // set back to 1 as default
}

$roomQuery = "SELECT * FROM room WHERE hotelTypeID = '".$catID."'";
$roomResult = mysql_query($roomQuery) or die(mysql_error());

if(isset($_GET['action']) || isset($_POST['action']))
{
	if(isset($_POST['action']) && $_POST['action'] == 'edit')
	{
		//var_dump($_POST);
		// update sql
		$update = mysql_query("update room set roomName = '".$_POST['roomName']."', roomPrice = '".$_POST['roomPrice']."' where roomID = '".$_POST['iid']."' ") or die(mysql_error());
		if($update)
		{
			header("Location: admin_view_product.php");
		}
	}
	//delete all information by row
	if(isset($_GET['action']) && $_GET['action'] == 'delete')
	{
		if (isset($_GET["iid"]))
		{
			$iid = $_GET["iid"];
			$delete = mysql_query("delete from room where roomID = '".$iid."'") or die(mysql_error());
			header("Location: admin_view_product.php");
		}
	}
}

/*function productExists($product_id) 
{
    $sql = sprintf("SELECT * FROM room WHERE roomID = %d;", $product_id); 
    return mysql_num_rows(mysql_query($sql)) > 0;
}*/
?>

<html>
<head>
    <link href="css.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript">
	//delete alert
	function confirmation()
	{
		answer = confirm("Do you want to delecte this record?");
		return answer;
	}
	</script>	
</head>
<body>

<?php
    include("adminmenu.php");
?>

<div class="data-container">
	<?php
	if (isset($_SESSION['flash_msg']) && $_SESSION['flash_msg'] != NULL) 
	{
	    echo '<div class="alert">
	            '.$_SESSION['flash_msg'].'
	          </div>';
	    $_SESSION['flash_msg'] = NULL;
	}
	?>
	<br>
	<br>
	<br>
	<form method="post" action="<?php $_PHP_SELF ?>">
	<table table border="1" width="100%" height="25px"  class="product"/>
	<tr>
	<th>ROOM ID</th>
	<th>ROOM IMAGE</th>
	<th>ROOM NAME</th>
	<th>ROOM PRICE</th>
	<th></th>
	</tr>
	    <?php
        	while($row = mysql_fetch_assoc($roomResult))
			{
				echo '<form name="Hotel" action="" method="post" enctype="multipart/form-data">';
        		echo '<tr>';
				echo '<td>'.$row["roomID"].'</td>';
				echo '<td><img src="image/'.$row["roomImage"].'" alt="'.$row["roomName"].'" width="200" height="150"/></td>';
        		echo '<td><input type="text" name="roomName" value="'.$row["roomName"].'" size="48"></td>';
        		echo '<td>Price : RM <input type="text" name="roomPrice" value="'.$row["roomPrice"].'" size="5" ><button type="submit">Save</button></td>';					
		?>
				
				<td><a href="admin_view_product.php?iid=<?php echo $row['roomID'];?>&action=delete" onclick="return confirmation();">
					<img src="image/delete.png"></a></td>
				
				<?php				
        		echo '</tr>';
        		echo '<input type="hidden" name="iid" value="'.$row["roomID"].'"/>';
        		echo '<input type="hidden" name="action" value="edit"/>';
        		echo '</form>';
        	}
        ?>
	</table>	
	</form>
</div>
</html>
