<html>
<?php
/* ----------- REGISTER PAGE ----------------*/
include("dataconn.php");

if(isset($_POST["register"]))
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
$password = md5($password);
$s_answer= mysql_real_escape_string($_POST['s_answer']);
$s_question= mysql_real_escape_string($_POST['s_question']);

$vname=mysql_query("select * from user where username='$username'");
	if(mysql_num_rows($vname)>0)
	{
	echo "username already exist";
}
else{

	
	$reg= "INSERT INTO user(fullname,username,password,phone,email,gender,birthday,address,s_question,s_answer) VALUES('$fullname','$username','$password','$phone','$email','$gender','$birthday','$address','$s_question','$s_answer')";
	//echo $reg;
	$regcommand = mysql_query($reg) or die(mysql_error());
	
	if($regcommand)
	{
    $_SESSION['flash_msg'] = "You have been successfully registered";
		header("Location:Login Page.php");
	}
	}
}
?>

<html>
<head>
    <link href="register css.css" rel="stylesheet" type="text/css"/>
    <script>
	
    function validation()
    {
      var fullname = document.forms["registration_page"]["fullname"].value;
      var username = document.forms["registration_page"]["username"].value;
      var password = document.forms["registration_page"]["password"].value;
	  var repeatpassword = document.forms["registration_page"]["repeatpassword"].value;
      var phone = document.forms["registration_page"]["phone"].value;
	  var email = document.forms["registration_page"]["email"].value;
      var gender = document.forms["registration_page"]["gender"].value;
      var birthday = document.forms["registration_page"]["birthday"].value;
      var address = document.forms["registration_page"]["address"].value;
	  var s_answer = document.forms["registration_page"]["s_answer"].value;
      var s_question = document.forms["registration_page"]["s_question"].value;
	  

	  
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

     <form action="register.php" method="post" name="registration_page" onsubmit="return validation()">
       <div class="divregister">
            
            
          <center>
		   <table>
		   <p><span style="font-size: 30px; font-weight: bold;">Create a New Account</span>
				<tr>
   <td style="height:20px"><font color="red">*</font>Name:</td>
   <td style="text-align:left"><input class="signupform_text" name="fullname" type="text" id="fullname" style="width:150px;height:18px;"><span id="username_status"></td>
</tr>
<tr>
   <td style="height:20px"><font color="red">*</font>User Name:</td>
   <td style="text-align:left"><input class="signupform_text" name="username" type="text" id="username" style="width:150px;height:18px;"><span id="username_status"></td>
</tr>
<tr>
   <td style="height:20px;"><font color="red">*</font>Password:</td>
   <td style="text-align:left"><input class="signupform_text" name="password" type="password" id="password" onkeyup="chkCase(this)" style="width:150px;height:18px;"><span id="password_status"></td>
</tr>
<tr>
   <td style="height:20px;"><font color="red">*</font>Confirm Password:</td>
   <td style="text-align:left"><input class="signupform_text" name="repeatpassword" type="password" id="repeatpassword" onkeyup="chkCase(this)" style="width:150px;height:18px;"><span id="verifynote" class="warn hidden"></span></td>
</tr>
<tr>
   <td style="height:20px"><font color="red">*</font>Phone:</td>
   <td style="text-align:left"><input class="signupform_text" name="phone" type="number" id="phone" style="width:150px;height:18px;"></td>
</tr>
<tr>
   <td style="height:20px"><font color="red">*</font>E-mail:</td>
   <td style="text-align:left"><input class="signupform_text" name="email" type="email" id="email" style="width:150px;height:18px;"><span id="email_status"></td>
</tr>
<tr>
   <td style="height:20px"><font color="red">*</font>Gender:</td>
			<td style="text-align:left"><input type="radio" name="gender" value="Male" /> Male
			<input type="radio" name="gender" value="Female" /> Female</td>
</tr>
<tr>
   <td style="height:20px"><font color="red">*</font>Birthday:</td>
   <td style="text-align:left"><input class="signupform_text" name="birthday" type="date" id="Birthday" style="width:150px;height:18px;"></td>
</tr>
<tr>
   <td style="height:20px"><font color="red">*</font>Address:</td>
   <td style="text-align:left"><input class="signupform_text" name="address" type="text" id="Address" size="70" maxlength="60"></td>
</tr>
<tr>
   <td colspan="2"></td>
</tr>
<tr>
                	<td colspan="3" align="left">
                  		<font style="font-size:100%;"><font color="red">*</font><font color="pink">Security Question and Answer are required for reseting your account</font></font>
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
                                   	<option value="6">When is your graduation?</option>
                               	</select>
                             	</td>
                     		</tr>
                     		<tr>
                         		<td><font color="red">*</font>Security Answer</font></td><td>:</td>
                               	<td><input type="text" name="s_answer" style="width:220px;" maxlength="30" /></td>
                          	</tr>
                        	<tr height="5"><td></td></tr>
							</table>
							</center>
            </div>
			
            <br><div class="submit">
             <input type="hidden" name="submit" value="TRUE" />
             <input type="submit" name="register"  class="custom-button" value="Register"/>
			 <input type="reset" name="reset" class="custom-button" value="Reset"/>
            </div></br>
			
        </fieldset>
    </form>

    </body>
</html>
