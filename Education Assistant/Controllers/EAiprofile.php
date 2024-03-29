<?php
include '../Model/EA.php';
include '../Model/EAtime.php';

session_start();

$cuser=$_SESSION['username'];
$table=$_SESSION['usertype'];

if(!isset($_SESSION['username']))
{
  header('Location:../View/EAlogin.php');
}
else
{
  if(isset($_POST['logout']))
  {
    session_destroy();
    header('Location:../View/EAlogin.php');
  }
  elseif(isset($_POST['goback']))
  {
    header('Location:../View/EAstuindex.php');
  }
  elseif(isset($_POST['back']))
  {
  	unset($_SESSION['a_no']);
    header('Location:../View/EAprofile.php');
  }
  elseif(isset($_POST['home']))
  {
    header('Location:../View/EAprofile.php');
  }
  elseif(isset($_POST['myteam']))
  {
  	$_SESSION['myteams']="clicked";
    header('Location:../View/EAprofile.php');
  }
  elseif(isset($_POST['changeinfo']))
  {
  	$_SESSION['myinfo']="clicked";
  	header('Location:../View/EAprofile.php');
  }
  elseif(isset($_POST['save']))
  {
    $n=$_POST['sname'];
    $em=$_POST['semail'];
    $pn=$_POST['sphone'];
    $in=$_POST['sinstitute'];
    $add=$_POST['saddress'];
    $de=$_POST['sdepartment'];
    if(empty($n)||empty($em)||empty($pn)||empty($in)||empty($de)||empty($add))
    {
    	$_SESSION['mgs']="<hr><center><warning>Please Fill All The Fields!</warning></center><hr>";
	    header('Location:../View/EAprofile.php');
    }
    else
    {
    	$_SESSION['mgs']=updateInfo($n,$em,$pn,$in,$de,$add);
	    header('Location:../View/EAprofile.php');
    }
  }
  elseif(isset($_POST['sendfrom']))
  {
    $suser=$_POST['sendfrom'];
    $_SESSION['sendfrom']=$suser;
    header('Location:../View/EAview.php');
  }
  elseif(isset($_POST['ryes']))
  {
    $accept=$_POST['ryes'];
    $friend=$_POST['sender'];
    isAccepted($cuser,$friend,$accept);
    isRejected($accept);
    unset($_SESSION['sendfrom']);
    header('Location:../View/EAprofile.php');
  }
  elseif(isset($_POST['rno']))
  {
    $reject=$_POST['rno'];
    isRejected($reject);
    unset($_SESSION['sendfrom']);
    header('Location:../View/EAprofile.php');
  }
  elseif(isset($_POST['connr']))
  {
  	$_SESSION['connr']="clicked";
  	header('Location:../View/EAprofile.php');
    
  }
  elseif(isset($_POST['friend']))
  {
    $frnd=$_POST['friend'];
    $_SESSION['friend']=$frnd;
    header('Location:../View/EAview.php');
  }
  elseif(isset($_POST['chat']))
  {
  	$_SESSION['c_no']=$_POST['chat'];
  	$friend=getChatFriend($_SESSION['c_no']);
  	foreach($friend as $f)
  	{
  		if($f['friend']==$cuser)
  		{
  			$_SESSION['cfriend']=$f['username'];
  			header('Location:../View/EAchat.php');
  		}
  		else
  		{
  			$_SESSION['cfriend']=$f['friend'];
  			header('Location:../View/EAchat.php');
  		}
  	}
  }
  elseif(isset($_POST['connc']))
  {
  	$_SESSION['conncon']="clicked";
    header('Location:../View/EAprofile.php');
  }
  elseif(isset($_POST['eyes']))
  {
    $_SESSION['a_no']=$_POST['eyes'];
    $a_no=$_SESSION['a_no'];
    $a=$_POST['eart'];
    $f=$_POST['efil'];
    $updatepost=new EApost($a_no,$a,$f);
    $_SESSION['mgs']=$updatepost->updatePost($a,$f,$a_no);
    unset($_SESSION['epost']);
    unset($_SESSION['earticl']);
    unset($_SESSION['upefil']);
    unset($_SESSION['a_no']);
    header('Location:../View/EAprofile.php');
  }
  elseif(isset($_POST['eno']))
  {
  	unset($_SESSION['a_no']);
  	unset($_SESSION['epost']);
    unset($_SESSION['earticl']);
    unset($_SESSION['upefil']);
  	header('Location:../View/EAprofile.php');
  }
  elseif(isset($_POST['editpost']))
  {
  	$_SESSION['earticl']=$_POST['earticle'];
    $_SESSION['upefil']=$_POST['upefile'];
  	$_SESSION['epost']="clicked";
    header('Location:../View/EAprofile.php');
  }
  elseif(isset($_POST['dyes']))
  {
  	$_SESSION['a_no']=$_POST['dyes'];
    $a_no=$_SESSION['a_no'];
    unset($_SESSION['a_no']);
    $a=$_POST['earticle'];
    $f=$_POST['upefile'];
    $deletepost=new EApost($a_no,$a,$f);
    $_SESSION['mgs']=$deletepost->deletePost($a_no);
    unset($_SESSION['dpost']);
    header('Location:../View/EAprofile.php');
  }
  elseif(isset($_POST['dno']))
  {
  	unset($_SESSION['a_no']);
  	unset($_SESSION['dpost']);
  	header('Location:../View/EAprofile.php');
  }
  elseif(isset($_POST['deletepost']))
  {
  	$_SESSION['dpost']="clicked";
    header('Location:../View/EAprofile.php');
  }
  elseif(isset($_POST['pyes']))
  {
    $_SESSION['a_no']=$_POST['pyes'];
    $a_no=$_SESSION['a_no'];
    unset($_SESSION['a_no']);
    $_SESSION['mgs']=reqPublication($a_no);
    unset($_SESSION['ppost']);
    header('Location:../View/EAprofile.php');
  }
  elseif(isset($_POST['pno']))
  {
  	unset($_SESSION['a_no']);
    unset($_SESSION['ppost']);
  	header('Location:../View/EAprofile.php');
  }
  elseif(isset($_POST['publishpost']))
  { 
    $_SESSION['ppost']="clicked";
    header('Location:../View/EAprofile.php');
  }
  elseif(isset($_POST['managepost']))
  {
    unset($_SESSION['myposts']);
    $_SESSION['a_no']=$_POST['managepost'];
    $a_no=$_SESSION['a_no'];
    header('Location:../View/EAprofile.php');
  }
  elseif(isset($_POST['viewpost']))
  {
  	unset($_SESSION['myposts']);
    $a_no=$_POST['viewpost'];
    $_SESSION['a_no']=$a_no;
    header('Location:../View/EApost.php');
  }
  elseif(isset($_POST['mypost']))
  {
  	$_SESSION['myposts']="clicked";
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
	          header('Location:../View/EAprofile.php');
	        }
	        elseif($size>1000000)
	        {
	          $_SESSION['mgs']="<center><warning>File is too lagre to upload!</warning></center>";
	          header('Location:../View/EAprofile.php');
	        }
	        else
	        {
	          if(move_uploaded_file($tname, $destination))
	          {
	            $post=new EApost($status,$article,$fname);
	            $post->insertPost($cuser);
	            header('Location:../View/EAprofile.php');
	          }
	          else
	          {
	            $_SESSION['mgs']="<center><warning>Failed to upload!</warning></center>";
	            header('Location:../View/EAprofile.php');
	          }
	        }
	      }
	      else
	      {
	        $_SESSION['mgs']=$_POST['upfile']." upload failed. Error code: " . $_FILES['upfile']['error'];
	        header('Location:../View/EAprofile.php');
	      } 
	    }
	    elseif(!empty($article)&&empty($file))
	    {
	      $fname=$_POST['upfile'];
	      $post=new EApost($status,$article,$fname);
	      $post->insertPost($cuser);
	      header('Location:../View/EAprofile.php');
	    }
	    else
	    {
	      $_SESSION['mgs']="<center><warning>Write something to post!</warning></center>";
	      header('Location:../View/EAprofile.php');
	    }
	}
    else
    {
      header('Location:../View/EAprofile.php');
    }
    
  }
}
?>