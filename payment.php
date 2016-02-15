<?php 
/* ----------- ADD TO CART PAGE ----------------*/
include("dataconn.php");
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="mainhotel.css">
    <link href="css.css" rel="stylesheet" type="text/css"/>

	<style type="text/css">
	th {
    height: 50px;
	background-color: black;
	color:white;
	}
	
	p{align:right;}
	</style>
	<script>
		function validation()
		{
            var card_number = document.forms["payment"]["orderCreditcard"].value;
			if(card_number == "" || card_number.length <15 || card_number.length >17 || isNaN(card_number))
			{
				alert("Credit Card number must be in 16 digit");
				return false;
			} 
		}
	</script>
</head>
<body>

	<?php
    include("menu.php");
    ?>
	<div>

<?php 

$product_id = isset($_GET['pid']) ? $_GET['pid'] : null; //the product id
$action = isset($_GET['action']) ? $_GET['action'] : null; //the action

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


//------- for checkout ---------
if(isset($_POST['submit']) && $_POST['submit'] == "Pay Bill" && isset($_SESSION['cart']) && $_SESSION['cart']) 
{
    // insert order
    $sql = "INSERT INTO orders(id,username, orderStatus, orderDateTime, orderCreditCard, orderCCV) VALUES ('$_SESSION[id]','$_SESSION[username]', 'paid', NOW(), '$_POST[card_number]', '$_POST[CCV]')"; 
    mysql_query($sql) or die(mysql_error());
    $order_id = mysql_insert_id();

    foreach($_SESSION['cart'] as $product_id => $quantity){}
	foreach($_SESSION['days'] as $product_id => $days){}
	foreach($_SESSION['date'] as $product_id=> $date)
	{ 

        $sql = sprintf("SELECT * FROM room WHERE roomID = %d;", $product_id); 
		
        $result = mysql_query($sql);

        if(mysql_num_rows($result) > 0) 
		{
            $roomInfo = mysql_fetch_assoc($result);
            $cost = $roomInfo["roomPrice"] * $quantity *$days;
        }

        $sql = "INSERT INTO order_room(orderID, roomID, orderRoomPrice, orderRoomQuantity, date, days) VALUES ('$order_id', '$product_id','$cost', '$quantity','$date','$days')"; 
        $result = mysql_query($sql) or die(mysql_error());

        if($result)
		{
            unset($_SESSION['cart']); // empty cart
			unset($_SESSION['date']);
			unset($_SESSION['days']);
        }
    }
	
}
//------- /for checkout ---------
if(isset($_SESSION['cart']) && $_SESSION['cart']) { //if the cart isn't empty show the cart

	$total = 0;
	
    echo "<table border=\"1\" padding=\"3\" width=\"100%\" class=\"data-container\">"; //format the cart using a HTML table
	//show the empty cart link - which links to this page, but with an action of empty. A simple bit of javascript in the onlick event of the link asks the user for confirmation

	 echo "<td colspan=\"6\"align=\"right\"><a href=\"$_SERVER[PHP_SELF]?action=empty\" onclick=\"return confirm('Are you sure?');\"><img src=\"image/delete.png\"/></a></td>";
	 ?>
<tr>
<th></th>
<th>ROOM NAME</th>
<th>CHECKIN DATE</th>
<th>DAYS</th>
<th>QUANTITY</th>
<th>TOTAL</th>
<tr>
<?php
    //iterate through the cart, the $product_id is the key and $quantity is the value
    foreach($_SESSION['cart'] as $product_id => $quantity) 
	{ 

        //get the name, description and price from the database - this will depend on your database implementation.
        //use sprintf to make sure that $product_id is inserted into the query as a number - to prevent SQL injection
        $sql = sprintf("SELECT * FROM room WHERE roomID = %d;", $product_id); 

        $result = mysql_query($sql);

        //Only display the row if there is a product (though there should always be as we have already checked
        if(mysql_num_rows($result) > 0)
		{

            $roomInfo = mysql_fetch_assoc($result);
			$date = $_SESSION['date'][$product_id];
			$days = $_SESSION['days'][$product_id];
            $cost = $roomInfo["roomPrice"] * $quantity * $days;
			
            $total = $total + $cost; //add to the total cost
			
			
            echo "<tr>";
            echo "<td align=\"center\"><a href=\"$_SERVER[PHP_SELF]?action=remove&pid=$product_id\"><img src=\"image/remove.png\"/></a></td>";
            //show this information in table cells
            echo "<td align=\"center\">".$roomInfo["roomName"]."</td>";
			echo "<td align=\"center\">$date </td>";
			echo "<td align=\"center\">$days </td>";
            //along with a 'remove' link next to the quantity - which links to this page, but with an action of remove, and the id of the current product
            echo "<td align=\"center\">$quantity </td>";
            echo "<td align=\"center\">RM $cost</td>";
            echo "</tr>";
        }
    }

    //show the total
    echo "<tr>";
	echo "<td colspan=\"4\" ></td>";
    echo "<td align=\"center\">Total</td>";
    echo "<td colspan=\"2\" align=\"center\">RM $total</td>";
    echo "</tr>";
    echo "</table>";
	?>
	<div style='background: #f2f2f2;'>
	<br>
	<div>
	<span style="margin-left: 88%"><a href="hotel.php"><input type="submit" name="shopping_more"  class="custom-button" value="Back To Shopping"/></a></span>
	</div>
	
	<script>
	//checkout alert message
	function confirmCheckout()
	{
		alert("Please Register or Login first");
	}
	</script>
	

    <form name="payment" action="" method="post" onsubmit="return validation()">
		<?php
        if(!isset($_SESSION["login"]) || $_SESSION["login"] == false)
		{
            //alert message where user haven't register and login
			echo '<p span style="margin-left: 90%"/><input type="submit" name="checkout"  class="custom-button" value="Checkout" onclick="return confirmCheckout()"/>';
			
        } 
		else
		{
			
		?>
		
		<script>
		//validation credit card number
		function isNumber(evt) 
		{
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57))
		{
			return false;
		}
			return true;
		}
		</script>		
		
		<?php
		echo '<table>';
		echo '<tr>';
		echo '<td><h2><img src="image/card.gif">Credit Card Information</h2></td>';
		echo '</tr>';
		
		//credit card number
		echo '<tr>';
		echo '<td>Credit Card Number : </td>';
		echo '<td><input type="text" name="card_number" width="50" onkeypress="return isNumber(event)"  pattern=".{16,16}" maxlength="16" title="16 digits required" placeholder="XXXXXXXXXXXX" required /></td>';
		echo '</tr>';
		
		//card code verification
		echo '<tr>';
		echo '<td>Card Code Verification : </td>';
		echo '<td><input type="text" name="CCV" placeholder="XXX" maxlength="3" required></td>';
		echo '</tr>';
		
		//card valid date
		echo '<tr>';
		echo '<td>Card Valid Date : </td>';
		echo '<td><select name="valid_date" cols="30" rows="31">
				<option value="1">1</option>							
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>							
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
				<option value="25">25</option>
				<option value="26">26</option>
				<option value="27">27</option>
				<option value="28">28</option>
				<option value="29">29</option>
				<option value="30">30</option>
				<option value="31">31</option>';
		echo '</tr>';
		
		//card valid year
		echo '<tr>';
		echo '<td>Card Valid Year</td>';
		echo '<td><select name="valid_year" cols="30" rows="11">
				<option value="10">10</option>							
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				</select></td>';
		echo '</tr>';
		
		//card type	
		echo '<tr>';				
		echo '<td>Card Type :  </td>';
		echo '<td><select name="type" cols="30" rows="3">
						<option value="Master">Master Card</option>
						<option value="Visa">Visa Card</option>
						</select></td>';
		echo '</tr>';	
		echo '</table>';				
		
		echo '<h3>Total Price :';
		echo '<input = "text" width="20" value="RM '.$total.'" readonly></h3>'; // make a text field non editable or readonly
		echo '<p span style="margin-left: 5%"/><input type="submit" name="submit" class="custom-button" value="Pay Bill" ></p>';
}		
		?>   
			
		<?php
		}
		else
		{
			//otherwise tell the user they have no items in their checkout
			echo '<span style="font-size: 15px; "/>You have no items in your checkout.<br>Please go to orderStatus to check your order.';
		} 
		?>
	</form>
	</div>
	</div>
	</body>
</html>
