<?php
/* ----------- EDIT PAGE ----------------*/
include("dataconn.php");
?>
<?php
	if(isset($_POST["save"]))
	{
		$fullname = mysql_real_escape_string($_POST['fullname']);
$username = mysql_real_escape_string($_POST['username']);
$password = mysql_real_escape_string($_POST['password']);
$repeatpassword = mysql_real_escape_string($_POST['repeatpassword']);
$phone = mysql_real_escape_string($_POST['phone']);
$email = mysql_real_escape_string($_POST['email']);
$gender = mysql_real_escape_string(@$_POST['gender']);
$birthday = mysql_real_escape_string($_POST['birthday']);
$address = mysql_real_escape_string($_POST['address']);
$s_question = mysql_real_escape_string($_POST['s_question']);
$s_answer = mysql_real_escape_string($_POST['s_answer']);
$password = md5($password);

if(isset($_SESSION["id"]) && $_SESSION["id"] != null){
			mysql_query("UPDATE user SET password='$password',phone='$phone',birthday='$birthday',address='$address',s_question='$s_question',s_answer='$s_answer' where id=".$_SESSION["id"]."");
			}
 $_SESSION['flash_msg'] = "You profile has been successfully updated";
}

  if(isset($_SESSION["id"]) && $_SESSION["id"] != null)
  {
    $userQuery = "SELECT * FROM user WHERE id = ".$_SESSION["id"]." LIMIT 1";
    $userResult = mysql_query($userQuery) or die(mysql_error());
    $userInfo = mysql_fetch_assoc($userResult);
    $fullname = $userInfo["fullname"];
    $username =  $userInfo["username"];
    $password = $userInfo["password"];
	$repeatpassword = $userInfo["password"];
    $phone =  $userInfo["phone"];
    $email = $userInfo["email"];
	$gender = $userInfo["gender"];
    $birthday =  $userInfo["birthday"];
    $address = $userInfo["address"];
	$s_question=$userInfo["s_question"];
	$s_answer=$userInfo["s_answer"];
  }

?>

<html>
<head>

    <style type="text/css">
        .elements
        {
            text-align: left;
            font-size: 15px;
        }
    </style>
   <link rel="stylesheet" type="text/css" href="mainhotel.css">


    <link href="css.css" rel="stylesheet" type="text/css"/>
        <script>
       function validation()
    {
      var fullname = document.forms["edit_page"]["fullname"].value;
      var username = document.forms["edit_page"]["username"].value;
      var password = document.forms["edit_page"]["password"].value;
	  var repeatpassword = document.forms["edit_page"]["repeatpassword"].value;
      var phone = document.forms["edit_page"]["phone"].value;
	  var email = document.forms["edit_page"]["email"].value;
      var gender = document.forms["edit_page"]["gender"].value;
      var birthday = document.forms["edit_page"]["birthday"].value;
      var address = document.forms["edit_page"]["address"].value;
	  var s_answer = document.forms["edit_page"]["s_answer"].value;
      var s_question = document.forms["edit_page"]["s_question"].value;
	  
      if(fullname == "" || !isNaN(fullname))
      {
        alert("Please enter the correct fullname");
        return false;
      }
    if(username == "" || !isNaN(username))
      {
        alert("Please enter the correct username");
        return false;
      }

      if(password == "" || password.length <6 || password.length >15)
      {
        alert("Password must be between 6 and 15 characters");
        return false;
      }
	  
	  if (password != repeatpassword) 
      {
        alert("Password and Confirm Password was not same");
        return false;
      }
	  
	  if(phone == "" || phone.length <=9 || phone.length >11 || isNaN(phone))
      {
        alert("phone must have 10 digit");
        return false;
      } 

      var atpos = email.indexOf("@");
      var dotpos = email.lastIndexOf(".");

      if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
      {
        alert("Please enter the correct email");
        return false;
      }
	  
	   if(gender == "" || !isNaN(gender))
      {
        alert("Please enter the gender");
        return false;
      }
	  
	  
	  if(s_answer == "" || !isNaN(s_answer))
      {
        alert("Please enter the Security answer");
        return false;
      }


    }
    </script>
</head>
<body>
<?php
    include("menu.php");
?>


     <form action="edit.php" method="post" name="edit_page" onsubmit="return validation()">
        <fieldset class="elements data-container">
            <p><span style="font-size: 30px; font-weight: bold;">Edit Account</span>
            
           <div>
		   <table class=t1;>
				<tr>
   <td style="height:20px"><font color="red">*</font>Name:</td>
   <td style="text-align:left"><input class="signupform_text" name="fullname" type="text" id="fullname"  value="<?php echo $userInfo["fullname"]?>" style="width:150px;height:18px;"></td>
