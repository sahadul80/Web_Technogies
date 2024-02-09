<?php
include '../Model/EAteachers.php';
include '../Model/EAusers.php';
include '../Model/EA.php';

	if(isset($_POST['treg']))
	{
		if(!empty($_POST['uname'])&&!empty($_POST['pass'])&&!empty($_POST['cpass']))
		{
			session_start();
			if($_POST['pass']==$_POST['cpass'])
			{
				$valid=userValidate($_POST['uname']);
				if($valid==true)
				{
					$user=new User($_POST['uname'],$_POST['pass']);
					$teacher=new Teacher($_POST['name'],$_POST['age'],$_POST['gender'],$_POST['email'],$_POST['phone'],$_POST['workplace'],$_POST['designation'],$_POST['department'],$_POST['address'],$_POST['uname']);
					$user->insertUser($_POST['usertype']);
					$teacher->registerTeacher();
					$_SESSION['mgs']="<center><success>Regestered Successfully!</success></center>";
					header('location: ../View/EAlogin.php');
				}
				else
				{
					$_SESSION['mgs']="<center><warning>USERNAME taken!</warning><br><note>Try using numbers at the end of ".$_POST['uname']."</note></center>";
					header('location: ../View/EAteacherreg.php');
				}
			}
			else
			{
				$_SESSION['mgs']="<center><warning>Passwords did NOT match!</warning><br></center>";
				header('location: ../View/EAstudentreg.php');
			}
		}
		else
		{
			header('location: ../View/EAteacherreg.php');
		}
	}
	elseif(isset($_POST['home']))
	{
		header("location: ../View/EAhome.php");
	}
	else
	{
		header('location: ../View/EAteacherreg.php');
	}
?>