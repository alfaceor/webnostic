<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "header.php"; ?>
<script>
function ocultar(x,a) {
document.calibform.id_calib.value=x;
document.calibform.hide_calib.value=a;
document.calibform.submit();
}			
</script>
</head>
<body>


<div data-role="page" class="ui-responsive-panel">
    <div data-role="header" data-theme="b" data-position="fixed">
       
        <a href="#nav-panel" data-icon="bars">MENU / <?php echo $data['title']; ?></a>
        
       <h1><?php echo $data['disease']." (<i>".$data['user']['nombres']." ".$data['user']['apellidos']."</i>)"; ?></h1>
        
        <a href="#" data-rel="back" data-icon="back" data-iconpos="notext">Regresar</a>   
        
     </div><!-- /header -->
    
    <div data-role="content" class="jqm-content">
    
    <form name="calibform" action="<?php echo $data['listurl']; ?>" method="post" data-ajax="false">
    
     <input type="hidden" name="id_calib">
	 <input type="hidden" name="hide_calib">
     
    <table data-role="table" id="movie-table" data-mode="reflow" class="ui-responsive table-stroke">
        <thead>
        <tr class="ui-bar-e">
            <th>VALOR</th>
            <th>ESTADO</th>
            <th>FECHA</th>
            <th>MICROSCOPIO</th>
            <th>ACTIVO</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach($data['calibrations'] as $k1=>$v1): ?>
        <tr <?php if ($v1->hide==1) echo 'style="border: 2px dashed #ff9896;opacity: 0.3;"'; ?>>
            <td> <?php echo $v1->value; ?> <?php //echo $v1->id; ?></td>
            <td> <?php if($v1->status_id==1) echo "<b>En cola</b>";if($v1->status_id==2) echo "<b>Procesando</b>";if($v1->status_id==3) echo "Listo";if($v1->status_id==4) echo "<b>Error</b>"; ?></td>
            <td> <?php echo $v1->ts; ?>            </td>
            <td> <?php echo $v1->description; ?>   </td>
            <td>
            <?php if ($v1->hide==1) { ?>
            <a href="javascript:ocultar(<?php echo $v1->id;?>,0);" data-role="button" data-icon="alert" data-iconpos="notext" data-theme="e" data-inline="true">Desocultar</a>
            <?php } else { ?>
            <a href="javascript:ocultar(<?php echo $v1->id;?>,1);" data-role="button" data-icon="alert" data-iconpos="notext" data-theme="c" data-inline="true">Ocultar</a>
            <?php } ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
   </form> 
 </div><!-- /content -->
    <div data-role="footer" data-position="fixed" data-theme="b">
        <div></div>
    </div><!-- /footer -->
    <div data-role="panel" data-position-fixed="true" data-theme="e" id="nav-panel">
        <ul data-role="listview" data-inset="true">

          <?php include "navbar.php"; ?>
            
        </ul>
    </div><!-- /panel -->
    <div data-role="panel" data-position="right" data-position-fixed="true" data-display="overlay" data-theme="b" id="add-form">
         <?php include "topbar.php"; ?>
    </div><!-- /panel -->
</div>
</body>
</html>
