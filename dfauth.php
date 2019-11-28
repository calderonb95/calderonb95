<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>

<?php include_once('layouts/header.php'); ?>

	<div class="container">
		<form method="POST" action="verificate_authcode.php">
			<h4>Se ha enviado un correo electrónico al correo asignado a su cuenta. Ingrese el código en el siguiente campo
		</h4>
			<div class="col-md-4">
				<input type="hidden" name="nmUserId" value="<?php echo $_GET['id']; ?>">
				<input type="text" name="nmAuthCode" class="form-control" maxlength="7" required></input>
				<br>
				<button type="submit" class="btn btn-primary"> Acceder</button>
				<button type="button" class="btn btn-info" onclick="send_code(<?php echo $_GET['id']; ?>)"> Enviar de nuevo</button>
			</div>
			
		</form>
	</div>
	</div>
</div>

<?php include_once('layouts/footer.php'); ?>