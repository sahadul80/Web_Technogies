<?php
class User
{
	public $username;
	public $password;

	public function __construct($username,$password)
	{
		$this->username=$username;
		$this->password=$password;
	}

	public function insertUser($usertype)
	{
		$servername="localhost";
		$uname="root";
		$pass="";
		$dbase="eduassist";
		$conn=new mysqli($servername,$uname,$pass,$dbase);
		$sql="insert into logininfo (username,password,usertype) values ('$this->username','$this->password','$usertype')";
		$exicute=mysqli_query($conn,$sql);
	}

	public function loginValidation()
	{
		$uvArray=[];

		$servername="localhost";
		$user="root";
		$pass="";
		$dbase="eduassist";
		$conn=new mysqli($servername,$user,$pass,$dbase);

		$sqlverify="select * from logininfo where username='$this->username' and password='$this->password'";
		$execute=$conn->query($sqlverify);
		
		if($execute->num_rows>0)
		{
			while($q=mysqli_fetch_assoc($execute))
			{	
				if($this->username==$q["username"]&&$this->password==$q["password"]&&$q["usertype"]=="student")
				{
					$uv=[];
					$uv['username']=$q["username"];
					$uv['usertype']=$q["usertype"];
					$uvArray[]=$uv;
				}
				elseif($this->username==$q["username"]&&$this->password==$q["password"]&&$q["usertype"]=="teacher")
				{
					$uv=[];
					$uv['username']=$q["username"];
					$uv['usertype']=$q["usertype"];
					$uvArray[]=$uv;
				}
				elseif($this->username==$q["username"]&&$this->password==$q["password"]&&$q["usertype"]=="admin")
				{
					$uv=[];
					$uv['username']=$q["username"];
					$uv['usertype']=$q["usertype"];
					$uvArray[]=$uv; 
				}
				else
				{
					$uvArray=[];
				}
			}
			return $uvArray;
		}
		else
		{
			return $uvArray;
		}
	}

	public function retrivePassword($check_uname,$check_email)
	{
		$retrive="";

		$servername="localhost";
		$username="root";
		$password="";
		$dbase="eduassist";
		$conn=new mysqli($servername,$username,$password,$dbase);
		$sql="select * from logininfo where username='$check_uname'";

		$execute=$conn->query($sql);
		if($execute->num_rows>0)
		{
			while($q=mysqli_fetch_assoc($execute))
			{
				$usertype=$q['usertype'];
				if($check_uname==$q["username"])
				{
					$sql2= "select $usertype.*, logininfo.* from $usertype, logininfo where $usertype.username='$check_uname' and logininfo.username='$check_uname'";
					$execute2=$conn->query($sql2);

					while($q2=mysqli_fetch_assoc($execute2))
					{
						if($check_uname==$q2['username']&&$check_email==$q2['email'])
						{
							$retrive="<center><success>A mail has been sent to <u>".$q2['email']."</u> to reset Your PASSWORD.</success><br>(".$q2['password'].")<center>";
    							return $retrive;
						}
						else
						{
							$retrive="<hr><center><warning>Invalid EMAIL!</warning><h4>Click <a href="."'../View/EAforgetpass.php'".">HERE </a>to retry!</h4></center>";
							return $retrive;
						}
					}
				}
			}
		}
		else
		{
			$retrive="<hr><center><warning>Invalid USERNAME!</warning><h4>Click <a href="."'../View/EAforgetpass.php'".">HERE </a>to retry!</h4></center>";
			return $retrive;
		}
	}
}
?>