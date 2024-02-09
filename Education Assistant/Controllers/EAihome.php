<?php
include '../Model/EA.php';
    if(isset($_POST['search']))
    {
        session_start();
        $key=$_POST['go'];
        $_SESSION['search']=searchPublications($key);
        header('Location: ../View/EAhome.php');
    }
    elseif(isset($_POST['login']))
    {
        header('Location: ../View/EAlogin.php');
    }
    elseif(isset($_POST['register']))
    {
        header('Location: ../View/EAregister.php');
    }
    elseif(isset($_POST['donate']))
    {
        header('Location: ../View/EAdonate.php');
    }
    elseif(isset($_POST['apply']))
    {
        header('Location: ../View/EAapply.php');
    }
    elseif(isset($_POST['home']))
    {
        header('Location: ../View/EAhome.php');
    }
    else
    {
        header('Location: ../View/EAhome.php');
    }
?>