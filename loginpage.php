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
 <form action="Login Page.php" method="post" name="login_page" onsubmit="return validation()">
<link rel="stylesheet" type="text/css" href="admin.css">

</head>

<body>


<ul> 
  <li style="float:left; padding-left:1%;"><img src="image/tgif.png" height="40" width="110"></li>
  <li style="font-size:15px";><a href="register.php"><b>Sign Up</b></a></li>
</ul>


<center>
<div class="divlogin">
<form action="demo_form.asp" method="get">
<h1><b>Welcome to Tgif Hotel Reservation System</b></h1>
<p><b>Username:</b></p>
<p><input type="text" name="username"></p>
<p><b>Password:</b></p>
<p><input type="password" name="password"></p>
<p><input type="submit" name="login" class="custom-button" value="Login" /><button type="reset" value="Reset">Reset</button></p>
</form>
</div>
</div>
</center>
</body>
</html>
