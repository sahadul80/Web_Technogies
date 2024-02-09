<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
	<link rel="stylesheet" href="CSS/EAstyles.css">
	<script>
	    function fpassAlert()
	    {
    		var username = document.getElementById('un').value;
    		var email = document.getElementById('e').value;

		    if(username==''&&email!='')
    		{
        		alert('Missing USERNAME!');
    		}
    		else if(username!=''&&email=='')
    		{
        		alert('Missing email!');
    		}
    		else if(username==''&&email=='')
    		{
        		alert('Missing USERNAME and email!');
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
    			margin-top: 100px;
    		}
	    </style>
</head>
<body>
	<form method="post" action="../Controllers/EAiforgetpass.php">
		<button type="submit" name="home" class="homebutton">EDUCATION ASSISTANT</button><br>
		<div class="feed">
			<center><h2 class="focus">RETRIVE ACCOUNT</h2>
			<h3>Provide Information:</h3>
			<table border="0">
				<tr>
					<td>Username:</td>
					<td><input type="text" name="uname" id="un" class="intext"></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><input type="Email" name="uemail" id="e" class="intext"></td>
				</tr>
				<tr>
					<td colspan="2"><center><button type="submit" name="request" onclick="fpassAlert()" class="retrive">REQUEST PASSWORD!</button></center></td>
				</tr>
			</table>
			<?php
			session_start();
			if(!empty($_SESSION['retrived']))
			{
				echo $_SESSION['retrived'];
				unset($_SESSION['retrived']);
			}	?>
			<button type="submit" name="exit" class="back-button">BACK</button>
		</center>
		</div>
	</form>	
</body>
</html>