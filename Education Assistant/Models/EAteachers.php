<?php
	class Teacher
	{
		public $name;
		public $age;
		public $gender;
		public $email;
		public $phone;
		public $workplace;
		public $designation;
		public $department;
		public $address;
		public $username;

		public function __construct($name,$age,$gender,$email,$phone,$workplace,$designation,$department,$address,$username)
		{
			$this->name=$name;
			$this->age=$age;
			$this->gender=$gender;
			$this->email=$email;
			$this->phone=$phone;
			$this->workplace=$workplace;
			$this->designation=$designation;
			$this->department=$department;
			$this->address=$address;
			$this->username=$username;
		}

		public function registerTeacher()
		{
			$servername="localhost";
			$user="root";
			$pass="";
			$dbase="eduassist";
			$conn=new mysqli($servername,$user,$pass,$dbase);
			$sql="insert into teacher (name, age, gender, email, phone, institute, designation, department, address, username) values ('$this->name' , '$this->age' , '$this->gender' , '$this->email' , '$this->phone' , '$this->workplace' , '$this->designation' , '$this->department' , '$this->address' , '$this->username')";
			$exicute=mysqli_query($conn,$sql);
		}
	}
?>