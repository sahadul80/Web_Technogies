<?php
include '../Model/EA.php';
include '../Model/EAusers.php';
include '../Model/EAstudents.php';
include '../Model/EAteachers.php';

session_start();
$cuser=$_SESSION['username'];
$table=$_SESSION['usertype'];

if(!isset($_SESSION['username'])) 
{
  header('Location:../View/EAlogin.php');
}
else
{
  if(isset($_POST['home']))
  {
    header('Location:../View/EAstuindex.php');
  }
  elseif(isset($_POST['search']))
  {
    session_start();
    $key=$_POST['go'];
    $_SESSION['search']=searchPublications($key);
    header('Location: ../View/EAhome.php');
  }
  elseif(isset($_POST['publications']))
  {
    $_SESSION['publication']=showPublication();
    header('Location:../View/EAstuindex.php');
    if(isset($_POST['articlecom']))
    {
      $p_no=$_POST['articlecom'];
      $_SESSION['p_no']=$p_no;
      header('Location:../View/EApost.php');
    }
  }
  else
  {
    if(isset($_POST['logout']))
    {
      session_destroy();
      header('Location:../View/EAlogin.php');
    }
    elseif(isset($_POST['puser']))
    {
      if($_POST['puser']==$cuser)
      {
        header('Location:../View/EAprofile.php');
      }
      else
      {
        $suser=$_POST['puser'];
        $friend=isFriend($suser);
        $requestFrom=reqFriend($suser);
        $requestTo=requestedUser($suser);
        if(!empty($friend))
        {
          $_SESSION['friend']=$suser;
          header('Location:../View/EAview.php');
        }
        elseif(!empty($requestFrom))
        {
          $_SESSION['sendfrom']=$suser;
          header('Location:../View/EAview.php');
        }
        elseif(!empty($requestTo))
        {
          $_SESSION['sendto']=$suser;
          header('Location:../View/EAview.php');
        }
        else
        {
          $_SESSION['suser']=$suser;
          header('Location:../View/EAview.php');
        }
      }
    }
    elseif(isset($_POST['profile']))
    {
  	  $_SESSION['info']=getInfo();
      header('Location:../View/EAprofile.php');
    }
    else
    {
      if(isset($_POST['write']))
      {
        $article=$_POST['article'];
        $status=$_POST['status'];
        $fname=$_FILES['upfile']['name'];
        $destination='../Files/'.$fname;
        $extension=pathinfo($fname,PATHINFO_EXTENSION);
        $size=$_FILES['upfile']['size'];
        $tname=$_FILES['upfile']['tmp_name'];
        if(!empty($article)&&!empty($fname))
        {
          if ($_FILES['upfile']['error'] === UPLOAD_ERR_OK)
          {
            if(!in_array($extension,['zip','pdf','png','jpg']))
            {
              $_SESSION['mgs']="<center><warning>Unsupported file!<br>Supported file-type: .zip, .pdf, .png or .jpg</warning></center>";
              header('Location:../View/EAstuindex.php');
            }
            elseif($size>1000000)
            {
              $_SESSION['mgs']="<center><warning>File is too lagre to upload!</warning></center>";
              header('Location:../View/EAstuindex.php');
            }
            else
            {
              if(move_uploaded_file($tname, $destination))
              {
                $post=new EApost($status,$article,$fname);
                $post->insertPost($cuser);
                header('Location:../View/EAstuindex.php');
              }
              else
              {
                $_SESSION['mgs']="<center><warning>Failed to upload!</warning></center>";
                header('Location:../View/EAstuindex.php');
              }
            }
          }
          else
          {
            $_SESSION['mgs']=$_POST['upfile']." upload failed. Error code: " . $_FILES['upfile']['error'];
            header('Location:../View/EAstuindex.php');
          } 
        }
        elseif(!empty($article)&&empty($file))
        {
          $fname=$_POST['upfile'];
          $post=new EApost($status,$article,$fname);
          $post->insertPost($cuser);
          header('Location:../View/EAstuindex.php');
        }
        else
        {
          $_SESSION['mgs']="<center><warning>Write something to post!</warning></center>";
          header('Location:../View/EAstuindex.php');
        }
      }
      elseif(isset($_POST['writecom']))
      {
        $a_no=$_POST['writecom'];
        $_SESSION['a_no']=$a_no;
        header('Location:../View/EApost.php');
      }
      else
      { 
        header('Location:../View/EAstuindex.php');
      }
    }
  }
}

?>