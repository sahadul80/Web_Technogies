<?php
	class Student
	{
		public $name;
		public $age;
		public $gender;
		public $email;
		public $phone;
		public $institute;
		public $department;
		public $address;
		public $username;

		public function __construct($name,$age,$gender,$email,$phone,$institute,$department,$address,$username)
		{
			$this->name=$name;
			$this->age=$age;
			$this->gender=$gender;
			$this->email=$email;
			$this->phone=$phone;
			$this->institute=$institute;
			$this->department=$department;
			$this->address=$address;
			$this->username=$username;
		}

		public function registerStudent()
		{
			$servername="localhost";
			$user="root";
			$pass="";
			$dbase="eduassist";
			$conn=new mysqli($servername,$user,$pass,$dbase);
			$sql="insert into student (name, age, gender, email, phone, institute, department, address, username) values ('$this->name' , '$this->age' , '$this->gender' , '$this->email' , '$this->phone' , '$this->institute' , '$this->department' , '$this->address' , '$this->username')";
			$exicute=mysqli_query($conn,$sql);
		}
	}
?>