<?php
$Name =$_POST['name'];
$Email =$_POST['email'];
$Msg =$_POST['message'];

if(!empty($name) ||!empty($Email) ||!empty($message)){
	$host = "localhost";
	$dbusername ="root";
	$dbpassword="";
	$dbname="contactconn";

	$conn=new mysqli($host,$dbusername,$dbpassword,$dbname);
	if(mysqli_connect_error())
	{
		die('Connection failed ('.mysqli_connect_errno().')'.mysqli_connect_error());

	}else{
		$SELECT ="SELECT Email From contactform where Email = ? Limit 1";
		$INSERT ="INSERT into contactform(Name,Email,Msg)values(?,?,?)";

		$stmt=$conn ->prepare($SELECT);
		$stmt->bind_param("s",$Email);
		$stmt->execute();
		$stmt->bind_result($Email);
		$stmt->store_result();
		$rnum = $stmt->num_rows;
		if($rnum == 0){
			$stmt->close();
			$stmt = $conn->prepare($INSERT);
			$stmt->bind_param("sss",$Name,$Email,$Msg);
			$stmt->execute();
			echo"Thank you we will contact soon!";
		}else{
			echo"You have already filled the form";
		}$stmt->close();
		$conn->close();
	}
}else{
	echo"All fields are required ";
	die();
}
?>