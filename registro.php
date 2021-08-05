<?php

session_start();

if (
	$_POST['nombre'] === ''
	|| $_POST['email'] === ''
	|| $_POST['contrasenia'] === ''
	|| $_POST['confirmar_contrasenia'] === ''
) {
	$_SESSION['error'] = true;
	$_SESSION['msj'] = 'LLene todos los campos';
	header('Location: index.php');
	die;
}

require './database.php';

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$contrasenia = $_POST['contrasenia'];
$confirmar_contrasenia = $_POST['confirmar_contrasenia'];

$existeEmail = $database->select('usuario', ['email'], [
	'email' => $email
]);

if (count($existeEmail) > 0) {
	$_SESSION['error'] = true;
	$_SESSION['msj'] = 'Este correo ya existe';
	header('Location: index.php');
	die;
}

if ($contrasenia !== $confirmar_contrasenia) {
	$_SESSION['error'] = true;
	$_SESSION['msj'] = 'Las contraseñas no coinciden';
	header('Location: index.php');
	die;
}

// Se encripta la contraseña
$passEncriptada = password_hash(base64_encode($contrasenia), PASSWORD_BCRYPT);

// Se hace el insert(registro) del usuario
$newUser = $database->insert('usuario', [
	'nombre' => $nombre,
	'email' => $email,
	'password' => $passEncriptada,
]);

// Se verifica que se hizo el insert(registro) correctamente
if ($newUser->rowCount() > 0) {
	$_SESSION['error'] = false;
	$_SESSION['msj'] = 'Registro exitoso!';

	$user = $database->select('usuario', ['email', 'nombre', 'id'], [
		'email' => $email
	]);
	$_SESSION['user'] = $user;

	header('Location: home.php');
	die;
} else {
	$_SESSION['error'] = true;
	$_SESSION['msj'] = 'Falló con exito!';
	header('Location: index.php');
	die;
}
