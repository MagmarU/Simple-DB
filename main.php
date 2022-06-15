<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;600;700&family=Rowdies:wght@300&display=swap" rel="stylesheet">

	<!--
	<link type="php" href="index.php">
	<link type="php" href="create.php">
	<link type="php" href="tables.php">
	-->

</head>
<body>
	<!--

	<nav>
		<div class="topnav" id="myTopnav">
			<a class="Home" href="main.php">Home</a>
			<a href="create.php" class="About">Create</a>
			<a href="tables.php" class="About">Database</a>
		</div>
	</nav>
	-->
	<div class="menu">
		<section>
		<input type="checkbox" id="add/delete" class="hide"/>
		
		<label for="add/delete">Add/Delete</label>
		<div>
			
		<h2>Добавить товар</h2>
		<form method="POST">
		<p>Введите название товара:<br> 
		<input type="text" name="name" /></p>

		<p>Единица измерения: <br> 
		<input type="text" name="edizm" /></p>

		<p>Цена:<br> 
		<input type="text" name="cena" /></p>

		<input type="submit" name = "wor" value="Add">
		<input type="submit" name = "wor" value="Delete">
		</form>

		<?php
		require_once 'connection.php'; // подключаем скрипт
		$action = $_POST['wor'];
		switch ($action) {
		    case 'Add':
		    if(isset($_POST['name']) && isset($_POST['edizm']) && isset($_POST['cena'])){
		 
		    // подключаемся к серверу
		    $link = mysqli_connect($host, $user, $password, $database) 
		        or die("Ошибка " . mysqli_error($link)); 

		    // экранирования символов для mysql
		    $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
		    $edizm = htmlentities(mysqli_real_escape_string($link, $_POST['edizm']));
		    $cena = intval(htmlentities(mysqli_real_escape_string($link, $_POST['cena'])));

		    
		    // создание строки запроса
		    $query ="INSERT INTO tovary(Tovar, Edizm, Cena) VALUES('$name','$edizm', $cena)";

		    // выполняем запрос
		    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
		    if($result)
		    {
		        echo "<span style='color:blue;'>Данные добавлены</span>";
		    }
		    // закрываем подключение
		    mysqli_close($link);
		}
		    break;
		    
		    case 'Delete':
		    if(isset($_POST['name'])){
		    $link = mysqli_connect($host, $user, $password, $database) 
		        or die("Ошибка " . mysqli_error($link));


		    $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));

		    $delete ="DELETE FROM Tovary Where Tovar = '$name'";
		    
		    $result = mysqli_query($link, $delete) or die("Ошибка " . mysqli_error($link)); 
		    if($result)
		    {
		        echo "<span style='color:blue;'>Были внесены изменения</span>";
		    }
		    // закрываем подключение
		    mysqli_close($link);    
		    }    
		        break;
		}
		?>
		
		</div>


		</section>


<br>
<br>
<section>
		<input type="checkbox" id="Database" class="hide"/>
		
		<label for="Database">Database</label>
		<div>
		<?php

		require_once 'connection.php';
		$link = mysqli_connect($host, $user, $password, $database)
			or die("Ошибка" . mysqli_error($link));

		$sql = mysqli_query($link, 'SELECT `Tovar`, `Edizm`, `Cena` FROM `Tovary`');
		  while ($result = mysqli_fetch_array($sql)) {
		    echo "{$result['Tovar']}, {$result['Edizm']}, {$result['Cena']} рублей<br>";
		  }

		mysqli_close($link);

		?>

		</div>


		</section>

	</div>
</body>
</html>