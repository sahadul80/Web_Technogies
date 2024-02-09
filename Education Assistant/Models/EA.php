<?php
class EApost
{
	public $user;
	public $status;
	public $article;
	public $file;

	public function __construct($status,$article,$file)
	{
		$this->status=$status;
		$this->article=$article;
		$this->file=$file;
	}

	public function insertPost($user)
	{
		$servername="localhost";
		$uname="root";
		$pass="";
		$dbase="eduassist";
		$conn=new mysqli($servername,$uname,$pass,$dbase);

		$sql="insert into eapost (user,status,article,file) values ('$user','$this->status','$this->article','$this->file')";
		$execute=mysqli_query($conn,$sql);
	}

	public function updatePost($article,$file,$a_no)
	{
		$servername="localhost";
		$uname="root";
		$pass="";
		$dbase="eduassist";
		$conn=new mysqli($servername,$uname,$pass,$dbase);

		$sql="update eapost set article='$article', file='$file' where a_no='$a_no'";
		$execute=mysqli_query($conn,$sql);
		if($execute)
    	{
    		return "<center><success>Changes Confirmed!</success><center>";
    	}
    	else
    	{
    		return "<center><warning>Failed to Update!</warning><center>";
    	}
	}

	public function deletePost($a_no)
	{
		$servername="localhost";
		$uname="root";
		$pass="";
		$dbase="eduassist";
		$conn=new mysqli($servername,$uname,$pass,$dbase);

		$sql="delete from eapost where a_no='$a_no'";
		$execute=mysqli_query($conn,$sql);
		if($execute)
		{
    		return "<center><warning>Post Deleted!</warning><center>";
    	}
    	else
    	{
    		return "<center><warning>Failed to Delete!</warning><center>";
    	}
	}
}

class EAcomment
{
	public $comment;

	public function __construct($comment)
	{
		$this->comment=$comment;
	}

	public function insertComment($a_no,$cuser)
	{
		$servername="localhost";
		$uname="root";
		$pass="";
		$dbase="eduassist";
		$conn=new mysqli($servername,$uname,$pass,$dbase);

		$sql="insert into eacomment (a_no,comment,cuser) values ('$a_no','$this->comment','$cuser')";
		$execute=mysqli_query($conn,$sql);
	}

	public function updateComment($a_no,$comment,$c_no)
	{
		$servername="localhost";
		$uname="root";
		$pass="";
		$dbase="eduassist";
		$conn=new mysqli($servername,$uname,$pass,$dbase);

		$sql="update eacomment comment='$comment' where a_no='$a_no' and c_no='$c_no'";
		$execute=mysqli_query($conn,$sql);
	}

	public function deleteComment($a_no,$c_no)
	{
		$servername="localhost";
		$uname="root";
		$pass="";
		$dbase="eduassist";
		$conn=new mysqli($servername,$uname,$pass,$dbase);

		$sql="delete from eacomment where a_no='$a_no' and c_no='$c_no'";
		$execute=mysqli_query($conn,$sql);
	}
}

function newConnection()
{
	$servername="localhost";
	$user="root";
	$pass="";
	$dbase="eduassist";
	$conn=new mysqli($servername,$user,$pass,$dbase);
	return $conn;
}

function showPosts()
{
  	$cuser=$_SESSION['username'];
  	$table=$_SESSION['usertype'];

  	$conn=newConnection();
  	$sqlpost="select * from eapost where user in (select username from student where department = (select department from $table where username = '$cuser') union select username from teacher where department = (select department from $table where username = '$cuser'))order by date desc";
  	$execute=$conn->query($sqlpost);

  	if($execute->num_rows>0)
	{
	  return $execute;
	}
}

function showPublication()
{
  	$cuser=$_SESSION['username'];
  	$table=$_SESSION['usertype'];

  	$conn=newConnection();
  	$sql="select * from eapublication where username = '$cuser' order by date desc";
  	$execute=$conn->query($sql);
  	if($execute->num_rows>0)
	{
		return $execute;
	}
	else
	{
		return false;
	}
}

function postPublication()
{
  	$conn=newConnection();
  	$sql="select * from eapost where status='5'";
  	$execute=$conn->query($sql);
  	if($execute->num_rows>0)
	{
		return $execute;
	}
	else
	{
		return false;
	}
}

