<?php
session_start();

if (!isset($_SESSION['user'])) {
	header('Location: login.php');
	exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Insertar Autor</title>
</head>

<body>

	<?php

	if (isset($_SESSION['error']) && $_SESSION['error']) {
		echo '<span class="error">' . $_SESSION['msj'] . '</span>';

		unset($_SESSION['error']);
		unset($_SESSION['msj']);
	}

	?>

	<form action="autor_insertar.php" method="POST" enctype="multipart/form-data">

		<label for="nombre">Nombre</label><br>
		<input type="text" name="nombre" id="nombre" ><br><br>

		<label for="apellido">apellido</label><br>
		<input type="text" name="apellido" id="apellido" ><br><br>

		<label for="nacionalidad">Nacionalidad</label><br>
		<input type="text" name="nacionalidad" id="nacionalidad" ><br><br>

		<input type="submit" value="Insertar autor">

	</form>
</body>

</html>