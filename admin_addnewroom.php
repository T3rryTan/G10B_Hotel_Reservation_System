<?php
/* ----------- ADMIN  ADD PAGE ----------------*/
include("dataconn.php");

if (!isset($_SESSION["adminID"]) || $_SESSION["adminID"] == null) {
    die("You are not admin, you cannot access this page");
}

$action = isset($_GET['action']) ? $_GET['action'] : 'add';

if (isset($_POST["add"])) {
    
    $roomName       = $_POST["roomName"];
    $hotelTypeID = $_POST["hotelTypeID"];
    $roomPrice      = $_POST["roomPrice"];
	$roomDetail     = $_POST["roomDetail"];
    
    $allowedExts = array(
        "gif",
        "jpeg",
        "jpg",
        "png"
    );
    $temp        = explode(".", $_FILES["file"]["name"]);
    $extension   = end($temp);

    if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/pjpeg") || ($_FILES["file"]["type"] == "image/x-png") || ($_FILES["file"]["type"] == "image/png")) && in_array($extension, $allowedExts)) {
        if ($_FILES["file"]["error"] > 0) {
            echo "Error: " . $_FILES["file"]["error"] . "<br>";
        } else {
            echo "Upload: " . $_FILES["file"]["name"] . "<br>";
            echo "Type: " . $_FILES["file"]["type"] . "<br>";
            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
            echo "Stored in: " . $_FILES["file"]["tmp_name"];

			$path = "image/" . $hotelTypeID;
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			$roomImage = $path . "/" . $_FILES["file"]["name"];

            if (file_exists($roomImage)) {
                echo $_FILES["file"]["name"] . " already exists. ";
            } else {
                move_uploaded_file($_FILES["file"]["tmp_name"], $roomImage);
                echo "Stored in: " . $roomImage;
            }
        }

        $db_image_path = $hotelTypeID.'/'.$_FILES["file"]["name"]; // without -> image/ <- folder for db
        mysql_query("INSERT INTO room(hotelTypeID, roomName,roomDetail, roomPrice, roomImage) VALUES ('$hotelTypeID','$roomName','$roomDetail','$roomPrice','$db_image_path')") or die(mysql_error());
    	$_SESSION['flash_msg'] = "Item Added";
    } else {
        echo "Invalid file";
    }
}
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="mainhotel.css">
    <link href="css.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<?php
    include("adminmenu.php");
?>

<form action="admin_addnewroom.php" method="post" name="edit_page" onsubmit="return validation()" enctype="multipart/form-data">
	<fieldset class="elements data-container">

    <?php
    if (isset($_SESSION['flash_msg']) && $_SESSION['flash_msg'] != NULL) {
        echo '<div class="alert">
                '.$_SESSION['flash_msg'].'
              </div>';
        $_SESSION['flash_msg'] = NULL;
    }
    ?>

    <!-- ======== ADD ========== -->
    <?php if($action == "add") { ?>
		<p><span style="font-size: 30px; font-weight: bold;">Add New Room</span>

		<br><div>
	      <label for="roomName">Room Name :</label><br>
	      <input type="text" id="roomName" name="roomName" size="50" placeholder="Enter item name" />
	    </div>

		<br><div>
	      <label for="hotelType">Hotel Type:</label><br>
	      <select name="hotelTypeID">
		 <?php
        $hotelTypeQuery = "SELECT * FROM hotel_type";
        $hotelResult = mysql_query($hotelTypeQuery) or die(mysql_error());

        while($row = mysql_fetch_assoc($hotelResult)){
            echo "<option value=".$row["hotelTypeID"]." name=\"hotelTypeID\">".$row["hotelTypeName"]."</option>";
        }
        ?>
        </select>
	    </div>
		
		<br><div>
	      <label for="roomPrice">Room Details:</label><br>
	      <input type="text" id="roomDetail" name="roomDetail" size="150" placeholder="room details" />
	    </div>
		
		<br><div>
	      <label for="roomPrice">Room Price (RM):</label><br>
	      <input type="number" id="roomPrice" name="roomPrice" size="30" placeholder="room price" />
	    </div>

		<br><div>
	        <label for="file">Image:</label>
			<input type="file" name="file" id="file">
		</div>
		<br><div class="submit">
	      <input type="submit" name="add" class="custom-button" value="Add" />
	    </div></br>
      <?php } ?>
  <!-- ======== ADD ========== -->

  
  <!-- ======== UPDATE ========== -->
  <?php if($action == "update") { ?>
  <p><span style="font-size: 30px; font-weight: bold;">Update Product</span>
  <?php } ?>
  <!-- ======== UPDATE ========== -->

	</fieldset>
</form>
