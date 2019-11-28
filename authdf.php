<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>

<?php include_once('layouts/header.php'); ?>

	<div class="container">
		<form method="POST" action="">
			<h4>Se ha enviado un correo electrónico a . Ingrese el código en el siguiente campo</h4>
			<div class="col-md-4">
				<input type="text" class="form-control"></input>
				<br>
				<button class="btn btn-primary"> Enviar</button>
			</div>
			
		</form>
	</div>
	</div>
</div>
