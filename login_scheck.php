<?php 
session_start();
$cs_rps = ['status'=>200, 'message'=>"login_OK"];
$cs_rps = ['status'=>200, 'message'=>"make session"];
$er_rps = ['status'=>400, 'message'=>"login_ERROR"];
if(isset($_SESSION['token'])){
	echo json_encode($cs_rps);
}else{
	if(isset($_COOKIE['token'])){
		$token = $_COOKIE['token'];
		$_SESSION['token']=$token;	
		echo json_encode($cs_rps);
		return ;
	}
	echo json_encode($er_rps);
}
?>