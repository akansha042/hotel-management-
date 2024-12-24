<?php
// print_r($_POST);
// die();
// /* Array ( [Cname] => prachi [Cemail] => thakorprachi08@gmail.com [CMobile] => 08999466504 [Username] => prachi.thakor__ [password] => Mahadev@88 )
$Name = $_POST['Cname'];
$Email = $_POST['Cemail'];
$Mobile = $_POST['CMobile'];
$Username = $_POST['Username'];
$Password = $_POST['password'];

if(!empty($Name) ||!empty($Email) ||!empty($Mobile) || !empty($Username) ||!empty($Password)){
	$conn=new mysqli("localhost","root","","create_acc");
	if(mysqli_connect_error())
	{
		die('Connection failed ('.mysqli_connect_errno().')'.mysqli_connect_error());

	}else{
		$SELECT ="SELECT Cemail From Account_details where Cemail = ? Limit 1";
		$INSERT ="INSERT into Account_details(Cname,Cemail,Cmobile,user_name,password)values(?,?,?,?,?)";

		$stmt=$conn ->prepare($SELECT);
		$stmt->bind_param("s",$Email);
		$stmt->execute();
		$stmt->bind_result($Email);
		$stmt->store_result();
		$rnum = $stmt->num_rows;
		if($rnum == 0){
			$stmt->close();
            $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
			$stmt = $conn->prepare($INSERT);
			$stmt->bind_param("sssss",$Name,$Email,$Mobile,$Username,$Password);
			$stmt->execute();
            $showAlert = true;

// If condition is met, generate JavaScript code to display the alert
if ($showAlert) {
    echo '<script type="text/javascript">';
    echo 'alert("Account created successfully!");';
    echo '</script>';
}
			// echo"Account created successfully!";
		}else{
            echo'<script type="text/javascript">';
            echo'alert("Already exist")';
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