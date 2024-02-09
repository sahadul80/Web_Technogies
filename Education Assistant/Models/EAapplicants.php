<?php
	class Applicant
	{
		public $name;
		public $email;
		public $phone;
		public $resume;

		public function __construct($name,$email,$phone,$resume)
		{
			$this->name=$name;
			$this->email=$email;
			$this->phone=$phone;
			$this->resume=$resume;
		}

		public function insertApplicant()
		{
			$servername="localhost";
		    $uname="root";
		    $pass="";
		    $dbase="eduassist";
		    $conn=new mysqli($servername,$uname,$pass,$dbase);
		    $sql="insert into apply (name, email, phone, resume) values ('$name', '$email', '$phone', '$resume')";
		    $execute=$conn->query($sql);
		}
	}
?>