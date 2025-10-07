<?php
include("init.php");
$response = "";
$feedback = 0;
if(isset($_POST['username'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	if(empty($username)){
		$response = "Please enter your username";
	}else if(empty($password)){
		$response = "Please enter your password";
	}else if(!$db->login($username,$password)){
		$response = "Incorrect login details";
	}else{
		$feedback = 1;
		$response = "Login is successful. Redirecting ...";
	}
}
/* Send json information */
echo json_encode(array("feedback"=>$feedback,"response"=>$response));
?>