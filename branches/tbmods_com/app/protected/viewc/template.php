<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "header.php"; ?>

</head>
<body>

<div data-role="page" class="ui-responsive-panel">
    <div data-role="header" data-theme="b" data-position="fixed">
       
        
        
       <h1><?php echo $data['disease']; ?></h1>
        
        <a href="#" data-rel="back" data-icon="back" data-iconpos="notext">Regresar</a>  
        
    </div><!-- /header -->
    
    <div data-role="content" class="jqm-content">
    	<ul data-role="listview" data-inset="true" data-theme="d" data-divider-theme="e" data-count-theme="b">
   		<li data-role="list-divider">ADVERTENCIA</li>
        <li><?php echo $data['content']; ?></li>
        </ul>
     	<a href="javascript:history.back()" data-role="button" data-inline="true" data-theme="b" rel="external">REGRESAR</a> 
	</div><!-- /content -->
    <div data-role="footer" data-position="fixed" data-theme="b">
        <div><?php echo $data['pager']; ?></div>
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
