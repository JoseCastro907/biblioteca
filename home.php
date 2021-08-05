<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <?php include './inc/header.php' ?>

    <h1>Home</h1>

    <?php /*
        $libros=$database->select('libro',[
            'id', 'isbn', 'titulo', 'portada', 'idioma', 'anio'
        ]);

        echo '<h2>Lista de libros</h2>';

        echo '<ul style="list-style:none; text-align:center">';

            foreach($libro as $libros){
                echo '<li>';
                echo '<a href="">'.$libro[]'</a>';
                echo '</li>';
            }

        echo '</ul>';
   */ ?>

</body>
</html>