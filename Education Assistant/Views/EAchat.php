<?php
include '../Model/EA.php';
include '../Model/EAtime.php';

session_start();
$c_no=$_SESSION['c_no'];
$user=$_SESSION['username'];
$friend=$_SESSION['cfriend'];
?>
<!DOCTYPE html>
<html>
<head>
<title>Chat</title>
  <link rel="stylesheet" href="CSS/EAstyles.css">
  <script defer src="JS/EAscript.js"></script>
</head>
<style>
	.homebutton
    {
      padding: 20px;
      right: 8px;
    }
</style>
<body>
<form method="post" action="../Controllers/EAichat.php">
    <button type="submit" name="home" class="homebutton">EDUCATION ASSISTANT</button>
    <div class="menubar">
    	<center class="focus"><?php echo $friend; ?></center>
    </div>
    <div class="feed">  <?php
      	$chat=readChat($c_no);
      	if(!empty($chat))
      	{
        	foreach($chat as $c)
        	{ ?>
        	<table>
        		<tr>
        			<td><button type="submit" name="profile" class="profile"><?php echo $c['user'];?></button></td>
           			<td><?php echo $c['chat'];?></td>
            		<td class="time"><?php calculateTimeDifference($c['date']);?></td>
        		</tr>
        	</table>	<?php
        	}	?>
    		<hr>
    		<table>
	   			<tr>
    				<td rowspan="2"><textarea name="message" class="intext" cols="30" rows="1"></textarea></td>
    				<td><button type="submit" name="send" class="small">SEND</button></td>
    			</tr>
    		</table>	<?php
       	}
       	else
    	{ ?>
    		<table>
    		<hr><hr>
    			<tr>
        			<td>Start Chatting:</td>
    			</tr>
					<tr>
    					<td rowspan="2"><textarea name="message" class="intext" cols="30" rows="1"></textarea></td>
    					<td><button type="submit" name="send" class="small">SEND</button></td>
    				</tr>
				</table> <?php
    	}
		if(isset($_SESSION['mgs']))
		{
			echo $_SESSION['mgs'];
			unset($_SESSION['mgs']);
		}	?>
      <button type="submit" name="back" class="back-button" onclick="goBack()">BACK</button></div>
    </div>
</form>
</body>
</html>