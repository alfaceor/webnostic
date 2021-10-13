<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "header.php"; ?>
<script>
$(document).ready(function () {
 $('.numeros').keyup(function() {
		
        var $th = $(this);
        $th.val( $th.val().replace(/[^0-9]/g, function(str) { 
            //$('#cod small').replaceWith('<small>Error: Porfavor ingrese solo letras y números</small>');
            
            return ''; } ) );
			
			//$('#cod small').replaceWith('<small>Aqui ingrese siglas o un nombre corto de letras y números</small>');
    });
});
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
        
        
        <p><h6><?php echo $data['content']; ?></h6></p>
        
            <form id="userform" action="<?php echo $data['save_user']; ?>" method="post">
                
                		<div data-role="fieldcontain">
                        <label for="username"><?php if ( $_SESSION['user']['type']==1) echo "DNI o CODIGO HISTORIA"; else echo "Usuario"; ?></label>
                        <?php if( $data['method_flag']=='updateUser' ): ?>
                        <input id="username" readonly type="text" name="username" value="<?php echo $data['username']; ?>" />
                        <?php else: ?>
                        <input id="username" data-clear-btn="true" type="text" name="username" value="<?php echo $data['username']; ?>" required />
                        <?php endif; ?>
                        </div>
                        
                   		<div data-role="fieldcontain">
                        <label for="password">Contraseña</label>
     					<input type="password" data-clear-btn="true" name="password" id="password" value="<?php echo $data['password']; ?>" required>
                        </div>
                        <div data-role="fieldcontain">
                        <label for="nombre">Nombre</label>
     					<input type="text" data-clear-btn="true" name="nombres" id="nombre" value="<?php echo $data['nombres']; ?>" required>
                        </div>
                    	<div data-role="fieldcontain">
                        <label for="apellidos">Apellidos</label>
     					<input type="text" data-clear-btn="true" name="apellidos" id="apellidos" value="<?php echo $data['apellidos']; ?>">
                  		</div>
                        <div data-role="fieldcontain">
                        <label for="correo">E-mail</label>
     					<input type="email" data-clear-btn="true" name="correo" id="correo" value="<?php echo $data['correo']; ?>">
                   		</div>
                        <div data-role="fieldcontain">
                        <label for="telefono">Celular</label>
     					<input type="number" data-clear-btn="true" name="telefono" id="telefono" value="<?php echo $data['telefono']; ?>" required class="numeros">
                        </div>
                        
                    <?php if ( $_SESSION['user']['type']==2) { ?>    
                    <div data-role="fieldcontain">
                    <fieldset data-role="controlgroup" data-type="horizontal"  data-mini="true">
        			<legend>Tipo</legend>
        			<input type="radio" name="type" value="0" id="member" <?php if ($data['type']=="0") echo "checked"; ?> >
        			<label for="member">Experto</label>
       			 	<input type="radio" name="type" value="1" id="admin" <?php if ($data['type']=="1") echo "checked"; ?>>
        			<label for="admin">Laboratorio</label>
    				</fieldset>
                        </div>
                    <?php }?> 
                    
                    <?php if ( $_SESSION['user']['type']==1) { ?>    
                    <input type="hidden" name="type" value="3" >
                    <?php }?> 
                    
                    <?php if ($Var_noexiste) { ?> 
                        <div data-role="fieldcontain">
                     <fieldset data-role="controlgroup" data-type="horizontal"  data-mini="true">
        			<legend>Estado:</legend>
        			<input type="radio" name="status" value="1" id="activo" <?php if ($data['status']=="1") echo "checked"; ?>>
        			<label for="activo">Activo</label>
       			 	<input type="radio" name="status" value="0" id="inactivo" <?php if ($data['status']=="0") echo "checked"; ?>>
        			<label for="inactivo">Inactivo</label>
    				</fieldset>
                    </div>
                    <?php } else if ( $_SESSION['user']['type']==1) { 
					echo '<input type="hidden" name="status" id="status" value="'.$_SESSION['user']['username'].'">';
					} else { ?> 
                    <input type="hidden" name="status" id="status" value="1">
                    <?php } ?> 
                <div data-role="fieldcontain">
                 <input value="Guardar" type="submit" data-icon="check" data-iconpos="left" data-mini="true" data-theme="e" data-inline="true" />
                </div>
            </form>
            </div><!-- /content -->
    <div data-role="footer" data-position="fixed" data-theme="b">
        
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
