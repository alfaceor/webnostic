<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "header.php"; ?>

<script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'Imprimir', 'height=400,width=800');
        mywindow.document.write('<html><head><title>Imprimir</title>');
        mywindow.document.write('<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />');
		mywindow.document.write('<style> .noPrint { display: none !important; } </style>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        //mywindow.close();

        return true;
    }

</script>
<style>
#avpw_save_button, #avpw_close_save, .avpw_info, #avpw_rghtArrow, #avpw_lftArrow, #avpw_tools_pager, .avpw_message_text, .avpw_footer_text { display:none !important;}
</style>
</head>
<body>
<script type="text/javascript" src="http://feather.aviary.com/js/feather.js"></script>

<!-- Instantiate Feather -->
<script type='text/javascript'>
   var featherEditor = new Aviary.Feather({
       apiKey: 'J6haGYUYXkaeL5k8LP7ZAA',
       apiVersion: 2, language: 'es',
       tools: 'brightness,saturation,contrast,orientation,warmth',
	   minimumStyling: 'true',
       appendTo: '',
       onSave: function(imageID, newURL) {
           var img = document.getElementById(imageID);
           img.src = newURL;
       },
       onError: function(errorObj) {
           alert(errorObj.message);
       }
   });
   function launchEditor(id, src) {
       featherEditor.launch({
           image: id,
           url: src
       });
      return false;
   }
</script>

<div data-role="page" class="ui-responsive-panel">
    <div data-role="header" data-theme="b" data-position="fixed">
       
        <a href="#nav-panel" data-icon="bars">MENU / <?php echo $data['title']; ?></a>
        
       <h1><?php echo $data['disease']." (<i>".$data['user']['nombres']." ".$data['user']['apellidos']."</i>)"; ?></h1>
        
        <a href="#" data-rel="back" data-icon="back" data-iconpos="notext">Regresar</a>   
        
     </div><!-- /header -->
    
    <div data-role="content" class="jqm-content">
    
