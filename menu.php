<?php
/* ----------- MEMBER MENU PAGE ----------------*/
include_once("dataconn.php");
$current_path = basename($_SERVER['PHP_SELF']);
$categoryTypeQuery = "SELECT * FROM hotel_type";
$categoryResult = mysql_query($categoryTypeQuery) or die(mysql_error());

?>
<div class=one><img src="image/tgif-950x950.jpg" alt="tgif" style="width:180px;height:150px;">


</div>
<div id='cssmenu'>
  <ul>
        <li><a <?php echo ($current_path == 'mainhotel.php' ? 'class="active"' : '') ?> href='mainhotel.php'><span>Home</span></a></li>
        <?php
        if(!isset($_SESSION["login"]) || $_SESSION["login"] == false)
		{
        ?>
            <li><a <?php echo ($current_path == 'login.php' ? 'class="active"' : '') ?> href='login.php'><span>Login</span></a></li>
            <li><a <?php echo ($current_path == 'register.php' ? 'class="active"' : '') ?> href='register.php'><span>Register</span></a></li>
        <?php
        }
        ?>

        <li <?php echo ($current_path == 'category' ? 'class="active"' : '') ?> class='has-sub'><a href='#'><span>Bill</span></a>
            <ul>
                <?php
                while($row = mysql_fetch_assoc($categoryResult))
				{
                    //var_dump($category);
                    echo "<li class='has-sub'><a href='category0.php?id=".$row["hotelTypeID"]."'><span>".$row["hotelTypeName"]."</span></a></li>";
                }
                ?>
				
            </ul>
        </li>

        <?php
        if(isset($_SESSION["login"]) && $_SESSION["login"]){
        ?>
            <li><a <?php echo ($current_path == 'order.php' ? 'class="active"' : '') ?> href='order.php'><span>Order Status</span></a></li>
            <li><a <?php echo ($current_path == 'edit.php' ? 'class="active"' : '') ?> href='edit.php'><span>Edit Profile</span></a></li>
        <?php
        }
        ?>
       
		<li><a <?php echo ($current_path == 'contactus.php' ? 'class="active"' : '') ?> href='contactus.php'><span>Contact Us</span></a></li>

        <?php
        if(isset($_SESSION["login"]) && $_SESSION["login"]){
        ?>
            <li><a href='logout.php'><span>Logout</span></a></li>
        <?php
        }
        ?>
    </ul>
</div>
