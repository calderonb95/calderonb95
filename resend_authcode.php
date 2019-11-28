<?php 

include_once('includes/load.php'); 

$user_id = $_POST['user_id'];
$user_email = $_POST['email'];
$code = generate_authcode();

set_authcode_to_user($user_id,$code);
send_email($user_email,$code);

