<!DOCTYPE html>
<html>
<head>
	<title>Teacher Registration</title>
	<link rel="stylesheet" href="CSS/EAstyles.css">
	<script>
	    function tregAlert()
	    {
    		var name = document.getElementById('n').value;
    		var age = document.getElementById('a').value;
    		var email = document.getElementById('e').value;
    		var phone = document.getElementById('p').value;
    		var institute = document.getElementById('i').value;
    		var designation = document.getElementById('de').value;
    		var department = document.getElementById('d').value;
    		var address = document.getElementById('ad').value;
    		var username = document.getElementById('tun').value;
    		var pass = document.getElementById('tp').value;
    		var cpass = document.getElementById('ctp').value;

		    if(name==''||age==''||email==''||phone==''||institute==''||designation==''||department==''||address==''||username==''||pass==''||cpass=='')
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
	<form method="post" action="../Controllers/EAiteacherreg.php">
	<button type="submit" name="home" class="homebutton">EDUCATION ASSISTANT</button><br>
		<div class="feed">
		<center>
		<h4 class="focus">Registration: Teacher</h4>
		<input type="hidden" value="teacher" name="usertype">			
			<table border="0">
				<tr>
					<td>Name:</td>
					<td><input type="text" name="name" id="n" class="intext"></td>
				</tr>	
				<tr>
					<td>Date of Birth:</td>
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
					<td>Workplace:</td>
					<td><input type="text" name="workplace" id="i" class="intext"></td>
				</tr>
				<tr>
					<td>Designation:</td>
					<td><input type="text" name="designation" id="de" class="intext"></td>
				</tr>
				<tr>
					<td><label for="department" id="d">Faculty:</label></td>
					<td>
						<select name="department" class="intext">
						   <option value="FST">Faculty of Science and Technology</option>
						   <option value="FBA">Faculty of Business Administration</option>
						   <option value="FASS">Faculty of Art And Social Sciences</option>
						   <option value="FE">Faculty of Engineering</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Address:</td>
					<td><input type="text" name="address" id="ad" class="intext"></td>
				</tr>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="uname" id="tun" class="intext"></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="Password" name="pass" id="tp" class="intext"></td>
				</tr>
				<tr>
					<td>Confirm:</td>
					<td><input type="Password" name="cpass" id="ctp" class="intext"></td>
				<tr>
					<td colspan="2"><center><button type="submit" name="treg" onclick="tregAlert()">SUBMIT</button></center></td>
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