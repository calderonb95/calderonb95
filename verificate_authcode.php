<?php include_once('includes/load.php'); ?>
<?php

$user_id = $_POST['nmUserId'];
$auth_code = $_POST['nmAuthCode'];
$user_email = $_POST['nmUserEmail'];


 if (isValidAuthCode($user_id, $auth_code)){
    $session->login($user_id);
    //create session with id
    //$session->login($user_id);
    //Update Sign in time
    updateLastLogIn($user_id);
    //$session->msg("s", "Bienvenido al Inventario");
    redirect('home.php', false);
 }
 else{
    redirect('dfauth.php?id=' . $user_id, false);
 }