<div id='injection_site'></div>

 <form id="jobresult" action="<?php echo $data['action']; ?>" method="post" data-ajax="false">   
 
 	<div id="printArea"> <!-- Print area -------------------------------------------->
    <style> li h6 {overflow: visible !important; white-space: normal !important;} </style>
    <div class="ui-grid-a">
    
    <div class="ui-block-a">
    
    <ul data-role="listview" data-inset="true" style="margin-top:0;">
    <li data-role="list-divider"><?php echo $data['originame']; ?> <span class="ui-li-count"><?php echo $data['id']; ?></span></li>
    <li>
    	<h2><!-- Espacio vacio para mantener el formato--></h2>
        <p><strong>Resultado del software: <?php if ($data['result']==0) echo "Negativo"; if ($data['result']==1) echo "Positivo"; ?></strong>
        (<?php if($data['status_id']==1) echo "En cola";if($data['status_id']==2) echo "Procesando";if($data['status_id']==3) echo "Listo";if($data['status_id']==4) echo "Error"; ?>)
        </p>
        <p><strong>Puntaje: </strong><?php echo $data['score']; ?> </p>
        <p><strong>Microscopio: </strong><?php echo $data['calibration_descr']; ?> </p>
        <?php if ($data['disease']=="TUBERCULOSIS" ) { 
				 if ($_SESSION['user']['type']==1) { ?>
            		<p><strong>Cód. Muestra: </strong><?php echo $data['tb_muestra']; ?> </p>
            		<p><strong>Tipo de pozo: </strong><?php echo $data['tb_pozo']; ?> </p>
            		<?php 	} ?>
            <p><strong>Días de cultivo: </strong><?php echo $data['tb_cultivo']; ?> </p>
             <br>
           <!-- <p><strong>Diagnóstico de la imagen: </strong><?php // echo $data['tb_diagnos']; ?> </p> solo para administardor ------------------------------------------------>
           
        <?php 	} ?> 
        
         <?php if ($data['disease']=="MELANOMA" ) { ?>
            <p><strong>Edad: </strong><?php echo $data['mela_edad']; ?> </p>
            <p><strong>Antiguedad: </strong><?php echo $data['mela_tiem']; ?> </p>
            <p><strong>Molestias: </strong><?php echo $data['mela_mole']; ?> </p>
            <p><strong>Ubicación: </strong><?php echo $data['mela_ubic']; ?> </p>
        <?php 	} ?> 
        
         <?php if ($data['disease']=="CANCER DE CUELLO UTERINO" ) { 
				 if ($_SESSION['user']['type']==1) { ?>
            		<p><strong>Cód. Lámina: </strong><?php echo $data['ccu_lamina']; ?> </p>
            		<?php 	} ?>
            <p><strong>Edad: </strong><?php echo $data['ccu_edad']; ?> </p>
            <p><strong>FUR: </strong><?php echo $data['ccu_fur']; ?> </p>
            <p><strong>Último PAP: </strong><?php echo $data['ccu_pap']; ?> </p>
            <p><strong>DX PAP: </strong><?php echo $data['ccu_dxpap']; ?> </p>
            <p><strong>Lactancia: </strong><?php echo $data['ccu_lacta']; ?> </p>
            <p><strong>Gestación(#semanas): </strong><?php echo $data['ccu_gesta']; ?> </p>
            <p><strong>G - P: </strong><?php echo $data['ccu_gp']; ?> </p>
            <p><strong>MAC: </strong><?php echo $data['ccu_mac']; ?> </p>
            <p><strong>Antecedente de importancia: </strong><?php echo $data['ccu_antece']; ?> </p>
             <br>
           <!-- <p><strong>Diagnóstico de la imagen: </strong><?php // echo $data['tb_diagnos']; ?> </p> solo para administardor ------------------------------------------------>
           
        <?php 	} ?>
         <?php if ($data['disease']=="VAGINOSIS" ) { ?>
            <p><strong>Flujo Vaginal: </strong><?php echo $data['vag_flu']; ?> </p>
            <p><strong>Cantidad de Flujo vaginal: </strong><?php echo $data['vag_can']; ?> </p>
            <p><strong>Fetidez de flujo vaginal: </strong><?php echo $data['vag_fet']; ?> </p>
            <p><strong>Prueba de aminas: </strong><?php echo $data['vag_ami']; ?> </p>
            <p><strong>PH de secreción vaginal: </strong><?php echo $data['vag_sec']; ?> </p>
            <p><strong>Células guia en solución salina: </strong><?php echo $data['vag_cel']; ?> </p>
            <p><strong>Prurito vaginal: </strong><?php echo $data['vag_pru']; ?> </p>
            <p><strong>Inflamación vaginal: </strong><?php echo $data['vag_irr']; ?> </p>
        <?php 	} ?>
        <p><strong>Expertos: </strong><?php echo $data['expos2']." - ".$data['expos3']." - ".$data['expos4']; ?> </p>
        
        <p class="ui-li-aside"><?php echo $data['ts']; ?> <br>¿Activar esta muestra para TODOS los expertos?
        
         <?php 	if (strpos($data['sample_result']->status,$_SESSION['user']['username']) !== false or $_SESSION['user']['type']<>0 or $data['sample_result']->allexperts=="Si") {
    			echo '<b>'. $data['sample_result']->allexperts.'</b>';
				} else { ?>
        <br>
        <select name="allexperts" id="allexperts" data-role="slider" data-mini="true">
            <option value="No">No</option>
            <option value="Si" <?php if ($data['sample_result']->allexperts=="Si") echo "selected"; ?> >Si</option>
        </select>
        <?php 	} 
		
		echo '<br><a href="javascript:PrintElem(\'#printArea\')" data-role="button" data-mini="true" data-inline="true" class="noPrint" rel="external">Imprimir</a>';
				
		?>  
        
        
        </p>
    </li>
    <li data-role="list-divider" data-theme="c">
       
    	 <?php if (strpos($data['sample_result']->status,$_SESSION['user']['username']) !== false or $_SESSION['user']['type']<>0) {
    			echo '<p><h2>Resultado de expertos:</h2></p>';
				
				echo $data['lista_expertos'];
				
				} else { ?>
                
                <fieldset class="<?php if ($data['disease']=="CANCER DE CUELLO UTERINO" ) echo "ui-grid-d"; else echo "ui-grid-a";?>">
                <div class="ui-block-a">
                Seleccione su Resultado:
                 	<fieldset data-role="controlgroup" data-mini="true">
        			<?php if ($data['disease']=="MELANOMA" ) { ?>
                    
            		<input type="radio" name="ex_result" value="Sospechoso" id="Sospechoso"> <label for="Sospechoso">Sospechoso</label>
                    <input type="radio" name="ex_result" value="No Sospechoso" id="NoSospechoso"> <label for="NoSospechoso">No Sospechoso</label>
                    <input type="radio" name="ex_result" value="No aplica - No lunar" id="Noaplica"> <label for="Noaplica">No aplica - No lunar</label>
                    
       				<?php 	} if ($data['disease']=="TUBERCULOSIS" ) {?> 
        			<input type="radio" name="ex_result" value="Positivo" id="Positivo"> <label for="Positivo">Positivo</label>
                    <input type="radio" name="ex_result" value="Negativo" id="Negativo"> <label for="Negativo">Negativo</label>
                    <input type="radio" name="ex_result" value="Contaminada" id="Contaminada"> <label for="Contaminada">Contaminada</label>
                    
                    <?php 	} if ($data['disease']=="CANCER DE CUELLO UTERINO" ) {?> 
        			
                    
       			 	<input type="radio" name="ex_result" value="No Sospechoso" id="NoSospechoso">
        			<label for="NoSospechoso">No Sospechoso</label>
                    <div data-role="collapsible" data-mini="true">
                        <h4>Sospechoso</h4>
                        <input type="radio" name="ex_result" value="ASC-US" id="ASC-US"> <label for="ASC-US">ASC-US</label>
                        <input type="radio" name="ex_result" value="ASC-HG" id="ASC-HG"> <label for="ASC-HG">ASC-HG</label>
                        <input type="radio" name="ex_result" value="AGC" id="AGC"> <label for="AGC">AGC</label>
                        <input type="radio" name="ex_result" value="LIE-LG" id="LIE-LG"> <label for="LIE-LG">LIE-LG</label>
                        <input type="radio" name="ex_result" value="LIE-HG" id="LIE-HG"> <label for="LIE-HG">LIE-HG</label>
                        <input type="radio" name="ex_result" value="Carcinoma" id="Carcinoma"> <label for="Carcinoma">Carcinoma</label>
                        <input type="radio" name="ex_result" value="Adenocarcinoma" id="Adenocarcinoma"> <label for="Adenocarcinoma">Adenocarcinoma</label>
                        <input type="radio" name="ex_result" value="Otro" id="Otro"> <label for="Otro">Otro</label>
                    </div>
                    <?php 	} if ($data['disease']=="VAGINOSIS" ) {?> 
        			<input type="radio" name="ex_result" value="Positivo" id="Positivo"> <label for="Positivo">Positivo</label>
                    <input type="radio" name="ex_result" value="Negativo" id="Negativo"> <label for="Negativo">Negativo</label>
                    <?php 	}  ?>                     
                    <input type="radio" name="ex_result" value="Imagen Ilegible" id="Nointer">
        			<label for="Nointer">Imagen Ilegible <b>(*)</b></label>
                    </fieldset>
                    <small>(*) Imagen no puede ser diagnosticada</small>
                </div>
                <div class="ui-block-b">
                Calidad de la imágen:
                	<fieldset data-role="controlgroup" data-mini="true">
        			<input type="radio" name="ex_calid" value="muybuena" id="ex_calid1"> <label for="ex_calid1">Muy buena</label>
                    <input type="radio" name="ex_calid" value="buena" id="ex_calid2"> <label for="ex_calid2">Buena</label>
                    <input type="radio" name="ex_calid" value="baja" id="ex_calid3"> <label for="ex_calid3">Baja</label>
                    <input type="radio" name="ex_calid" value="muyBaja" id="ex_calid4"> <label for="ex_calid4">Muy Baja</label>
    				</fieldset>
                </div>
                <?php if ($data['disease']=="CANCER DE CUELLO UTERINO" ) {?> 
                 <div class="ui-block-c">
                Fijación:
                	<fieldset data-role="controlgroup" data-mini="true">
        			<input type="radio" name="ex_fija" value="Adecuada" id="ex_fija1"> <label for="ex_fija1">Adecuada</label>
                    <input type="radio" name="ex_fija" value="Inadecuada" id="ex_fija2"> <label for="ex_fija2">Inadecuada</label>
                    <input type="radio" name="ex_fija" value="No determinada" id="ex_fija3"> <label for="ex_fija3">No determinada</label>
    				</fieldset>
                </div>
                <div class="ui-block-d">
                Tinción:
                	<fieldset data-role="controlgroup" data-mini="true">
        			<input type="radio" name="ex_tinta" value="Adecuada" id="ex_tinta1"> <label for="ex_tinta1">Adecuada</label>
                    <input type="radio" name="ex_tinta" value="Inadecuada" id="ex_tinta2"> <label for="ex_tinta2">Inadecuada</label>
                    <input type="radio" name="ex_tinta" value="No determinada" id="ex_tinta3"> <label for="ex_tinta3">No determinada</label>
    				</fieldset>
                </div>
                <div class="ui-block-e">
                Montaje:
                	<fieldset data-role="controlgroup" data-mini="true">
        			<input type="radio" name="ex_monta" value="Adecuada" id="ex_monta1"> <label for="ex_monta1">Adecuada</label>
                    <input type="radio" name="ex_monta" value="Inadecuada" id="ex_monta2"> <label for="ex_monta2">Inadecuada</label>
                    <input type="radio" name="ex_monta" value="No determinada" id="ex_monta3"> <label for="ex_monta3">No determinada</label>
    				</fieldset>
                </div>
                 <?php 	} ?> 
                </fieldset>
                <input value="Enviar resultado" name="envioresultado" type="submit" data-icon="check" data-iconpos="left" data-mini="true" data-theme="e" data-inline="true" />
             <?php 	} ?>       
        
        </li>
	</ul>
	<?php if ($data['next_muestra']<>0) {  ?>
    <a href="<?php echo $data['baseurl']; ?>index.php/jobs/sample/<?php echo $data['next_muestra']."/".$data['ver']; ?>" rel="external" data-role="button" data-inline="true" data-theme="b">Siguiente <?php if ($data['ver']==0) echo "<small>(Faltan ".$data['totalpages']." muestras)</small>"; ?></a>
   <?php } ?>
    </div>
    <div class="ui-block-b" style="padding-left:10px;">
    <div id="image_portrait">
		<img id='image1' src='<?php echo $data['image_url']; ?>'  width="300px" height="300px"/>
    </div>	
    <input type='button' value='VER MUESTRA' onclick="return launchEditor('image1', '<?php echo $data['image_url']; ?>');" data-inline="true" data-theme="e" class="noPrint" rel="external"/>	
    </div>
    
	</div><!-- /grid-a -->
    
    
    <?php if ($_SESSION['user']['type']<>3) { ?>
    <label for="comentarios">Comentarios: (opcional)</label>
    
    	<ul data-role="listview" data-inset="true">
		<?php foreach($data['commentsample'] as $k1=>$v1): ?>
        <li> <?php echo '<h6>'.$v1->comentario.'</h6><p>'.$v1->nombres.' '.$v1->apellidos.' - '.$v1->ts.'</p>'; ?></li>
        <?php endforeach; ?>
        </ul>
        
   </div> <!-- end print area -----------------> 
    <textarea cols="40" rows="8" name="comentario" id="comentario" placeholder="Deje su comentario aquí..."></textarea>
    <input value="Agregar Comentario" type="submit" data-icon="check" data-iconpos="left" data-mini="true" data-theme="e" data-inline="true" class="no-print" />
    <?php } ?>
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
