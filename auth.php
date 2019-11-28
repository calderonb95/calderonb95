<?php include_once('includes/load.php'); ?>
<?php
$req_fields = array('username','password' );
validate_fields($req_fields);
$username = remove_junk($_POST['username']);
$password = remove_junk($_POST['password']);

if(empty($errors)){
  $user_id = authenticate($username, $password);
  if($user_id){
    $email = get_email_by_user_id($user_id);

    if(is_not_null($email)){
      $code = generate_authcode();
      set_authcode_to_user($user_id,$code);
      send_email($email, $code);
    }
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
