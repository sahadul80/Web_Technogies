<?php
include '../Model/EA.php';
include '../Model/EAtime.php';

session_start();

$c_no=$_SESSION['c_no'];
$user=$_SESSION['username'];
$friend=$_SESSION['cfriend'];

if(!isset($_SESSION['c_no']))
{
  header('Location:../View/EAprofile.php');
}
else
{
  if(isset($_POST['send']))
  {
    $chat=$_POST['message'];
    if(!empty($chat))
    {
      newChat($user,$friend,$chat,$c_no);
      header('Location:../View/EAchat.php');
    }
    else
    {
      $_SESSION['mgs']="<center>Write something to send!</center>";
      header('Location:../View/EAchat.php');
    }
  }
  elseif(isset($_POST['back']))
  {
    unset($_SESSION['c_no']);
    unset($_SESSION['cfriend']);
    header('Location:../View/EAprofile.php');
  }
  else
  {
    header('Location:../View/EAchat.php');
  }
}