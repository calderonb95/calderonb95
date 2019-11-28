<?php
$page_title = 'Reporte de Equipos';
$results = '';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
  if(isset($_POST['submit'])){
    $req_dates = array('start-date','end-date');
    validate_fields($req_dates);

    if(empty($errors)):
      $start_date   = remove_junk($db->escape($_POST['start-date']));
      $end_date     = remove_junk($db->escape($_POST['end-date']));
      $results      = find_product_by_dates($start_date,$end_date);
    else:
      $session->msg("d", $errors);
      redirect('product_report.php', false);
    endif;

  } else {
    $session->msg("d", "Selecciona la fecha");
    redirect('product_report.php', false);
  }
?>
<!doctype html>
<html lang="en-US">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Reporte de equipos Ingresados</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
   <style>
   @media print {
     html,body{
        font-size: 9.5pt;
        margin: 0;
        padding: 0;
     }.page-break {
       page-break-before:always;
       width: auto;
       margin: auto;
      }
    }
    .page-break{
      width: 980px;
      margin: 0 auto;
    }
     .sale-head{
       margin: 40px 0;
       text-align: center;
     }.sale-head h1,.sale-head strong{
       padding: 10px 20px;
       display: block;
     }.sale-head h1{
       margin: 0;
       border-bottom: 1px solid #212121;
     }.table>thead:first-child>tr:first-child>th{
       border-top: 1px solid #000;
      }
      table thead tr th {
       text-align: center;
       border: 1px solid #ededed;
     }table tbody tr td{
       vertical-align: middle;
     }.sale-head,table.table thead tr th,table tbody tr td,table tfoot tr td{
       border: 1px solid #212121;
       white-space: nowrap;
     }.sale-head h1,table thead tr th,table tfoot tr td{
       background-color: #f8f8f8;
     }tfoot{
       color:#000;
       text-transform: uppercase;
       font-weight: 500;
     }
   </style>
</head>
<body>
  <?php if($results): ?>
    <div class="page-break">
       <div class="sale-head pull-right">
           <h1>Reporte de Equipos Ingresados</h1>
           <strong><?php if(isset($start_date)){ echo $start_date;}?> a <?php if(isset($end_date)){echo $end_date;}?> </strong>
       </div>
      <table class="table table-border">
        <thead>
          <tr>
              <th>Fecha</th>
              <th>Descripción</th>
              <th>Categoria</th>
           
                <th> Precio de compra </th>
                <th> Ubicación </th>
                <th> N. Serie </th>
                <th> Proveedor </th>
                <th> Estado </th>
                <th> Registro </th>
         
          </tr>
        </thead>
        <tbody>
          <?php foreach($results as $result): ?>
           <tr>
              <td  align=center class=""><?php echo remove_junk($result['date']);?></td>
              <td align=center class="desc">
                <h6><?php echo remove_junk(ucfirst($result['nameprod']));?></h6>
              </td>
<td class="text-center"> <?php echo remove_junk($result['namecat']); ?></td>
        <td class="text-center"> <?php echo remove_junk($result['buy_price']); ?></td>
        <td class="text-center"> <?php echo remove_junk($result['ubicacion']); ?></td>
        <td class="text-center"> <?php echo remove_junk($result['serie']); ?></td>
        <td class="text-center"> <?php echo remove_junk($result['nombre']);?></td>
        <td class="text-center"> <?php echo remove_junk($result['product_status']);?></td>
        <td class="text-center"> <?php echo remove_junk($result['username']);?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>



      </table>

      <div class="btn-group">
                    <a href="product_report.php" class="btn btn-info btn-xs"  title="Volver" data-toggle="tooltip">
                      <span class=" glyphicon glyphicon-arrow-left"></span>
                    </a>
                  
                  </div>
    </div>
  <?php
    else:
        $session->msg("d", "No se encontraron los equipos. ");
        redirect('product_report.php', false);
     endif;
  ?>





</body>
</html>
<?php if(isset($db)) { $db->db_disconnect(); } ?>