<?php
/* ----------- ADMIN MENU PAGE ----------------*/
include_once("dataconn.php");
$current_path = basename($_SERVER['PHP_SELF']);
$hotelTypeQuery = "SELECT * FROM hotel_type";
$hotelResult = mysql_query($hotelTypeQuery) or die(mysql_error());

?>

<<div class=one><img src="image/tgif-950x950.jpg" alt="tgif" style="width:180px;height:150px;"></div>
<div id='cssmenu'>
    <ul>
		<li><a <?php echo ($current_path == 'admin_home.php' ? 'class="active"' : '') ?> href='admin_home.php'><span>Home</span></a></li>
        <?php
        if(!isset($_SESSION["login"]) || $_SESSION["login"] == false)
		{
        ?>
			
            <li><a <?php echo ($current_path == 'login.php' ? 'class="active"' : '') ?> href='admin_login.php'><span>Login</span></a></li>
        <?php
        }
        ?>
		<?php
		if(isset($_SESSION["login"]) && $_SESSION["login"])
		{
        ?>
			<li><a <?php echo ($current_path == 'admin_addadmin.php' ? 'class="active"' : '') ?> href='admin_addadmin.php'><span>Add admin</span></a>
			<li><a <?php echo ($current_path == 'admin_addnewhotel.php' ? 'class="active"' : '') ?> href='admin_addnewhotel.php'><span>Add New Hotel</span></a>
			<li><a <?php echo ($current_path == 'admin_addnewroom.php' ? 'class="active"' : '') ?> href='admin_addnewroom.php'><span>Add New Room</span></a>
			<li><a <?php echo ($current_path == 'admin_view_hotel.php' ? 'class="active"' : '') ?> href='admin_view_hotel.php'><span>View Hotel</span></a>
			<li><a <?php echo ($current_path == 'admin_view_product.php' ? 'class="active"' : '') ?> href='#'><span>View Room</span></a>
            <ul>
            <?php
                while($row = mysql_fetch_assoc($hotelResult))
				{
                    //var_dump($hotel);
                    echo "<li class='has-sub'><a href='admin_view_product.php?id=".$row["hotelTypeID"]."'><span>".$row["hotelTypeName"]."</span></a></li>";
                }
             ?>
            </ul>
		<?php
		}
        ?>
        <?php
        if(isset($_SESSION["login"]) && $_SESSION["login"])
		{
        ?>
            <li><a <?php echo ($current_path == 'admin_view_order.php' ? 'class="active"' : '') ?> href='admin_view_order.php'><span>View</span></a></li>
        <?php
        }
        
		if(isset($_SESSION["login"]) && $_SESSION["login"])
		{
        ?>
            <li><a href='admin_logout.php'><span>Logout</span></a></li>
        <?php
        }
        ?>
    </ul>
</div>
