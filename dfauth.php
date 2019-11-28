<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>

<?php include_once('layouts/header.php'); ?>

	<div class="container">

	<!-- LOGIC : If user email is NULL show form else show message  -->
	<?php 
		$user_id = $_GET['id'];
		$email = get_email_by_user_id($user_id);
		
		if(is_not_null($email)){
	?>
		<form method="POST" action="verificate_authcode.php">
			<h4>Se ha enviado un correo electrónico a la  dirección: <?php echo "<strong style='color:red;'>" . get_email_by_user_id($user_id) . "</strong>" ?></h4>
			<div class="col-md-4">
				<input type="hidden" name="nmUserId" value="<?php echo $user_id; ?>">
				<input type="hidden" name="nmUserEmail" value="<?php echo $email; ?>">
				<input type="text" name="nmAuthCode" class="form-control" maxlength="7" required></input>
				<br>
				<button type="submit" class="btn btn-primary"> Acceder</button>
				<button type="button" class="btn btn-info" onclick="send_code(<?php echo $user_id; ?>)"> Enviar de nuevo</button>
			</div>		
		</form>
	<?php
		}
		else{
	?>
		<h4>Debe asignar un correo a la cuenta de usuario para poder autenticar!</h4>
		<button type="button" class="btn btn-primary" onclick="location.href='/index.php';">Regresar</button>
	<?php 
		} 
	?>
	<!-- LOGIC : End -->
	</div>
	</div>
</div>

<?php include_once('layouts/footer.php'); ?>