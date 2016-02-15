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

    if (empty($_POST['username']))
    {
        $error[] = 'Please Enter Your Name';
    }
    else
    {
        $error[] = 'Your user name is invalid';
    }

	$username = $_POST['username'];
	$password = md5($_POST['password']);
	
		$query = mysql_query("SELECT * FROM user where username = '$username' and password = '$password'") or die(mysql_error());
	
		if($row=mysql_fetch_assoc($query))
		{
			//session_start();
			//ob_start();
			$_SESSION["id"]=$row["id"];
			$_SESSION["username"]=$row["username"];
			$_SESSION["login"]=true;
			echo "<script>window.location = 'mainhotel.php'</script>";
      exit;
		}
		else
		{
            $_SESSION['flash_msg'] = "User ID / Password wrong";
		}	
}

if(isset($_POST['getDetail']))
{
	$username = $_POST['username'];	
	$queryName = mysql_query("select username, password from user where username = '$username' and delStatus=1");
	if($rowName = mysql_fetch_assoc($queryName))
	{
		$username = $rowName['username'];
		$password = $rowName['password'];
	}
}
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="mainhotel.css">
    <link href="admin.css" rel="stylesheet" type="text/css"/>
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
      var username = document.forms["login_page"]["username"].value;
      var password = document.forms["login_page"]["password"].value;

      if(username == "" || !isNaN(username))
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
include("menu0.php");
?>
    <form action="Login Page.php" method="post" name="login_page" onsubmit="return validation()">
        <box class="boxlogin">
	

            <?php
            if (isset($_SESSION['flash_msg']) && $_SESSION['flash_msg'] != NULL) 
			{
                echo '<div class="alert">
                    '.$_SESSION['flash_msg'].'
                  </div>';
                $_SESSION['flash_msg'] = NULL;
            }
            ?>
</box>



<center>
<div class="divlogin">
<h1><b>Welcome to Tgif Hotel Reservation System</b></h1>
<p><b>Username:</b></p>
<p><input name="username" type="text" id="username"></p>
<p><b>Password:</b></p>
<p><input name="password" type="password" id="password"></p>
<p><input type="submit" name="login" class="custom-button" value="Login" /><button type="reset" value="Reset">Reset</button></p>
</form>
</div>
</div>
</center>
</body>
</html>
