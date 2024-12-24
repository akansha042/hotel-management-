<?php
// print_r($_POST);
// die();
// /* Array ( [Cname] => prachi [Cemail] => thakorprachi08@gmail.com [CMobile] => 08999466504 [Username] => prachi.thakor__ [password] => Mahadev@88 )
$Name = $_POST['name'];
$Email = $_POST['email'];
$Mobile = $_POST['contact'];
$message = $_POST['commsg'];

if(!empty($Name) ||!empty($Email) ||!empty($Mobile) || !empty($message)){
	$conn=new mysqli("localhost","root","","contactconn");
	if(mysqli_connect_error())
	{
		die('Connection failed ('.mysqli_connect_errno().')'.mysqli_connect_error());

	}else{
		$SELECT ="SELECT email From Complaint_details where email = ? Limit 1";
		$INSERT ="INSERT into Complaint_details(name,email,mob_no,message)values(?,?,?,?)";

		$stmt=$conn ->prepare($SELECT);
		$stmt->bind_param("s",$Email);
		$stmt->execute();
		$stmt->bind_result($Email);
		$stmt->store_result();
		$rnum = $stmt->num_rows;
		if($rnum == 0){
			$stmt->close();
			$stmt = $conn->prepare($INSERT);
			$stmt->bind_param("ssss",$Name,$Email,$Mobile,$message);
			$stmt->execute();
            $showAlert = true;

// If condition is met, generate JavaScript code to display the alert
if ($showAlert) {
    echo '<script type="text/javascript">';
    echo 'alert("Complaint submitted");';
    echo '</script>';
}
			// echo"Account created successfully!";
		}else{
            echo'<script type="text/javascript">';
            echo'alert("something went wrong :(")';
            echo '</script>';
            
			// echo"This email is already having an account!";
		}$stmt->close();
		$conn->close();
	}
}else{
	echo"All fields are required ";
	die();
}
?>