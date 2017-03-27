<?php  
//토큰만료 에러 삽입해줘야 한다.
include './lib/api_call.php';


session_start();
$token = 'Token '.$_SESSION['token'];
$api_urlinit = 'http://opleapi.cloudapp.net:9999/product/';
$limit = "20";
$offset = isset($_GET['offset'])? $_GET['offset']:"0";
$api_urlset = $api_urlinit."?limit=".$limit."&offset=".$offset;

$opt_array =array(
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL =>$api_urlset,
	CURLOPT_HTTPHEADER =>array(
	'Authorization:'.$token,
	));

$resp=api_call($opt_array);

$resparray = json_decode($resp[1], true);


//data array init
$tabledatas = array();
$resultarr = array();


if($resp[0] == 401){
	$tabledatas['status'] = $resp[0];
	$tabledatas['results'] = $resparray['detail'];
	echo json_encode($tabledatas);
	return 0;
}

//paging data generator
$page_num = array();
if(isset($resparray['previous'])){
	if($offset-40>0){
	$tabledatas['url_pre2'] = $offset-40;
	$page_num[($offset/20)-1] = $offset-40;
	}
	$tabledatas['url_pre1'] = $offset-20;
	$page_num[($offset/20)] = $offset-20;

}
$page_num[($offset/20+1)] = $offset+0;
if(isset($resparray['next'])){
	$tabledatas['url_next1'] = $offset+20;
	$page_num[($offset/20)+2] = $offset+20;
	if($offset+40<$resparray['count']){
		$tabledatas['url_next2'] = $offset+40;
		$page_num[($offset/20)+3] = $offset+40;
	}
}
$tabledatas['page_num']=$page_num;

//create value set
foreach ($resparray['results'] as $valueset) {
	array_push($resultarr, array(
		'id' =>$valueset['id'],
		'name' =>$valueset['name'],
		'size' =>$valueset['size'],
		'bundle' =>$valueset['bundle'],
		'supplier' => $valueset['supplier']['name'],
		'is_tax' =>$valueset['is_tax'],
		));
};
$tabledatas['status'] = $resp[0];
$tabledatas['results'] = $resultarr;


echo json_encode($tabledatas);

?>