<?php

session_start();

if ($_POST['email'] === '' || $_POST['contrasenia'] === '') {
	$_SESSION['error'] = true;
	$_SESSION['msj'] = 'LLene todos los campos';
	header('Location: login.php');
	die;
}

//TODO: Incluir database
require './database.php';

$email = $_POST['email'];
$contrasenia = $_POST['contrasenia'];

// Hacer select para tener el user(where => email)
$existeEmail = $database->select('usuario', ['email', 'password', 'nombre', 'id'], [
	'email' => $email
]);

// Verificar que exista el email
if (count($existeEmail) > 0) {
	$user = $existeEmail[0];

	// Verificar que los pass sean los mismos
	$coincidenContrasenias = password_verify(base64_encode($contrasenia), $user['password']);

	if ($coincidenContrasenias) {
		$_SESSION['error'] = false;
		$_SESSION['msj'] = 'Inicio de sesión exitoso!';

		//Eliminamos la contraseña del array
		unset($user['password']);

		// Almacenamos en sesion el usuario logueado
		$_SESSION['user'] = $user;

		header('Location: home.php');
		die;
	} else {
		$_SESSION['error'] = true;
		$_SESSION['msj'] = 'Email o (contraseña) incorrectos';
		header('Location: login.php');
		die;
	}
} else {
	$_SESSION['error'] = true;
	$_SESSION['msj'] = '(Email) o contraseña incorrectos';
	header('Location: login.php');
	die;
}
