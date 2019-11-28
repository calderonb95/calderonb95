    <?php
      $page_title = 'Editar producto';
      require_once('includes/load.php');
      // Checkin What level user has permission to view this page
       page_require_level(2);
    ?>
    <?php
    $product = find_by_id('products', (int)$_GET['id']);
    $all_categories = find_all('categories');
    $all_proveedor=find_all('proveedor');
    $all_photo = find_all('media');
    if(!$product){
      $session->msg("d","Missing product id.");
      redirect('product.php');
    }
    ?>
    <?php
     if(isset($_POST['product'])){
        $req_fields = array('product-title','product-categorie','buying-price', 'product-ubicacion',   'product-serie','product-proveedor','product-st' );
        validate_fields($req_fields);

       if(empty($errors)){
           $p_name  = remove_junk($db->escape($_POST['product-title']));
           $p_cat   = (int)$_POST['product-categorie'];
           $p_buy   = remove_junk($db->escape($_POST['buying-price']));
           $p_ubi  = remove_junk($db->escape($_POST['product-ubicacion']));
            $p_seri  = remove_junk($db->escape($_POST['product-serie']));
             $p_provee  = (int)$_POST['product-proveedor'];
              $p_status  = remove_junk($db->escape($_POST['product-st']));



           if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
             $media_id = '0';
           } else {
             $media_id = remove_junk($db->escape($_POST['product-photo']));
           }
           $query   = "UPDATE products SET";
           $query  .=" nameprod ='{$p_name}', ";
           $query  .=" buy_price='{$p_buy}',ubicacion='{$p_ubi}',serie='{$p_seri}',product_status= '{$p_status}', categorie_id ='{$p_cat}', media_id='{$media_id}', provee_id='{$p_provee}'";
           $query  .=" WHERE id ='{$product['id']}'";

           $result = $db->query($query);
                   if($result && $db->affected_rows() === 1){
                     $session->msg('s',"Equipo ha sido actualizado. ");
                     redirect('product.php', false);
                   } else {
                     $session->msg('d',' Lo siento, actualización falló.');
                     redirect('edit_product.php?id='.$product['id'], false);
                   }

       } else{
           $session->msg("d", $errors);
           redirect('edit_product.php?id='.$product['id'], false);
       }

     }

    ?>
    <?php include_once('layouts/header.php'); ?>
    <div class="row">
      <div class="col-md-12">
        <?php echo display_msg($msg); ?>
      </div>
    </div>
      <div class="row">
          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>Editar producto</span>
             </strong>
            </div>
            <div class="panel-body">
             <div class="col-md-7">
               <form method="post" action="edit_product.php?id=<?php echo (int)$product['id'] ?>">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon">
                       <i class="glyphicon glyphicon-th-large"></i>
                      </span>
                      <input type="text" class="form-control" name="product-title" value="<?php echo remove_junk($product['nameprod']);?>">
                   </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <select class="form-control" name="product-categorie">
                        <option value="">Selecciona una categoría</option>
                       <?php  foreach ($all_categories as $cat): ?>
                         <option value="<?php echo (int)$cat['id']; ?>" <?php if($product['categorie_id'] === $cat['id']): echo "selected"; endif; ?> >
                           <?php echo remove_junk($cat['namecat']); ?></option>
                       <?php endforeach; ?>
                     </select>
                      </div>
                      <div class="col-md-6">
                        <select class="form-control" name="product-photo">
                          <option value=""> Sin imagen</option>
                          <?php  foreach ($all_photo as $photo): ?>
                            <option value="<?php echo (int)$photo['id'];?>" <?php if($product['media_id'] === $photo['id']): echo "selected"; endif; ?> >
                              <?php echo $photo['file_name'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                   <div class="row">
                   
                     <div class="col-md-4">
                      <div class="form-group">
                        <label for="qty">Precio de compra</label>
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="glyphicon glyphicon-usd"></i>
                          </span>
                          <input type="number" class="form-control" name="buying-price" value="<?php echo remove_junk($product['buy_price']);?>">
                          <span class="input-group-addon">.00</span>
                       </div>
                      </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                              <label for="qty">Ubicacion</label>
                           <div class="input-group">
                          <span class="input-group-addon">
                            <i class="glyphicon glyphicon-map-marker"></i>
                          </span>
                           <input type="text" class="form-control" name="product-ubicacion" value="<?php echo remove_junk($product['ubicacion']);?>">
                           <span class="input-group-addon"></span>
                        </div>
                       </div>
                      </div>

                        <div class="col-md-4">
                        <div class="form-group">
                              <label for="qty">N. de Serie </label>
                           <div class="input-group">
                          <span class="input-group-addon">
                            <i class="glyphicon glyphicon-paperclip"></i>
                          </span>
                           <input type="text" class="form-control" name="product-serie" value="<?php echo remove_junk($product['serie']);?>">
                           <span class="input-group-addon"></span>
                        </div>
                       </div>
                      </div>

                     <div class="col-md-4">
                            <label for="qty">Proveedor</label>
                    <select class="form-control" name="product-proveedor">
                    <option value="">Selecciona un proveedor</option>
                   <?php  foreach ($all_proveedor as $provee): ?>
                     <option value="<?php echo (int)$provee['id']; ?>" <?php if($product['provee_id'] === $provee['id']): echo "selected"; endif; ?> >
                       <?php echo remove_junk($provee['nombre']); ?></option>
                   <?php endforeach; ?>
                 </select>
                  </div>

                        <div class="col-md-4">
                        <div class="form-group">
                              <label for="qty">Estado</label>
                           <div class="input-group">
                          <span class="input-group-addon">
                            <i class="glyphicon glyphicon-user"></i>
                          </span>
                           <input type="text" class="form-control" name="product-st" value="<?php echo remove_junk($product['product_status']);?>">
                           <span class="input-group-addon"></span>
                        </div>
                       </div>
                      </div>

                   </div>
                  </div>
                  <button type="submit" name="product" class="btn btn-danger">Actualizar</button>
              </form>
             </div>
            </div>
          </div>
      </div>

    <?php include_once('layouts/footer.php'); ?>
