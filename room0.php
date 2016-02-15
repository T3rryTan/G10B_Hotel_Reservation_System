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
