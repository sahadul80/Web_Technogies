<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
	<link rel="stylesheet" href="CSS/EAstyles.css"></head>
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
<body>
	<form method="post" action="../Controllers/EAiregister.php">
	<button type="submit" name="home" class="homebutton">EDUCATION ASSISTANT</button><br>
	<div class="feed">
	<center>
	<p class="focus">Welcome to Education Assistant!</p><br>
		<hr><button type="submit" name="sreg" class="submenu">Register as A STUDENT!</button><hr>
		<button type="submit" name="treg" class="submenu">Register as A TEACHER!</button><hr>
		To LOGIN<button type="submit" name="login" class="login">Click HERE!</button>
	</center>
	</div>
	</form>
</body>
</html>