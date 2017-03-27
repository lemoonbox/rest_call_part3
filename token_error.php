<?php
setcookie('token', '', time()-3600, '/');
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
토큰이 만료 되었거나, 잘못되었습니다. 다시 로그인 해주세요
<p><a href="/template/login.html">로그인 하기</a></p>
</body>
</html>