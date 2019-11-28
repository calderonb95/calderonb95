<?php
  $page_title = 'Pagina Principal';
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>


<?php include_once('layouts/header.php'); ?>

<!DOCTYPE html>
<html>
<head>
<style>

h1 { font-family: Molengo;
  color: #FDFDFD;
 font-size: 30px; font-style: normal; font-variant: small-caps; font-weight: 400; line-height: 26.4px; }

</style>
</head>
</html>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
 <div class="col-md-12">
    <div class="panel">
      <div class="jumbotron text-center">
         <h1>Bienvenido a Belcorp</h1>
<br>
     <img src="http://buscarcursosyempleos.online/wp-content/uploads/2018/04/belcorp-750x450.png" width="400 px">
      </div>
    </div>
 </div>
</div>

<?php include_once('layouts/footer.php'); ?>
