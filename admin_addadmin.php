<html>
<?php
/* ----------- REGISTER PAGE ----------------*/
include("dataconn.php");

if(isset($_POST["add"]))
{
$adminFullname = mysql_real_escape_string($_POST['adminFullname']);
$adminName = mysql_real_escape_string($_POST['adminName']);
$adminPassword = mysql_real_escape_string($_POST['adminPassword']);
$repeatpassword = mysql_real_escape_string($_POST['repeatpassword']);
$adminEmail = mysql_real_escape_string($_POST['adminEmail']);
$password = md5($password);

$vname=mysql_query("select * from admin where adminName='$adminName'");
	if(mysql_num_rows($vname)>0)
	{
	echo "adminName already exist";
}
else{

	
	$reg= "INSERT INTO admin(adminFullname,adminName,adminPassword,adminEmail) VALUES('$adminFullname','$adminName','$adminPassword','$adminEmail')";
	//echo $reg;
	$regcommand = mysql_query($reg) or die(mysql_error());
	
	if($regcommand)
	{
    $_SESSION['flash_msg'] = "You have been successfully added";
		header("Location:adminhome.php");
	}
	}
}
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="mainhotel.css">
    <link href="css.css" rel="stylesheet" type="text/css"/>
    <script>
	
    function validation()
    {
      var adminFullname = document.forms["registration_page"]["adminFullname"].value;
      var adminName = document.forms["registration_page"]["adminName"].value;
      var adminPassword = document.forms["registration_page"]["adminPassword"].value;
	  var repeatpassword = document.forms["registration_page"]["repeatpassword"].value;
	  var adminEmail = document.forms["registration_page"]["adminEmail"].value;
	  

	  
      if(adminFullname == "" || !isNaN(adminFullname))
      {
        alert("Please enter the correct adminFullname");
        return false;
      }
    if(adminName == "" || !isNaN(adminName))
      {
        alert("Please enter the correct AdminName");
        return false;
      }
	  
      if(adminPassword == "" || adminPassword.length <6 || adminPassword.length >15)
      {
        alert("Password must be between 6 and 15 characters");
        return false;
      }
	  
	  if (adminPassword != repeatpassword) 
      {
        alert("Password and Confirm Password was not same");
        return false;
      }
	  

    }
    </script>

</head>
<body>

<?php
    include("adminmenu.php");
?>

     <form action="admin_addadmin.php" method="post" name="registration_page" onsubmit="return validation()">
       <div class="data-container">
            
          <center>
		   <table>
		   <p><span style="font-size: 30px; font-weight: bold;">Create a New Admin Account</span>
				<tr>
   <td style="height:20px"><font color="red">*</font>Name:</td>
   <td style="text-align:left"><input class="signupform_text" name="adminFullname" type="text" id="adminFullname" style="width:150px;height:18px;"><span id="username_status"></td>
</tr>
<tr>
   <td style="height:20px"><font color="red">*</font>admin Name:</td>
   <td style="text-align:left"><input class="signupform_text" name="adminName" type="text" id="adminName" style="width:150px;height:18px;"><span id="username_status"></td>
</tr>
<tr>
   <td style="height:20px;"><font color="red">*</font>Password:</td>
   <td style="text-align:left"><input class="signupform_text" name="adminPassword" type="password" id="adminPassword" onkeyup="chkCase(this)" style="width:150px;height:18px;"><span id="password_status"></td>
</tr>
<tr>
   <td style="height:20px;"><font color="red">*</font>Confirm Password:</td>
   <td style="text-align:left"><input class="signupform_text" name="repeatpassword" type="password" id="repeatpassword" onkeyup="chkCase(this)" style="width:150px;height:18px;"><span id="verifynote" class="warn hidden"></span></td>
</tr>
<tr>
   <td style="height:20px"><font color="red">*</font>E-mail:</td>
   <td style="text-align:left"><input class="signupform_text" name="adminEmail" type="email" id="adminEmail" style="width:150px;height:18px;"><span id="email_status"></td>
</tr>

</div>
			
            <br><div class="submit">
             <input type="hidden" name="submit" value="TRUE" />
             <input type="submit" name="add"  class="custom-button" value="Register"/>
			 <input type="reset" name="reset" class="custom-button" value="Reset"/>
            </div></br>
			
        </fieldset>
    </form>

    </body>
</html>
