<?php
/* -----------ADMIN HOME PAGE ----------------*/
include("dataconn.php");
?>

<html>
<head>
    <link href="css.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="mainhotel.css">
	</head>
<body>
<?php
	include("adminmenu.php");
?>
	<?php
        if(!isset($_SESSION["login"]) || $_SESSION["login"] == false)
		{
    ?>
	<div>
		<p><span style="margin-left:20px; font-size: 20px;">Welcome, Guest</span>
	</div>
	<?php
	} else {
	?>
		<p><span style="margin-left:20px; font-size: 20px;">Welcome, <?php echo $_SESSION["userName"] ?></span></p>
	<?php
	}
	?>
	<div class=section>
<div>
		<form>
			<p><img src="image/457014621_orig.png" style=" width: 100%; height: 500px" alt="image" </a></p>
			
		</form>
	</div>
</div>

</body>
</html>
