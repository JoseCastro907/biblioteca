<?php

session_start();

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
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
	<title>Home</title>
</head>

<body>

	<?php include './inc/header.php' ?>

	<main>

		<h1>
			<?= $user['nombre'] ?>
			<?= $user['email'] ?>

		</h1>
	</main>
</body>

</html>