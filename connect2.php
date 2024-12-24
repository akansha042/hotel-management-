<?php
$Name =$_POST['Y_name'];
$Email =$_POST['mail'];
$Contact =$_POST['num'];
$Age =$_POST['age'];
$Date =$_POST['DOA'];
$RoomType =$_POST['room'];

if(!empty($Name) ||!empty($Email) ||!empty($num) || !empty($Age) ||!empty($Date) ||!empty($RoomType)){
	/*$host = "localhost";
	$dbusername ="root";
	$dbpassword="";
	$dbname="booking_details";*/

	$conn=new mysqli("localhost","root","","booking_details");
	if(mysqli_connect_error())
	{
		die('Connection failed ('.mysqli_connect_errno().')'.mysqli_connect_error());

	}else{
		$SELECT ="SELECT cust_mail From booked_manual where cust_mail = ? Limit 1";
		$INSERT ="INSERT into booked_manual(cust_name,cust_mail,cust_age,cust_doa,cust_rt,cust_cont)values(?,?,?,?,?,?)";

		$stmt=$conn ->prepare($SELECT);
		$stmt->bind_param("s",$Email);
		$stmt->execute();
		$stmt->bind_result($Email);
		$stmt->store_result();
		$rnum = $stmt->num_rows;
		if($rnum == 0){
			$stmt->close();
			$stmt = $conn->prepare($INSERT);
			$stmt->bind_param("sssiss",$Name,$Email,$Age,$Date,$RoomType,$Contact);
			$stmt->execute();
			echo"Thank you ,Will see you soon!";
		}else{
			echo"You have already Booked your slot";
		}$stmt->close();
		$conn->close();
	}
}else{
	echo"All fields are required ";
	die();
}
?>