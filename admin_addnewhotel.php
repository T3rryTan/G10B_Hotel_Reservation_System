<?php
/* ----------- ADMIN  ADD PAGE ----------------*/
include("dataconn.php");
if (!isset($_SESSION["adminID"]) || $_SESSION["adminID"] == null) {
    die("You are not admin, you cannot access this page");
}
$action = isset($_GET['action']) ? $_GET['action'] : 'add';
if (isset($_POST["add"])) {
    
    $hotelTypeName       = $_POST["hotelTypeName"];
    
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
			$path = "image/";
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$hotelTypeImage = $path . "/" . $_FILES["file"]["name"];
            if (file_exists($hotelTypeImage)) {
                echo $_FILES["file"]["name"] . " already exists. ";
            } else {
                move_uploaded_file($_FILES["file"]["tmp_name"], $hotelTypeImage);
                echo "Stored in: " . $hotelTypeImage;
            }
        }
        $db_image_path ='/'.$_FILES["file"]["name"]; // without -> image/ <- folder for db
        mysql_query("INSERT INTO hotel_type(hotelTypeName, hotelTypeImage) VALUES ('$hotelTypeName', '$db_image_path')") or die(mysql_error());
    	$_SESSION['flash_msg'] = "Item Added";
    } else {
        echo "Invalid file";
    }
}
?>

<html>
<head>
    <link href="addnewhotel.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<?php
    include("adminmenu.php");
?>

<form action="admin_addnewhotel.php" method="post" name="edit_page" onsubmit="return validation()" enctype="multipart/form-data">
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
		
<div class=one><img src="image/tgif-950x950.png" alt="tgif" style="width:180px;height:150px;"  >
</div>		
		<p class=name1>Add New Hotel</p>
		
		
		<div class=two>
	      <label for="hotelTypeName">New Hotel Name :</label><br>
	      <input type="text" id="hotelTypeName" name="hotelTypeName" size="30" placeholder="Enter item name" />
	    </div>
		<br>
		
		<div class=file1>
	        <label for="file">Image:</label>
			<input type="file" name="file" id="file">
			
		</div>
		<br>
		<div class=submit1>
	      <input type="submit" name="add" class="custom-button" value="Add" />
			<button type="reset" value="Reset">Reset</button>
		</div>
		</br>
      <?php } ?>
  <!-- ======== ADD ========== -->

  
  <!-- ======== UPDATE ========== -->
  <?php if($action == "update") { ?>
  <p class=update1>Update Product</p>
  <?php } ?>
  <!-- ======== UPDATE ========== -->

	</fieldset>
</form>
</body>
</html>