function isPublished()
{
  	$conn=newConnection();
  	$sql="select p_no from eapublication";
  	$execute=$conn->query($sql);
  	if($execute->num_rows>0)
	{
		return $execute;
	}
	else
	{
		return false;
	}
}

function setPublished()
{
  	$pub=postPublication();
  	$cpub=isPublished();
  	if($pub)
  	{
  		foreach($pub as $p)
  		{
  			if($cpub)
  			{
  				if($p['a_no']==$cpub['p_no'])
  				{
  					continue;
  				}
  				else
  				{
  					$user=$p['user'];
  					$article=$p['article'];
  					$file=$p['file'];
  					$a_no=$p['a_no'];
  					$conn=newConnection();
  					$sql="insert into eapublication (username,publication,pfile,p_no) values ('$user','$article','$file','$a_no')";
  					$execute=$conn->query($sql);
  				}
  			}
  			else
  			{
  				$user=$p['user'];
  				$article=$p['article'];
  				$file=$p['file'];
  				$a_no=$p['a_no'];
  				$conn=newConnection();
  				$sql="insert into eapublication (username,publication,pfile,p_no) values ('$user','$article','$file','$a_no')";
  				$execute=$conn->query($sql);
  			}
  		}
  		return "<center><h4>NEW Publications:</h4></center>";
  	}
  	else
  	{
  		return "<center><h4>No NEW Publications yet!</h4></center>";		
  	}
}

function viewPublication()
{
	$posts="";

  	$conn=newConnection();
  	$sql="select * from eapublication order by date desc";
  	$execute=$conn->query($sql);
  	if($execute->num_rows>0)
	{
		$posts=$execute;
		return $posts;
	}
	else
	{
		return $posts;
	}
}

function searchPublications($key)
{
	$posts="";

  	$conn=newConnection();
  	$sql="select * from eapublication where publication like '%$key%'"." order by date desc";
  	$execute=$conn->query($sql);
  	if($execute->num_rows>0)
	{
		$posts=$execute;
		return $posts;
	}
	else
	{
		return $posts;
	}
}

function getInfo()
{
	$cuser=$_SESSION['username'];
	$table=$_SESSION['usertype'];

	$conn=newConnection();
	$sql="select * from $table where username='$cuser'";
    $execute=$conn->query($sql);
    if($execute->num_rows>0)
	{
	  return $execute;
	}
}

function updateInfo($n,$em,$pn,$in,$de,$add)
{
	$cuser=$_SESSION['username'];
	$table=$_SESSION['usertype'];

	$conn=newConnection();
	$sql="update $table set name='$n', email='$em', phone='$pn', institute='$in', department='$de', address='$add' where username = '$cuser'";
    $execute=$conn->query($sql);
    if($execute)
    {
    	return "<hr><center><success>Changes Confirmed!</success></center><hr>";
    }
    else
    {
    	return "Failed to Update!";
    }
}

function showPost($a_no)
{	
	$post="";
	$conn=newConnection();
	$sql="select * from eapost where a_no='$a_no'";
	$execute=mysqli_query($conn,$sql);

	if($execute->num_rows>0)
    {
    	$post=$execute;
    	return $post;
	}
	else
	{
		return $post;
	}
}

function showComments($a_no)
{
	$conn=newConnection();
	$sql="select * from eacomment where a_no='$a_no'";
	$execute=mysqli_query($conn,$sql);
	if($execute->num_rows>0)
	{
		return $execute;
	}
	else
	{
		return false;
	}
}

function myPosts()
{
	$cuser=$_SESSION['username'];

	$conn=newConnection();
	$sql="select * from eapost where user = '$cuser' order by date desc";
	$execute=mysqli_query($conn,$sql);
	if($execute->num_rows>0)
	{
		return $execute;
	}
	else
	{
		return false;
	}
}

function managePost($a_no)
{
	$conn=newConnection();
	$sql="select * from eapost where a_no = '$a_no'";
	$execute=mysqli_query($conn,$sql);
	return $execute;
}

function userValidate($username)
{
	$conn=newConnection();
	$sql="select username from logininfo where username = '$username'";
	
	$execute=$conn->query($sql);
	if($execute->num_rows>0)
	{
		return false;
	}
	else
	{
		return true;
	}
}

