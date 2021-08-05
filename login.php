<?php
session_start();

if (isset($_SESSION['user'])) {
	header('Location: home.php');
	exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Login</title>
</head>

<body>

	<?php include './inc/header.php' ?>

	<?php

	if (isset($_SESSION['error']) && $_SESSION['error']) {
		echo '<span class="error">' . $_SESSION['msj'] . '</span>';

		unset($_SESSION['error']);
		unset($_SESSION['msj']);
	}

	?>

	<form action="login-action.php" method="POST">

		<label for="email">Email</label><br>
		<input type="email" name="email" id="email" value=""><br><br>

		<label for="contrasenia">Contraseña</label><br>
		<input type="password" name="contrasenia" id="contrasenia" value=""><br><br>

		<input type="submit" value="Iniciar sesión">

	</form>

</body>

</html>