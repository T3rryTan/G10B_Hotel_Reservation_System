<?php 
/* ----------- ADMIN VIEW PRODUCT PAGE ----------------*/
include("dataconn.php");

/* get hotel_type ID using GET in URL*/

$roomQuery = "SELECT * FROM hotel_type";
$roomResult = mysql_query($roomQuery) or die(mysql_error());

if(isset($_GET['action']) || isset($_POST['action']))
{
	if(isset($_POST['action']) && $_POST['action'] == 'edit')
	{
	}
	//delete all information by row
	if(isset($_GET['action']) && $_GET['action'] == 'delete')
	{
		if (isset($_GET["iid"]))
		{
			$iid = $_GET["iid"];
			$delete = mysql_query("delete from hotel_type where hotelTypeID = '".$iid."'") or die(mysql_error());
			header("Location: admin_view_hotel.php");
		}
	}
}

/*function productExists($product_id) 
{
    $sql = sprintf("SELECT * FROM hotel_type"); 
    return mysql_num_rows(mysql_query($sql)) > 0;
}*/
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="mainhotel.css">
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
	<th>HOTEL ID</th>
	<th>HOTEL IMAGE</th>
	<th>HOTEL NAME</th>
	<th>HOTEL ADDRESS</th>
	<th>HOTEL PHONE</th>
	
	<th></th>
	</tr>
	    <?php
        	while($row = mysql_fetch_assoc($roomResult))
			{
				echo '<form name="Hotel" action="" method="post" enctype="multipart/form-data">';
        		echo '<tr>';
				echo '<td>'.$row["hotelTypeID"].'</td>';
				echo '<td><img src="image/'.$row["hotelTypeImage"].'" alt="'.$row["hotelTypeName"].'" width="200" height="150"/></td>';
        		echo '<td><input type="text" name="hotelTypeName" value="'.$row["hotelTypeName"].'" size="48"></td>';
				echo '<td><input type="text" name="hotelTypeAddress" value="'.$row["hotelTypeAddress"].'" size="48"></td>';
        		echo '<td><input type="text" name="hotelTypePhone" value="'.$row["hotelTypePhone"].'" size="20" ></td>';					
		?>
				
				<td><a href="admin_view_hotel.php?iid=<?php echo $row['hotelTypeID'];?>&action=delete" onclick="return confirmation();">
					<img src="image/delete.png"></a></td>
				
				<?php				
        		echo '</tr>';
        		echo '<input type="hidden" name="iid" value="'.$row["hotelTypeID"].'"/>';
        		echo '<input type="hidden" name="action" value="edit"/>';
        		echo '</form>';
        	}
        ?>
	</table>	
	</form>
</div>
</html>
