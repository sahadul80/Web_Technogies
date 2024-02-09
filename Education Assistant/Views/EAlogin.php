<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" href="CSS/EAstyles.css">
	    <script>
	    function loginAlert()
	    {
    		var username = document.getElementById('un').value;
    		var password = document.getElementById('p').value;

		    if(username==''&&password!='')
    		{
        		alert('Missing USERNAME!');
    		}
    		else if(username!=''&&password=='')
    		{
        		alert('Missing PASSWORD!');
    		}
    		else if(username==''&&password=='')
    		{
        		alert('Missing USERNAME and PASSWORD!');
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
        	.feed
        	{
        		margin-top: 200px;
        		top: 300;
        	}
	    </style>
</head>
<body>
	<form method="post" action="../Controllers/EAilogin.php">
		<button type="submit" name="home" class="homebutton">EDUCATION ASSISTANT</button>
		<div class="feed">
		<center>
			<h2>USER LOGIN</h2>
			<h3 id="h">Provide Username and Password:</h3>
			<table border="0">
				<tr>
					<td>Username:</td>
					<td><input type="text" name="username" id="un" class="intext"></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="Password" name="password" id="p" class="intext"></td>
				</tr>
				<tr>
					<td colspan="2"><center><button type="submit" name="login" onclick="loginAlert()" class="login">LOGIN</button></center></td>
					<td><button type="submit" name="recover" class="retrive">Forgot PASSWORD?</button></td>
				</tr>
			</table>
			<?php
			session_start();
			if(isset($_SESSION['mgs']))
			{
				echo $_SESSION['mgs'];
				unset($_SESSION['mgs']);
				session_destroy();
			}
			?>
		</center>
		<center>
		Yet Not Registered?
		<button type="submit" name="reg">Click HERE to REGISTER!</button>
		</center>
		</div>
	</form>
</body>
</html>