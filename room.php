<?php 
/* ----------- CATEGORY PAGE ----------------*/
include("dataconn.php");

// get category ID using GET in URL
if(isset($_GET['id']) && $_GET['id'] != null)
{
	$catID = $_GET['id'];
} else {
	$catID = 1; // set back to 1 as default
}

$roomQuery = "SELECT * FROM room WHERE hotelTypeID = '".$catID."'";
$roomResult = mysql_query($roomQuery) or die(mysql_error());

if(isset($_POST["cart"]))
{
	$product_id = $_POST['pid']; //the product id
	$action = $_POST['action']; //the action
	$quantity = $_POST['quantity'];
	$days = $_POST['days'];
	$date = $_POST['date'];
	//if there is an product_id and that product_id doesn't exist display an error message
	if($product_id && !productExists($product_id)) 
	{
	    die("Error. Product Doesn't Exist");
	}

	switch($action)
	{ //decide what to do 

    case "add":
        $_SESSION['cart'][$product_id] = $quantity;
		$_SESSION['date'][$product_id] = $date;
		$_SESSION['days'][$product_id] = $days;
        $_SESSION['flash_msg'] = "Successfully added to checkout";
    break;

    case "remove":
        $_SESSION['cart'][$product_id] = 0;
		$_SESSION['date'][$product_id] = 0;
		$_SESSION['days'][$product_id] = 0;
        if($_SESSION['cart'][$product_id] == 0) unset($_SESSION['cart'][$product_id]); //if the quantity is zero, remove it completely (using the 'unset' function) - otherwise is will show zero, then -1, -2 etc when the user keeps removing items. 
    break;

    case "empty":
        unset($_SESSION['cart']); //unset the whole cart, i.e. empty the cart. 
		unset($_SESSION['date']);
		unset($_SESSION['days']);
    break;
	}
}

function productExists($product_id) 
{
    $sql = sprintf("SELECT * FROM room WHERE roomID = %d;", $product_id); 
    return mysql_num_rows(mysql_query($sql)) > 0;
}
?>

<html>
<head>
    <link href="css.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="mainhotel.css">

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
	<table table border="1" width="100%" height="25px"  class="product"/>
	<tr>
	<th width="300px">ROOM IMAGE</th>
	<th width="250px">ROOM</th>
	<th width="100px">QUANTITY</th>
	<th width="250px">CHECKIN Date</th>
	<th width="50px">Days</th>
	<th></th>
	</tr>
	    <?php
        	while($row = mysql_fetch_assoc($roomResult))
			{
        		echo '<form name="category" action="" method="post"/>';
        		echo '<tr>';
				echo '<td><img src="image/'.$row["roomImage"].'" alt="'.$row["roomName"].'" width="300" height="200"/></td>';
        		echo '<td><h3>NAME:  '.$row["roomName"].'<br><br>PRICE:  RM  '.$row["roomPrice"].'<br><br>Detail:  '.$row["roomDetail"].'</h3></td>';
        									
				echo '<td align="center"><input name="quantity" type="number"  min="1" max="10" value="1" size="2"></td>';		
				
        		echo '<td align="center"><input type="date" name="date"/></td>';
				echo '<td align="center"><input type="number" name="days" value="1" maxlength="2" min="1" max="30"/></td>';
				echo '<td align="center"><a href="payment.php"><span style="padding: 5px 9px"><input type="submit" name="cart" value="Add To Cart" /></a></td>';
				echo '</tr>';
        		echo '<input type="hidden" name="pid" value="'.$row["roomID"].'"/>';
				
        		echo '<input type="hidden" name="action" value="add"/>';
        		echo '</form>';
        	}
        ?>
	</table>	
</div>
</html>
