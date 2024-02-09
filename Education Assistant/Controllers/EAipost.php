<?php
include '../Model/EA.php';
include '../Model/EAtime.php';

	session_start();
    $a_no=$_SESSION['a_no'];
    $cuser=$_SESSION['username'];
	if(!isset($_SESSION['a_no'])) 
    {
    	header('Location:../View/EAstuindex.php');
    }
    else
    {
       	if(isset($_POST['backindex']))
        {
            unset($_SESSION['a_no']);
            header('Location:../View/EAstuindex.php');
        }
        elseif(isset($_POST['profile'])||isset($_POST['puser']))
        {
            if($_POST['profile']==$cuser||$_POST['puser']==$cuser)
            {
                unset($_SESSION['a_no']);
                header('Location:../View/EAprofile.php');
            }
            else
            {
                unset($_SESSION['a_no']);
                header('Location:../View/EAview.php');
            }
        }
        elseif(isset($_POST['com']))
        {
            if(empty($_POST['comment']))
            {
                $_SESSION['mgs']="<center><warning>Write a comment first!</warning></center>";
                header('Location:../View/EApost.php');
            }
            else
            {
                $comment=new EAcomment($_POST['comment']);
                $comment->insertComment($a_no,$cuser);
                $_POST['comment']='';
                header('Location:../View/EApost.php');
            }
        }
        else
        {
            header('Location:../View/EApost.php');
        }
    }
?>