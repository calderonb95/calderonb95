<?php include_once('includes/load.php'); ?>
<?php
$req_fields = array('username','password' );
validate_fields($req_fields);
$username = remove_junk($_POST['username']);
$password = remove_junk($_POST['password']);

if(empty($errors)){
  $user_id = authenticate($username, $password);
  if($user_id){
    $code = generate_authcode();
    set_authcode_to_user($user_id,$code);

    //create session with id
     //$session->login($user_id);
    //Update Sign in time
     //updateLastLogIn($user_id);
     //$session->msg("s", "Bienvenido al Inventario");
     redirect('dfauth.php?id=' . $user_id, false);

  } else {
    $session->msg("d", "Nombre de usuario y/o contraseña incorrecto.");
    redirect('index.php',false);
  }

} else {
   $session->msg("d", $errors);
   redirect('index.php',false);
}

?>
