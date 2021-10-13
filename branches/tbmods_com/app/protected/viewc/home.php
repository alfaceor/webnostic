<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "header.php"; ?>
</head>
<body>


<div data-role="page" class="ui-responsive-panel">
    <div data-role="header" data-theme="b" data-position="fixed">
       
       
        
       <h1><?php echo $data['disease']; ?></h1>
        
         
        
    </div><!-- /header -->
    
    <div data-role="content" class="jqm-content">
        
        <p align="center"> 
		<ul data-role="listview" data-inset="true">
		<?php if( $data['user'] == Null ): ?>
        <form id="loginform" action="<?php echo $data['baseurl']; ?>index.php/login" method="post">
            
                <label for="username">Usuario: </label>
                <input name="username" id="username" type="text" maxlength="45" value="<?php echo $_GET['userweb']; ?>"/>
                <label for="password">Contraseña</label>
                <input name="password" id="password" type="password" maxlength="45" value=""/>
                
                <input type="submit" value="Entrar" data-theme="e" data-inline="true" />
           
        </form>
    <?php else: ?>
    <p> Bienvenido <?php echo $data['user']['nombres']." ".$data['user']['apellidos']; ?> </p>
    
         <a href="#nav-panel" data-icon="bars" data-role="button" data-theme="b" data-mini="true" data-inline="true">MENU / <?php echo $data['title']; ?></a>
        
    <?php endif; ?>
        </ul>
        </p>
      
       
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
