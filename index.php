<?php
require_once "connection.php";
$link = mysqli_connect($host, $user, $password, $database)
	or die("Ошибка" . mysqli_error($link));

mysqli_close($link);
?>