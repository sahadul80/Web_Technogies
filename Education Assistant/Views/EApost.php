<!DOCTYPE html>
<html>
<head>
	<title>View Post</title>
	<link rel="stylesheet" href="CSS/EAstyles.css">
    <script defer src="JS/EAscript.js"></script>
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
	<form method="post" action="../Controllers/EAipost.php">
      <button type="submit" name="home" class="homebutton">EDUCATION ASSISTANT</button><br>
      	<div class="feed">  <?php
      	session_start();
      	include '../Model/EAtime.php';
      	include '../Model/EA.php';

      	$a_no=$_SESSION['a_no'];
      	$vpost=showPost($a_no);
      	if(!empty($vpost))
      	{
        	foreach($vpost as $vposts)
        	{ ?>
        	<center class="focus">Post Details:</center>
        	<table>
        		<tr>
           			<td><button type="submit" name="puser" value="<?php echo $vposts['user'];?>" class="user"><?php echo $vposts['user'];?></button></td>
            		<td class="time"><?php calculateTimeDifference($vposts['date']);?></td>
        		</tr>
        		<tr>
          			<td colspan="2"><?php echo $vposts['article'];?></td>
        		</tr>	<?php
        		if(!empty($vposts['file'])) 
        		{ ?>
        		<tr>
            		<td><?php echo $vposts['file'];?></td>
            		<td><a download="<?php echo $vposts['file']; ?>" href="../Files/<?php echo $vposts['file']; ?>">Download</a></td>
        		</tr>	<?php
        		}	?>
        	</table>	<?php
        	}
        	$viewcom=showComments($a_no);
        	if(!empty($viewcom))
      		{	?> 
				<hr><hr>Comments:	<?php
        		foreach($viewcom as $vcom)
        		{ ?>
       			<table>
        			<tr>
						<td rowspan="2"><button type="submit" name="profile" value="<?php echo $vcom['cuser'];?>" class="user"><?php echo $vcom['cuser'];?></button></td> 
					</tr>
					<tr>
						<td rowspan="2"  class="limited_text"><?php echo $vcom['comment'];?></td>
						<td class="time"><?php calculateTimeDifference($vcom['date']); ?></td> 
					</tr>
				</table>	<?php
				}	?>
    			<hr>
    			<table>
					<tr>
    					<td colspan="2">Write a Comment:</td>
        			</tr>
	    			<tr>
    					<td rowspan="2"><textarea name="comment" class="intext" cols="30" rows="2"></textarea></td>
    					<td><button type="submit" name="com" class="small">DONE</button></td>
    				</tr>
    			</table>	<?php
        	}
       		else
    		{ ?>
    			<table>
    			<hr><hr>
    				<tr>
        				<td>Write NEW Comment:</td>
    				</tr>
					<tr>
    					<td rowspan="2"><textarea name="comment" class="intext" cols="30" rows="2"></textarea></td>
    					<td><button type="submit" name="com" class="small">DONE</button></td>
    				</tr>
				</table> <?php
    		}
			if(isset($_SESSION['mgs']))
			{
				echo $_SESSION['mgs'];
				unset($_SESSION['mgs']);
			}
    	}	?>
      <button type="submit" name="backindex" class="back-button" onclick="goBack()">BACK</button></div>
  	</form>
</body>
</html>
