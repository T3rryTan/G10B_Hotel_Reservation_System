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

			
            <li><a <?php echo ($current_path == 'login.php' ? 'class="active"' : '') ?> href='admin_login.php'><span>Login</span></a></li>

		
    </ul>
</div>
