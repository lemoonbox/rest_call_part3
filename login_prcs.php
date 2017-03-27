<?php 
include './lib/api_call.php';
$AUTH_URL = 'http://opleapi.cloudapp.net:9999/api-token-auth/'; 

if(isset($_POST["username"]) && isset($_POST["password"])){
	$username = trim($_POST["username"]);
	$passowrd = trim($_POST["password"]);

	$optarry =array(
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => $AUTH_URL,
	CURLOPT_USERAGENT => "auth-token request",
	CURLOPT_POST => 1,
	CURLOPT_POSTFIELDS => array(
		'username' => $_POST['username'],
		'password' => $_POST['password'],
		)
	);
	$resps = api_call($optarry);
	$resps_status = $resps[0];
	$resps_data = json_decode($resps[1], true);


	if($resps_status == 200){
		session_start();
		$resps_data = $resps_data['token'];
		$_SESSION['token'] = $resps_data;
		setcookie('token', $resps_data, time()+3600*24*365);
		$response = ['status'=>$resps_status, 'message'=>$resps_data];
		echo json_encode($response);
	}else{
		$response = ['status'=>$resps_status, 'message'=>''];
		echo json_encode($response);
	}
}else{
	$response = ['status'=>'400', 'message'=>''];

}
?>