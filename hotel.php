<?php 
/* ----------- CATEGORY PAGE ----------------*/
include("dataconn.php");

// get category ID using GET in URL

$roomQuery = "SELECT * FROM hotel_type";
$roomResult = mysql_query($roomQuery) or die(mysql_error());


?>

<html>
<head>
    <link href="css.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="mainhotel.css">
	<style type="text/css">
	h3{
    text-align:left;
	padding-left:30px;
	}
	</style>

</head>
<body>

<?php
    include("menu.php");
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
	<table table border="9" width="100%" height="25px"  class="product"/>
	<tr style="background-color:blue;border:1px black solid;text-align:center;vertical-align:top;height:50px">
	<th width="50%"><div><span style="color:white;font-size:25px;">HOTEL IMAGE</div></th>
	<th width="50%"><div><span style="color:white;font-size:25px;">HOTEL</div></th>
	</tr>
	    <?php
        	while($row = mysql_fetch_assoc($roomResult))
			{
        		echo '<form name="category" action="" method="post"/>';
        		echo '<tr>';
				echo '<td><img src="image/'.$row["hotelTypeImage"].'" alt="'.$row["hotelTypeName"].'" width="500" height="300"/></td>';
        		echo '<td align=\"left\"><h3>NAME:  '.$row["hotelTypeName"].'<br><br>ADDRESS:  '.$row["hotelTypeAddress"].'<br><br>PHONE:  '.$row["hotelTypePhone"].'</td>'; 
				echo '</tr>';
        		echo '<input type="hidden" name="pid" value="'.$row["hotelTypeID"].'"/>';
				
        		echo '<input type="hidden" name="action" value="add"/>';
        		echo '</form>';
        	}
        ?>
	</table>	
</div>
</html>
