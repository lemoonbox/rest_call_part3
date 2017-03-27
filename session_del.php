<?php
session_start();
session_destroy();
// echo "<script>window.location.replace('/template/login.html');</script>";
echo "테스트를 위해 리다이렉트 하지 않습니다.";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div id="sign_menu">
		<p><a href='./template/login.html'>로그인 하기(자동로그인됩니다.)</a></p>
	</div>
</body>
</html>