</tr>
<tr>
   <td style="height:20px"><font color="red">*</font>User Name:</td>
   <td style="text-align:left"><input class="signupform_text" name="username" type="text" id="username"  value="<?php echo $userInfo["username"]?>" style="width:150px;height:18px;"><span id="username_status"></td>
</tr>
<tr>
   <td style="height:20px;"><font color="red">*</font>Password:</td>
   <td style="text-align:left"><input class="signupform_text" name="password" type="password" id="password" value="<?php echo $userInfo["password"]?>" onkeyup="chkCase(this)" style="width:150px;height:18px;"><span id="password_status"></td>
</tr>
<tr>
   <td style="height:20px;"><font color="red">*</font>Repeatpassword:</td>
   <td style="text-align:left"><input class="signupform_text" name="repeatpassword" type="password" id="repeatpassword" value="<?php echo $userInfo["password"]?>" onkeyup="chkCase(this)" style="width:150px;height:18px;"><span id="verifynote" class="warn hidden"></span></td>
</tr>
<tr>
   <td style="height:20px"><font color="red">*</font>Phone:</td>
   <td style="text-align:left"><input class="signupform_text" name="phone" type="number" id="phone" value="<?php echo $userInfo["phone"]?>" style="width:150px;height:18px;"></td>
</tr>
<tr>
   <td style="height:20px"><font color="red">*</font>E-mail:</td>
   <td style="text-align:left"><input class="signupform_text" name="email" type="email" id="email" value="<?php echo $userInfo["email"]?>" style="width:150px;height:18px;"><span id="email_status"></td>
</tr>
<tr>
   <td style="height:20px"><font color="red">*</font>Gender:</td>
			<td style="text-align:left"><input class="signupform_text" name="gender" type="text"  id="gender" value="<?php echo $userInfo["gender"]?>" style="width:150px;height:18px;"><span id="email_status"></td>
</tr>
<tr>
   <td style="height:20px">Birthday:</td>
   <td style="text-align:left"><input class="signupform_text" name="birthday" type="date" id="Birthday" value="<?php echo $userInfo["birthday"]?>" style="width:150px;height:18px;"></td>
</tr>
<tr>
   <td style="height:20px">Address:</td>
   <td style="text-align:left"><input class="signupform_text" name="address" type="text" id="Address" value="<?php echo $userInfo["address"]?>" size="70" maxlength="60"></td>
</tr>
<tr>
   <td colspan="2"></td>
</tr>
<tr>
                	<td colspan="3" align="left">
                  		<font style="font-size:100%;"><font color="red">*</font>Security Question and Answer are required for reseting Password and username</font>
                   		<table border="0" cellpadding="0" cellspacing="0">
                            <tr height="5"><td></td></tr>
                            <tr>
                              	<td><font color="red">*</font>Security Question</font></td><td width="7">:</td>
                             	<td>
                             	<select name="s_question" style="width:220px;">
                             	 	<option value="none">Select</option>
                              	 	<option value="1">What is your first pet name?</option>
                               		<option value="2">What is your maid name?</option>
                                  	<option value="3">What is your best friend name?</option>
                                   	<option value="4">What is your school name?</option>
                                 	<option value="5">What is your occupation?</option>
                                  	<option value="6">When is your birthday?</option>
                                   	<option value="7">When is your graduation?</option>
                               	</select>
                             	</td>
                     		</tr>
                     		<tr>
                         		<td><font color="red">*</font>Security Answer</font></td><td>:</td>
                               	<td><input type="text" name="s_answer" style="width:220px;" value="<?php echo $userInfo["s_answer"]?>" maxlength="30" /></td>
                          	</tr>
                        	<tr height="5"><td></td></tr>
                           	<tr>
                            	<td colspan="3">
                            		<!--font size="2"><input type="checkbox" name="chkReceiveNewsAndPromo" value="Y">Receive e-mail about News and Promotion.
                            		<br/><input type="checkbox" name="chkReceiveNew" value="Y">Receive e-mail about New Product.</font-->
                              	</td>
                         	</tr>
							</table>
            </div>
		
		<br><div class="submit">
			<input type="submit" name="save" class="custom-button" value="Save" />
	    </div></br>
	</fieldset>
</form>
