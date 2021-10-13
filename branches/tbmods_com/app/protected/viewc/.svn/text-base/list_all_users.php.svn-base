<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "header.php"; ?>
<script>
function envio(to) {
document.userform.to.value=to;
document.userform.submit();
alert ('Notificación enviada');
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
    <form name="userform" method="post" action="">
    <ul data-role="listview" data-filter="true" data-inset="true">   
    
<!--  for laboratorio ---------------------------------------------------------------------------------------->
    
    <?php if ($_SESSION['user']['type']==1) { ?>
    
     <?php $i=0; foreach($data['users'] as $k1=>$v1): ?>
     <?php if ($v1->type==$data['ver']){ ?>
     <li>
     <?php if ($data['ver']==3){  echo "<a href='".$data['baseurl']."index.php/admin/updateuser/id/".$v1->username."' rel='external'>"; } ?>
         <h2><?php echo $v1->username; ?>: <?php echo $v1->nombres; ?> <?php echo $v1->apellidos; ?></h2>
         <p><?php echo $v1->correo; ?>,  <?php echo $v1->telefono; ?></p>
   	 <?php if ($data['ver']==3){  echo "</a>"; } ?>
     
     <?php if ($data['ver']==0){ ?>
         <span class="ui-li-count" <?php if ($data['total'.$i.'res']==0) echo "style='border-color:#F00'"; elseif ($data['total'.$i.'res']==$data['total'.$i.'asi']) echo "style='border-color:#0C6'"; else echo "style='border-color:#FC0'";?>> 
         
         <?php if ($data['total'.$i.'res']<>$data['total'.$i.'asi']) { ?>
         <a href="javascript:envio('<?php echo $v1->correo;?>');">Notificar</a>
         <?php } ?>
         
         Revisadas <?php echo $data['total'.$i.'res']." de ".$data['total'.$i.'asi']; ?></span>
     <?php } ?>
     </li>
     <?php $i++; } ?>
   	 <?php endforeach;?>
    
<!--  for adminuser ---------------------------------------------------------------------------------------->
    
    <?php } if ($_SESSION['user']['type']==2) { ?>
     
     <?php $i=0; foreach($data['users'] as $k1=>$v1): ?>
     <?php if ($v1->type==$data['ver']){ ?>
     <li>
     <a href="<?php echo $data['baseurl']; ?>index.php/admin/updateuser/id/<?php echo $v1->username; ?>" rel="external">
     <h2><?php echo $v1->username; ?>: <?php echo $v1->nombres; ?> <?php echo $v1->apellidos; ?></h2>
     <p><?php echo $v1->correo; ?>,  <?php echo $v1->telefono; ?></p></a>
      
      <?php if ($data['ver']==1){ //--------------Labs----------------------  ?>
              <span class="ui-li-count" <?php if ($data['total'.$i.'lab_new']==0) echo "style='border-color:#F00'"; elseif ($data['total'.$i.'lab_new']==$data['total'.$i.'lab_all']) echo "style='border-color:#0C6'"; else echo "style='border-color:#FC0'";?>> 
             
             Sin revisar: <?php echo $data['total'.$i.'lab_new']." <br>Total: ".$data['total'.$i.'lab_all']; ?></span>
      <?php } ?>
      
      <?php if ($data['ver']==0){ //--------------Experto----------------------  ?>
              <span class="ui-li-count" <?php if ($data['total'.$i.'res']==0) echo "style='border-color:#F00'"; elseif ($data['total'.$i.'res']==$data['total'.$i.'asi']) echo "style='border-color:#0C6'"; else echo "style='border-color:#FC0'";?>> 
             
             <?php if ($data['total'.$i.'res']<>$data['total'.$i.'asi']) { ?>
             <a href="javascript:envio('<?php echo $v1->correo;?>');">Notificar</a>
             <?php } ?>
             
             Revisadas <?php echo $data['total'.$i.'res']." de ".$data['total'.$i.'asi']; ?></span>
      <?php } ?>
      
     </li>
     <?php $i++; } ?>
   	 <?php endforeach;?>
     <?php if ($data['ver']==0){ ?>
     <li data-role="list-divider">
     <a href="<?php echo $data['baseurl']; ?>index.php/admin/list_all_users/cron_mail" rel="external">Notificar muestras pendientes</a>
     </li>
     <?php } ?>
     
    <?php } ?>
    
	</ul>
   

    <input type="hidden" name="to" />
              
              
 
   </form>
 </div><!-- /content -->
 
 



    <div data-role="footer" data-position="fixed" data-theme="b">
        <div><?php //echo $data['pager']; ?></div>
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
