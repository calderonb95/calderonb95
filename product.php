<?php
  $page_title = 'Lista de equipos';
  require_once('includes/load.php');

   page_require_level(2);
  $products = join_product_table();
    $groups = find_all('user_groups');
?>

<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      
      <div class="panel panel-default">

        <div class="panel-heading clearfix">
         <div class="pull-right">
           <a href="add_product.php" class="btn btn-primary">Agregar Equipo</a>
         </div>
       </div>

        <div class="panel-body">
        <h1 align="center">LISTA DE EQUIPOS </h1>

          <table class="table table-bordered">

            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Imagen</th>
                <th> Descripción </th>
                <th class="text-center" style="width: 10%;"> Categoría </th>
                <th class="text-center" style="width: 10%;"> Precio de compra </th>
                <th class="text-center" style="width: 10%;"> Ubicación </th>
                <th class="text-center" style="width: 10%;"> N. Serie </th>
                <th class="text-center" style="width: 10%;"> Proveedor </th>
                <th class="text-center" style="width: 10%;"> Estado </th>
                <th class="text-center" style="width: 10%;"> Registro </th>
                <th class="text-center" style="width: 10%;"> Fecha </th>
               <th class="text-center" style="width: 100px;"> Acciones </th>
              </tr>
            </thead>

            <tbody>

              <?php foreach ($products as $product):?>
              <tr>

                <td class="text-center"><?php echo count_id();?></td>

                <td>
                  <?php if($product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                <?php endif; ?>
                </td>

        <td> <?php echo remove_junk($product['nameprod']); ?></td>
        <td class="text-center"> <?php echo remove_junk($product['namecat']); ?></td>
        <td class="text-center"> <?php echo remove_junk($product['buy_price']); ?></td>
        <td class="text-center"> <?php echo remove_junk($product['ubicacion']); ?></td>
        <td class="text-center"> <?php echo remove_junk($product['serie']); ?></td>
        <td class="text-center"> <?php echo remove_junk($product['nombre']);?></td>
        <td class="text-center"> <?php echo remove_junk($product['product_status']);?></td>
        <td class="text-center"> <?php echo remove_junk($product['username']);?></td>
        <td class="text-center"> <?php echo remove_junk ($product['date']);?></td>
      
                <td class="text-center">

                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                     <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>

            </tr>

              <?php endforeach; ?>

            </tbody>


          </table>
        </div>


      </div>
    </div>
  </div>

  <?php include_once('layouts/footer.php'); ?>
