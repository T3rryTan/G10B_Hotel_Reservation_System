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
        <li><a <?php echo ($current_path == 'mainhotel0.php' ? 'class="active"' : '') ?> href='mainhotel0.php'><span>HOME</span></a></li>
        <?php
        if(!isset($_SESSION["login"]) || $_SESSION["login"] == false)
		{
        ?>
            <li><a <?php echo ($current_path == 'login page.php' ? 'class="active"' : '') ?> href='login page.php'><span>LOGIN</span></a></li>
            <li><a <?php echo ($current_path == 'register.php' ? 'class="active"' : '') ?> href='register.php'><span>REGISTER</span></a></li>
			
        <?php
        }
        ?>
		<li><a <?php echo ($current_path == 'hotel0.php' ? 'class="active"' : '') ?> href='hotel0.php'><span>HOTEL</span></a></li>
		<li <?php echo ($current_path == 'room0.php' ? 'class="active"' : '') ?> class='has-sub'><a href='#'><span>ROOM</span></a>
            <ul>
                <?php
                while($row = mysql_fetch_assoc($categoryResult))
				{
                    //var_dump($category);
                    echo "<li class='has-sub'><a href='room0.php?id=".$row["hotelTypeID"]."'><span>".$row["hotelTypeName"]."</span></a></li>";
                }
                ?>
				
            </ul>
        </li>
       
		<li><a <?php echo ($current_path == 'contactus0.php' ? 'class="active"' : '') ?> href='contactus0.php'><span>Contact Us</span></a></li>

        
    </ul>
</div>

