<!DOCTYPE html>
<html>
<head>
	<title>Student Registration</title>
	<link rel="stylesheet" href="CSS/EAstyles.css">
	<script>
	    function sregAlert()
	    {
    		var name = document.getElementById('n').value;
    		var age = document.getElementById('a').value;
    		var email = document.getElementById('e').value;
    		var phone = document.getElementById('p').value;
    		var institute = document.getElementById('i').value;
    		var department = document.getElementById('d').value;
    		var address = document.getElementById('ad').value;
    		var username = document.getElementById('sun').value;
    		var pass = document.getElementById('sp').value;
    		var cpass = document.getElementById('csp').value;

		    if(name==''||age==''||email==''||phone==''||institute==''||department==''||address==''||username==''||pass==''||cpass=='')
    		{
        		alert('Please FILL all the FIELDS!');
    		}
    		else if(pass!=cpass)
    		{
        		alert('Passwords DID NOT match!');
    		}
    		else
    		{
        		document.getElementById('h').innerHTML="Processing...";
    		}
    	}
	</script>
	<style>
		.homebutton
    	{
      		padding: 20px;
      		right: 8px;
    	}
	</style>
	</head>
<body>
	<form method="post" action="../Controllers/EAistudentreg.php">
	<button type="submit" name="home" class="homebutton">EDUCATION ASSISTANT</button><br>
	<div class="feed">
		<center>
		<h4 id="h" class="focus">Registration: Student</h4>
		<input type="hidden" value="student" name="usertype">		
			<table border="0">
				<tr>
					<td>Full Name:</td>
					<td><input type="text" name="name" id="n" class="intext"></td>
				</tr>	
				<tr>
					<td>Date Of Birth:</td>
					<td><input type="date" name="age" id="a" class="intext"></td>
				</tr>	
				<tr>
					<td>Gender:</td>
					<td><input type="radio" name="gender" id="male" value="male" class="intext">
						<label for="male">Male</label>
						<input type="radio" name="gender" id="female" value="female" class="intext">
						<label for="female">Female</label>
						<input type="radio" name="gender" id="other" value="other" class="intext">
						<label for="other">Other</label>
					</td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><input type="email" name="email" id="e" class="intext"></td>
				</tr>
				<tr>
					<td>Phone:</td>
					<td><input type="number" name="phone" id="p" class="intext"></td>
				</tr>
				<tr>
					<td>Institute:</td>
					<td><input type="text" name="institute" id="i" class="intext"></td>
				</tr>
				<tr>
					<td><label for="department">Faculty:</label></td>
					<td>
						<select name="department" id="d">
						   <option value="FST" class="intext">Faculty of Science and Technology</option>
						   <option value="FBA" class="intext">Faculty of Business Administration</option>
						   <option value="FASS" class="intext">Faculty of Art And Social Sciences</option>
						   <option value="FE" class="intext">Faculty of Engineering</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Address:</td>
					<td><input type="text" name="address" id="ad" class="intext"></td>
				</tr>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="uname" id="sun" class="intext"></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="Password" name="pass" id="sp" class="intext"></td>
				</tr>
				<tr>
					<td>Confirm Password:</td>
					<td><input type="Password" name="cpass" id="csp" class="intext"></td>
				<tr>
					<td colspan="2"><center><button type="submit" name="sreg" onclick="sregAlert()">SUBMIT</button></center></td>
				</tr>
			</table>	<?php
			session_start();
			if(isset($_SESSION['mgs']))
			{
				echo $_SESSION['mgs'];
				unset($_SESSION['mgs']);
			}	?>
		</center>
	</div>
	</form>
</body>
</html>