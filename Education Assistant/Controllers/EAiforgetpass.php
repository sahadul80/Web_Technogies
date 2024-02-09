<?php
include '../Model/EAusers.php';
session_start();
if(isset($_POST['request']))
{
	$username=$_POST['uname'];
	$email=$_POST['uemail'];
	$user=new User($username,$email);
	$_SESSION['retrived']=$user->retrivePassword($username,$email);
	header("Location:../View/EAforgetpass.php");
}
elseif(isset($_POST['home']))
{
	header("Location:../View/EAhome.php");
}
elseif(isset($_POST['exit']))
{
	header("Location:../View/EAlogin.php");
}
else
{
	header("Location:../View/EAforgetpass.php");
}
?>