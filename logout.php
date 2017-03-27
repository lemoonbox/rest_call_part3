<?php
setcookie('token', '', time()-3600, '/');
session_start();
session_destroy();
echo "<script>window.location.replace('/template/login.html');</script>";
?>
