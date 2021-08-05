<?php  

     session_start();
    
      if(!isset($_SESSION['user'])){
         header('Location: home.php');
         exit;
      }
     require './database.php';

   
        $autores = $database->select(
            'autor',
        ['id','nombre','apellido']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agregar Libro</title>
    <link rel="stylesheet" href="assets/css/barq.css">


</head>
<body>

<?php
    if(isset($_SESSION['error']) &&  $_SESSION['msj']){
        echo '<span class="error">' .  $_SESSION['msj'] . '  </span>';
        unset($_SESSION['error']);
        unset($_SESSION['msj']);
    }
?>
    
<form action="libro_insertar.php" method="POST" enctype="multipart/form-data">

<label for="isbn">ISBN</label><br>
<input type="text" name="isbn" id="isbn"><br><br>

<label for="titulo">Titulo</label><br>
<input type="text" name="titulo" id="titulo"><br><br>


<label for="idioma">Idioma</label><br>
<input type="text" name="idioma" id="idioma"><br><br>

<label for="anio">Año</label><br>
<input type="number" name="anio" id="anio"><br><br>

<label for="Portada">Portada</label><br>
<input type="file" name="portada" id="portada"><br><br>

<label for="autor">Autor</label><br>

<select name="autor" id="autor_select">

    <option value="0">Escoge un autor</option>
<?php foreach ($autores as $autor) : ?>
<br><br>

    <option value="<?= $autor['id']?>"><?=$autor['nombre']?><?=$autor['apellido']?></option>
<?php endforeach ?>
</select>

<input type="submit" value="Insertar libro">

<script src="assets/js/barq.js"></script>
<script src="assets/js/app.js"></script>
</form>
</body>
</html>