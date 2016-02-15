<?php
/* ----------- LOGIN PAGE ----------------*/
include("dataconn.php");
if(isset($_POST['login']))
{
    $error = array();
    //Declare An Array to store any error message
    if (empty($_POST['password']))
    {
        $error[] = 'Please Enter Your Password';
    }

    if (empty($_POST['id']))
    {
        $error[] = 'Please Enter Your Name';
    }
    else
    {
        $error[] = 'Your user name is invalid';
    }

	$userName = $_POST['id'];
	$password = $_POST['password'];
	
		$query = mysql_query("SELECT * FROM admin where adminName = '$userName' and adminPassword = '$password'") or die(mysql_error());
	
		if($row=mysql_fetch_assoc($query))
		{
			//session_start();
			//ob_start();
			$_SESSION["adminID"]=$row["adminID"];
			$_SESSION["userName"]=$row["adminName"];
			$_SESSION["login"]=true;
			echo "<script>window.location = 'admin_home.php'</script>";
      exit;
		} else 
		{
            $_SESSION['flash_msg'] = "User ID / Password wrong";
		}
}

if(isset($_POST['getDetail']))
{
	$userName = $_POST['userName'];	
	$queryName = mysql_query("select userName, userPassword from user where name = '$userName' and delStatus=1");
	if($rowName = mysql_fetch_assoc($queryName))
	{
		$userName = $rowName['userName'];
		$userPassword = $rowName['userPassword'];
	}
}
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="mainhotel.css">
    <link href="css.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        .login
        {
            text-align: center;
            font-size: 15px;
        }
    </style>
    <script>
    function validation()
    {
      var id = document.forms["admin_login_page"]["id"].value;
      var password = document.forms["admin_login_page"]["password"].value;

      if(id == "" || !isNaN(id))
      {
        alert("Please enter the correct name");
        return false;
      }

      if(password == "" || password.length <6 || password.length >15)
      {
        alert("Password must be between 6 and 15 characters");
        return false;
      }
    }
    </script>
</head>
<body>
<?php
    include("adminmenu0.php");
?>

    <form action="admin_login.php" method="post" name="admin_login_page" onsubmit="return validation()">
        <fieldset class="login data-container">

            <?php
            if (isset($_SESSION['flash_msg']) && $_SESSION['flash_msg'] != NULL) 
			{
                echo '<div class="alert">
                    '.$_SESSION['flash_msg'].'
                  </div>';
                $_SESSION['flash_msg'] = NULL;
            }
            ?>

           <div>
				<p>Name :</p>
				<p><input type="text" id="id" name="id" size="30" placeholder="Enter your name" size="30" maxlength="30"/></p>
				<p>Password:</p>
				<p><input type="password" id="password" name="password" size="30" placeholder="Enter your password" size="30" maxlength="30"/></p>
            </div>
			


            <br><div class="submit">
             <input type="submit" name="login" class="custom-button" value="Login" />
            </div></br>
        </fieldset>
    </form>
    </body>
</html>
