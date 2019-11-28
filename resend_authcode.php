<?php include_once('includes/load.php'); 
$data = $_POST['user_id'];

$code = generate_authcode();
set_authcode_to_user($data,$code);
?>