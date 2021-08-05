<?php

session_start();

if (
 $_POST['nombre'] === ''
	|| $_POST['apellido'] === ''
	|| $_POST['nacionalidad'] === ''
) {
	$_SESSION['error'] = true;
	$_SESSION['msj'] = 'LLene todos los campos';
	header('Location: index.php');
	die;
}

require './database.php';

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$nacionalidad = $_POST['nacionalidad'];

$nuevoAutor = $database->insert('autor', [
	'nombre' => $nombre,
	'apellido' => $apellido,
	'nacionalidad' => $nacionalidad,
]);

if ($nuevoAutor->rowCount() > 0) {
	$_SESSION['error'] = false;
	$_SESSION['msj'] = 'Autor agregado';
	header('Location: home.php');
	die;
} else {
	$_SESSION['error'] = true;
	$_SESSION['msj'] = 'Error al agregar Autor';
	header('Location: autor_form_insertar.php');
	die;
}