<?php
session_start();

if (!isset($_SESSION['user'])) {
	header('Location: login.php');
	exit;
}
/*
if(isset($_SESSION['user'])){
    header('Location: home.php');
    exit;
}
*/
require './database.php';
/*
if($idLibro == ''){
    header('location: home.php');
    exit;
}


*/
$libros=$database->select('libro',[
    'isbn',
    'titulo',
    'portada',
    'anio',
    'idioma',
]
);
$idLibro = $_GET['id'];
/*
if(count($libros) === 0){
	header('Location: home.php');
	exit;

//es el where del select de arriba	    [
        'id'=>$idLibro
    ]
}
*/
$libro = $libros[0];

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Editar Libro</title>
</head>

<body>

	<?php

	if (isset($_SESSION['error']) && $_SESSION['error']) {
		echo '<span class="error">' . $_SESSION['msj'] . '</span>';

		unset($_SESSION['error']);
		unset($_SESSION['msj']);
	}

	?>

	<form action="libro_editar.php" method="POST" enctype="multipart/form-data">

		<label for="titulo">Titulo</label><br>
		<input type="text" name="titulo" id="titulo" value= "<?= $libro['titulo'] ?>"><br><br>

		<label for="isbn">ISBN</label><br>
		<input type="text" name="isbn" id="isbn" value="<?= $libro['isbn'] ?>"><br><br>

        <img width=200 rem src="<?= $libro['portada'] ?>" alt=""><br>

		<label for="portada">Portada</label><br>
		<input type="file" name="portada" id="<?= $libro['portada'] ?>"><br><br>

		<label for="anio">Año</label><br>
		<input type="number" name="anio" id="anio" value="<?= $libro['anio'] ?>"><br><br>

		<label for="idioma">Idioma</label><br>
		<input type="text" max="2" name="idioma" id="idioma" value="<?= $libro['idioma'] ?>"><br><br>

		<input type="submit" value="Insertar libro">    

	</form>
</body>

</html>