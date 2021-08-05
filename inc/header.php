<header>
	<nav>
		<ul>

			<?php if (isset($_SESSION['user'])) : ?>
				<li><a href="perfil.php">Perfil</a></li>
				<li><a href="libro_form.php">Libro</a></li>
				<li><a href="libro_form_editar.php">Editar Libro</a></li>
				<li><a href="autor_form_insertar.php">Autor</a></li>
				<li><a href="cerrar_sesion.php">Cerrar Sesión</a></li>
			<?php else : ?>
				<li><a href="index.php">Registro</a></li>
				<li><a href="login.php">Login</a></li>
			<?php endif; ?>

		</ul>
	</nav>
</header>