function myContacts()
{
	$cuser=$_SESSION['username'];

	$conn=newConnection();
	$sql="select * from eaconnection where username='$cuser'";
	$execute=mysqli_query($conn,$sql);
	if($execute->num_rows>0)
	{
		return $execute;
	}
	else
	{
		return false;
	}
}

function myFriends()
{
	$cuser=$_SESSION['username'];

	$conn=newConnection();
	$sql="select * from eaconnection where friend='$cuser'";
	$execute=mysqli_query($conn,$sql);
	if($execute->num_rows>0)
	{
		return $execute;
	}
	else
	{
		return false;
	}
}

function isFriend($user)
{
	$myFriend="";
	$friends=myContacts();
    foreach($friends as $mf)
    {
    	if($mf['friend']==$user)
        {
            $myFriend=$mf['friend'];
            return $myFriend;
        }
        elseif($mf['username']==$user)
        {
        	$myFriend=$mf['username'];
            return $myFriend;
        }
        else
        {
        	return $myFriend;
        }
    }
    
}

function reqFriend($user)
{
	$reqFriend="";
    $conReq=connRequests();
    foreach($conReq as $rf)
    {
    	if($rf['sendby']==$user)
        {
            $reqFriend=$rf['sendby'];
        }
    }
    return $reqFriend;
}

function requestedUser($user)
{
	$requestedTo="";
    $reqTo=requestedConn();
    foreach($reqTo as $rt)
    {
    	if($rt['sendto']==$user)
        {
            $requestedTo=$rt['sendto'];
        }
    }
    return $requestedTo;
}

function connRequests()
{
	$user=$_SESSION['username'];

	$conn=newConnection();
	$sql="select * from connectionreq where sendto='$user'";
	$execute=mysqli_query($conn,$sql);
	if($execute->num_rows>0)
	{
		return $execute;
	}
	else
	{
		return false;
	}
}

function requestedConn()
{
	$user=$_SESSION['username'];

	$conn=newConnection();
	$sql="select * from connectionreq where sendby='$user'";
	$execute=mysqli_query($conn,$sql);
	if($execute->num_rows>0)
	{
		return $execute;
	}
	else
	{
		return false;
	}
}

function getUsertype($user)
{
	$conn=newConnection();
	$sql="select usertype from logininfo where username='$user'";
	$execute=mysqli_query($conn,$sql);
	$usertype=mysqli_fetch_assoc($execute);
	$ut=$usertype['usertype'];
	return $ut;
}

function getUser($usertype,$user)
{
	$conn=newConnection();
	$sql="select * from $usertype where username='$user'";
	$execute=mysqli_query($conn,$sql);
	return $execute;
}

function isAccepted($cuser,$friend,$accept)
{
	$conn=newConnection();
	$sql="insert into eaconnection (username, friend, conn_id) values ('$cuser', '$friend', '$accept')";
    $execute=$conn->query($sql);
}

function isRejected($reject)
{
	$conn=newConnection();
	$sql="delete from connectionreq where conn_no='$reject'";
    $execute=$conn->query($sql);
}

function isCancelled($user)
{
	$conn=newConnection();
	$sql="delete from connectionreq where sendto='$user'";
    $execute=$conn->query($sql);
}

function reqConn($sendby,$sendto)
{
	$conn=newConnection();
	$sql="insert into connectionreq (sendby, sendto) values ('$sendby', '$sendto')";
    $execute=$conn->query($sql);
}

function reqPublication($a_no)
{
	$conn=newConnection();
	$sql="update eapost set status='1' where a_no = '$a_no'";
    $execute=$conn->query($sql);
    if($execute)
    {
    	return "<center><success>Post is now under review!</success><center>";
    }
    else
    {
    	return "<center><warning>Failed!</warning><center>";
    }
}

function readChat($c_no)
{
	$conn=newConnection();
	$sql="select * from eachat where c_no='$c_no'";
    $execute=$conn->query($sql);
    return $execute;
}

function newChat($user,$friend,$chat,$c_no)
{
	$conn=newConnection();
	$sql="insert into eachat (user, friend, chat, c_no) values ('$user', '$friend', '$chat', '$c_no')";
    $execute=$conn->query($sql);
    return $execute;
}

function getChatFriend($conn_id)
{
	$conn=newConnection();
	$sql="select * from eaconnection where conn_id='$conn_id'";
    $execute=$conn->query($sql);
    return $execute;
}


?>