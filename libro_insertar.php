<?php

session_start();

if (
	$_POST['titulo'] === ''
	|| $_POST['isbn'] === ''
	|| $_POST['anio'] === ''
	|| $_POST['idioma'] === ''
) {
	$_SESSION['error'] = true;
	$_SESSION['msj'] = 'LLene todos los campos';
	header('Location: index.php');
	die;
}

require './database.php';

$titulo = $_POST['titulo'];
$isbn = $_POST['isbn'];
$anio = $_POST['anio'];
$idioma = $_POST['idioma'];

// TODO: Verificar que el isbn no este registrado

// TODO: Subir portada al servidor

$archivos = $_FILES['portada'];

if(count($archivos)>0){
	$name = $archivos['name'];
	$type = $archivos['type'];
	$tmp_name = $archivos['tmp_name'];
	$error = (int) $archivos['error'];
	$size = $archivos['size'];

	$nameArray = explode('.', $name);
	$extension = end($nameArray);

	if($error !== 0){
		$_SESSION['error'] = true;
		$_SESSION['msj'] = 'Error al subir la imagen';
		header('Location: libro_form.php');
		die;
	}

	if($size > 5000000){
		$_SESSION['error'] = true;
		$_SESSION['msj'] = 'Imagen excede los 5MB';
		header('Location: libro_form.php');
		die;
	}

	$fileTypes = ['pnh', 'jpg', 'jpeg', 'gif', 'svg', 'webp'];
	if(!in_array($extension, $fileTypes)){
		$_SESSION['error'] = true;
		$_SESSION['msj'] = 'Los formatos válidos son: ' . implode(', ', $fileTypes);
		header('Location: libro_form.php');
		die;
	}
	$nombreImagen = 'uploads/portada-libro-' . uniqid() . '.' . $extension;
	//if(!move_uploaded_file($tmp_name, $nombreImagen)){
	if(!copy($tmp_name, $nombreImagen)){
		$_SESSION['error'] = true;
		$_SESSION['msj'] = 'Error al subir la imagen';
		header('Location: libro_form.php');
		die;
	}
}

// Se hace el insert(registro) del usuario
$nuevoLibro = $database->insert('libro', [
	'idioma' => $idioma,
	'isbn' => $isbn,
	'anio' => $anio,
	'titulo' => $titulo,
	'portada' => $nombreImagen
]);

// Se verifica que se hizo el insert(registro) correctamente
if ($nuevoLibro->rowCount() > 0) {
	$_SESSION['error'] = false;
	$_SESSION['msj'] = 'Libro agregado';
	header('Location: home.php');
	die;
} else {
	$_SESSION['error'] = true;
	$_SESSION['msj'] = 'No se pudo agregar el libro, que sad :(';
	header('Location: libro_form.php');
	die;
}
