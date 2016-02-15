<?php 
/* ----------- ADMIN VIEW & UPDATE ORDER PAGE ----------------*/
include("dataconn.php");

// get order
$sql = "SELECT * FROM orders"; 
$orders_result = mysql_query($sql) or die(mysql_error());
$order_id = isset($_GET['oid']) ? $_GET['oid'] : null; //the order id
$action = isset($_GET['action']) ? $_GET['action'] : null; //the action

if(isset($order_id) && isset($action))
{
	if($action == 'delivered')
	{
		$sql = "UPDATE orders SET orderProcess = 'delivered' WHERE orderID = $order_id"; 
		$update_result = mysql_query($sql) or die(mysql_error());
		
		if($update_result)
		{
			header("Location: admin_view_order.php");
		}
	}
	
	if($action == 'undelivered')
	{
		$sql = "UPDATE orders SET orderProcess = 'undelivered' WHERE orderID = $order_id"; 
		$update_result = mysql_query($sql) or die(mysql_error());
		
		if($update_result)
		{
			header("Location: admin_view_order.php");
		}
	}
}
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="mainhotel.css">
    <link href="css.css" rel="stylesheet" type="text/css"/>
	<style type="text/css">
	y{text-align:left;}
	h4{text-align:left;}
	</style>
</head>
<body>

<?php
	include("adminmenu.php");
?>

<?php 

 if(mysql_num_rows($orders_result) > 0)
 { 

    while($ordersInfo = mysql_fetch_assoc($orders_result))
	{
            $order_array = array();
            //var_dump($row);
            $order_id = $ordersInfo['orderID'];
            $sql = "SELECT * FROM order_room WHERE orderID = $order_id"; 
            $order_item_result = mysql_query($sql) or die(mysql_error());

            while($orderItemInfo = mysql_fetch_assoc($order_item_result))
			{
                 $order_array['cart'][$orderItemInfo['roomID']] = $orderItemInfo['orderRoomQuantity'];
				$order_array['date'][$orderItemInfo['roomID']] = $orderItemInfo['date'];
				$order_array['days'][$orderItemInfo['roomID']] = $orderItemInfo['days'];
            }

             $total = 0;
            echo "<table border=\"1\" padding=\"3\" width=\"100%\" class=\"data-container\">";
			?>
			<tr id="y">
			<?php
			echo "<td colspan=\"7\"><h4>Order ID  : $order_id <br>Order Date : $ordersInfo[orderDateTime]<br>User Name : $ordersInfo[username]<br>Status : $ordersInfo[orderStatus]</h4></td>";
			?>

			</tr>
			
<tr>
<td style="background-color:transparent;border:1px black solid;text-align:center;vertical-align:top;width:10%"><div><span style="color:#000000;font-family:Arial;font-size:19px;">No</span></div>
<td style="background-color:transparent;border:1px black solid;text-align:center;vertical-align:top;width:30%"><div><span style="color:#000000;font-family:Arial;font-size:19px;">ROOM Name</span></div>
<td style="background-color:transparent;border:1px black solid;text-align:center;vertical-align:top;width:20%"><div><span style="color:#000000;font-family:Arial;font-size:19px;">date</span></div>
<td style="background-color:transparent;border:1px black solid;text-align:center;vertical-align:top;width:10%"><div><span style="color:#000000;font-family:Arial;font-size:19px;">days</span></div>
<td style="background-color:transparent;border:1px black solid;text-align:center;vertical-align:top;width:10%"><div><span style="color:#000000;font-family:Arial;font-size:19px;">quantity</span></div>
<td style="background-color:transparent;border:1px black solid;text-align:center;vertical-align:top;width:20%"><div><span style="color:#000000;font-family:Arial;font-size:19px;">cost</span></div>
</td>
</tr>
<?php

$number=1;
            //iterate through the cart, the $product_id is the key and $quantity is the value
            foreach($order_array['cart'] as $product_id => $quantity) {}
			foreach($order_array['date'] as $product_id => $date) {}
			foreach($order_array['days'] as $product_id => $days)
			{ 

                //get the name, description and price from the database - this will depend on your database implementation.
                //use sprintf to make sure that $product_id is inserted into the query as a number - to prevent SQL injection
                $sql = sprintf("SELECT * FROM room WHERE roomID = %d;", $product_id); 

                $result = mysql_query($sql);

                //Only display the row if there is a product (though there should always be as we have already checked)
                if(mysql_num_rows($result) > 0) 
				{

                    $roomInfo = mysql_fetch_assoc($result);

                    $cost = $roomInfo["roomPrice"] * $quantity *$days;
                    $total = $total + $cost; //add to the total cost
					$cost = number_format ($cost, 2);
					$total = number_format ($total, 2);

                    echo "<tr>";
					echo "<td align=\"center\">".$number++."</td>";
                    //show this information in table cells
                    echo "<td align=\"center\">".$roomInfo["roomName"]."</td>";
					 echo "<td align=\"center\">$date </td>";
					  echo "<td align=\"center\">$days </td>";
                    //along with a 'remove' link next to the quantity - which links to this page, but with an action of remove, and the id of the current product
                    echo "<td align=\"center\">$quantity </td>";
                    echo "<td align=\"center\">RM $cost </td>";
                    echo "</tr>";
                }
            }

            //show the total
            echo "<tr>";
            echo "<td colspan=\"4\" ></td>";
            echo "<td align=\"center\">Total</td>";
            echo "<td colspan=\"1\" align=\"center\">RM $total</td>";
            echo "</tr>";
            echo "</table>";

			
        }
	?>


<?php
}else{
//otherwise tell the user they have no items in their cart
    echo "You do not have any orders";
} 
?>
</html>
