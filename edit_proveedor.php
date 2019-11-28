<?php
  $page_title = 'Editar Proveedor';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
 
  $proveedor = find_by_id('proveedor',(int)$_GET['id']);
  if(!$proveedor){
    $session->msg("d","Missing proveedor id.");
    redirect('proveedor.php');
  }
?>

<?php
if(isset($_POST['edit_provee'])){
  $req_field = array('proveedor-nombre');
  validate_fields($req_field);
  $provee_nombre = remove_junk($db->escape($_POST['proveedor-nombre']));
  if(empty($errors)){
        $sql = "UPDATE proveedor SET nombre='{$provee_nombre}'";
       $sql .= " WHERE id='{$proveedor['id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Proveedor actualizado con éxito.");
       redirect('proveedor.php',false);
     } else {
       $session->msg("d", "Lo siento, actualización falló.");
       redirect('proveedor.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('proveedor.php',false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
   <div class="col-md-5">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Editando <?php echo remove_junk(ucfirst($proveedor['nombre']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_proveedor.php?id=<?php echo (int)$proveedor['id'];?>">
           <div class="form-group">
               <input type="text" class="form-control" name="proveedor-nombre" value="<?php echo remove_junk(ucfirst($proveedor['nombre']));?>">
           </div>
           <button type="submit" name="edit_provee" class="btn btn-primary">Actualizar proveedor</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>
