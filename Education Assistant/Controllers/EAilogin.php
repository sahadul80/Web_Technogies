<?php
include '../Model/EAusers.php';
include '../Model/EA.php';

	if(isset($_POST['login']))
	{
		session_start();
		$user=new User($_POST['username'],$_POST['password']);
		$ut=$user->loginValidation();
		$_SESSION['ut']=$ut;
      	if(!empty($ut))
      	{
        	foreach($ut as $uts)
        	{
        		$_SESSION['username']=$uts["username"];
				$_SESSION['usertype']=$uts["usertype"];
        	}
			header("Location:../View/EAstuindex.php");
		}
		else
		{
			if(empty($_POST['username'])&&empty($_POST['password']))
			{
				$_SESSION['mgs']="<warning>Please Fill All the FIELDS!</warning>";
				header("Location:../View/EAlogin.php");
			}
			else if(empty($_POST['username'])&&!empty($_POST['password']))
			{
				$_SESSION['mgs']="<warning>USERNAME is Missing!</warning>";
				header("Location:../View/EAlogin.php");
			}
			else if(!empty($_POST['username'])&&empty($_POST['password']))
			{
				$_SESSION['mgs']="<warning>PASSWORD is Missing!</warning>";
				header("Location:../View/EAlogin.php");
			}
			else if(!empty($_POST['username'])&&!empty($_POST['password']))
			{
				$_SESSION['mgs']="<warning>Invalid USERNAME or PASSWORD! Try again!</warning>";
				header("Location:../View/EAlogin.php");
			}
			else
			{
				header("Location:../View/EAlogin.php");
			}
		}
	}
	elseif(isset($_POST['reg']))
	{
		header("Location:../View/EAregister.php");
	}
	elseif(isset($_POST['home']))
	{
		header("Location:../View/EAhome.php");
	}
	elseif(isset($_POST['recover']))
	{
		header("Location:../View/EAforgetpass.php");
	}
	else
	{
		header("Location:../View/EAlogin.php");
	}
?>