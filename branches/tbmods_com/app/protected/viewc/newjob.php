<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "header.php"; ?>
<style>
/*.ui-panel-animate.ui-panel-content-wrap{-webkit-backface-visibility:visible;-webkit-transform:none} */
</style>

<script>
$(document).ready(function () {
//$( ".ui-input-search input" ).attr( "id", "paciente" );
//$( ".ui-input-search input" ).attr( "name", "paciente" );
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
    
    <div data-role="content" class="jqm-contentx">
        
        <form id="jobform" method="post" action="<?php echo $data['action']; ?>" enctype="multipart/form-data" data-ajax="false">

        <?php if( $data['jobtype'] == "muestra" ) { ?>
            
            <?php if( $data['calibrations'] == NULL and $data['disease']<>"MELANOMA" ) { ?>
            Antes de subir una muestra, primero debe <a href="<?php echo $data['baseurl']; ?>index.php/jobs/calibration/submit">Agregar una calibración</a>
            <?php } else { ?>
            
            <fieldset class="ui-grid-a">
            <div class="ui-block-a">
            Seleccione el Paciente o <a href="<?php echo $data['baseurl']; ?>index.php/admin/adduser" rel="external">Agrege un Nuevo Paciente</a>:
                    <select name="paciente" id="paciente" data-mini="true" data-inline="true">
                    	<option value="" selected />Seleccionar Paciente..
                        <?php foreach($data['pacientes'] as $k1=>$v1): ?>
                        <option value="<?php echo $v1->username; ?>" /><?php echo "(".$v1->username.") ".$v1->apellidos." ".$v1->nombres; ?>
                        <?php endforeach; ?>
                    </select>       
            </div>  <div class="ui-block-c">
    <?php if ($data['disease']<>"MELANOMA") { ?>
                    Seleccione el Microscopio o <a href="<?php echo $data['baseurl']; ?>index.php/jobs/calibration/submit" rel="external">Agrege una nueva Calibración</a>:
                    <select name="calibration_value" id="calibration_value" data-mini="true" data-inline="true">
                        <?php foreach($data['calibrations'] as $k1=>$v1): ?>
                        <option value="<?php echo $v1->value."|".$v1->description; ?>" /><?php echo $v1->description; ?> - Valor: <?php echo $v1->value; ?>
                        <?php endforeach; ?>
                    </select>
                <?php } else { ?>
                        <input name="calibration_value" id="calibration_value" type="hidden" value="0|-">
                <?php } ?>
            </div> 
            </fieldset>
                 
            <?php if ($data['disease']=="MELANOMA") { ?>  
               	  <table data-role="table" id="movie-table" data-mode="reflow" class="ui-responsive table-stroke">
                  <thead>
                    <tr>
                      <th data-priority="1">Subir una <?php echo $data['jobtype']; ?> (Imagen)</th>
                      <th data-priority="2" style="width:100px;">
                      <?php if ($data['disease']=="TUBERCULOSIS") { ?>
                      Código de muestra
                      <?php } ?>
                      <?php if ($data['disease']=="MELANOMA") { ?>
                      Edad
                      <?php } ?>
                      <?php if ($data['disease']=="VAGINOSIS") { ?>
                      Flujo Vaginal
                      <?php } ?>
                      </th>
                      <th data-priority="3">
                      <?php if ($data['disease']=="TUBERCULOSIS") { ?>
                      Diagnóstico de la imagen
                      <?php } ?>
                      <?php if ($data['disease']=="MELANOMA") { ?>
                      Antiguedad de la lesión
                      <?php } ?>
                      <?php if ($data['disease']=="VAGINOSIS") { ?>
                      Cantidad de Flujo vaginal
                      <?php } ?>
                      </th>
                      <th data-priority="4">
                      <?php if ($data['disease']=="TUBERCULOSIS") { ?>
                      Tipo de pozo
                      <?php } ?>
                      <?php if ($data['disease']=="MELANOMA") { ?>
                      Molestias (pica, duele, arde)
                      <?php } ?>
                      <?php if ($data['disease']=="VAGINOSIS") { ?>
                      Fetidez de flujo vaginal
                      <?php } ?>
                      </th>
                      <th data-priority="5">
                      <?php if ($data['disease']=="TUBERCULOSIS") { ?>
                      Días de cultivo
                      <?php } ?>
                      <?php if ($data['disease']=="MELANOMA") { ?>
                      Ubicación
                      <?php } ?>
                      <?php if ($data['disease']=="VAGINOSIS") { ?>
                      Prueba de aminas
                      <?php } ?>
                      </th>
                       <th data-priority="6">
                      <?php if ($data['disease']=="TUBERCULOSIS") { ?>
                      Fecha de proceso muestra
                      <?php } ?>
                      <?php if ($data['disease']=="VAGINOSIS") { ?>
                      PH de secreción vaginal
                      <?php } ?>
                      </th>
                      <th data-priority="7" style="min-width:300px;">
                      <?php if ($data['disease']=="TUBERCULOSIS") { ?>
                      Fecha toma foto
                      <?php } ?>
                      <?php if ($data['disease']=="VAGINOSIS") { ?>
                      Células guia en solución salina
                      <?php } ?>
                      </th>
                      <th data-priority="8">
                      <?php if ($data['disease']=="VAGINOSIS") { ?>
                      Prurito vaginal
                      <?php } ?>
                      </th>
                      <th data-priority="9">
                      <?php if ($data['disease']=="VAGINOSIS") { ?>
                      Inflamación vaginal
                      <?php } ?>
                      </th>
                      

                    </tr>
                  </thead>
                  <tbody>
                  	<?php for ($i = 0; $i < 10; $i++) { // buccle hasta 10 fotos --- ?>
                    <tr>
                    <th><input id="uploadedfile<?php echo $i; ?>" name="uploadedfile<?php echo $i; ?>" type="file" accept="image/jpeg" data-mini="true"/></th>
                    <td>
                    <?php if ($data['disease']=="TUBERCULOSIS") { ?>
                    <input name="tb_muestra<?php echo $i; ?>" id="tb_muestra<?php echo $i; ?>" type="text" data-mini="true" >
                    <?php } ?>
                    <?php if ($data['disease']=="MELANOMA") { ?>
                    <select name="mela_edad<?php echo $i; ?>" id="mela_edad<?php echo $i; ?>" data-mini="true">
                      <option value="" />...
                      <option value="1 a 9" />1 a 9
                      <option value="10 a 19" />10 a 19
                      <option value="20 a 29" />20 a 29
                      <option value="30 a 39" />30 a 39
                      <option value="40 a 49" />40 a 49
                      <option value="50 a 59" />50 a 59
                      <option value="Más de 60" />Más de 60
                      <option value="No determinado" />No determinado
                   	</select>
                    <?php } ?>
                    <?php if ($data['disease']=="VAGINOSIS") { ?>
                    <select name="vag_flu<?php echo $i; ?>" id="vag_flu<?php echo $i; ?>" data-mini="true">
                      <option value="" />...
                      <option value="Leucorrea blanca o blanca-grisácea homogénea" />Leucorrea blanca o blanca-grisácea homogénea
                      <option value="Normal" />Normal
                      <option value="Otro" />Otro
                      <option value="No determinado" />No determinado
                   	</select>
                    <?php } ?>
                    </td>
                    <td>
                    <?php if ($data['disease']=="TUBERCULOSIS") { ?>
                    <select name="tb_diagnos<?php echo $i; ?>" id="tb_diagnos<?php echo $i; ?>" data-mini="true">
                      <option value="" />...
                      <option value="Positivo" />Positivo
                      <option value="Negativo" />Negativo
                      <option value="Contaminada" />Contaminada
                      <option value="Indeterminado" />Indeterminado
                   	</select>
                    <?php } ?>
                    <?php if ($data['disease']=="MELANOMA") { ?>
                    <select name="mela_tiem<?php echo $i; ?>" id="mela_tiem<?php echo $i; ?>" data-mini="true">
                      <option value="" />...
                      <option value="Hace 1 años" />Hace 1 año
                      <option value="Hace 2 años" />Hace 2 años
                      <option value="Hace 3 años" />Hace 3 años
                      <option value="Hace 4 años" />Hace 4 años
                      <option value="Hace 5 años" />Hace 5 años
                      <option value="Hace más de 6 años" />Hace más de 6 años
                      <option value="Nacimiento" />Nacimiento
                      <option value="No determinado" />No determinado
                   	</select>
                    <?php } ?>
                    <?php if ($data['disease']=="VAGINOSIS") { ?>
                    <select name="vag_can<?php echo $i; ?>" id="vag_can<?php echo $i; ?>" data-mini="true">
                      <option value="" />...
                      <option value="Escaza" />Escaza
                      <option value="Moderada" />Moderada
                      <option value="Abundante" />Abundante
                      <option value="No determinado" />No determinado
                    </select>
                    <?php } ?>
                    </td>
                    <td>
                    <?php if ($data['disease']=="TUBERCULOSIS") { ?>
                    <select name="tb_pozo<?php echo $i; ?>" id="tb_pozo<?php echo $i; ?>" data-mini="true">
                      <option value="" />...
                      <option value="control1" />Control 1
                      <option value="control2" />Control 2
                      <option value="isoniazida" />Isoniazida
                      <option value="rifampicina" />Rifampicina
                      <option value="No determinado" />No determinado
                   	</select>
                    <?php } ?>
                    <?php if ($data['disease']=="MELANOMA") { ?>
                    <select name="mela_mole<?php echo $i; ?>" id="mela_mole<?php echo $i; ?>" data-mini="true">
                      <option value="" />...
                      <option value="Si" />Si
                      <option value="No" />No
                      <option value="No determinado" />No determinado
                    </select>
                    <?php } ?>
                    <?php if ($data['disease']=="VAGINOSIS") { ?>
                    <select name="vag_fet<?php echo $i; ?>" id="vag_fet<?php echo $i; ?>" data-mini="true">
                      <option value="" />...
                      <option value="Presencia" />Presencia
                      <option value="Ausencia" />Ausencia
                      <option value="No determinado" />No determinado
                    </select>
                    <?php } ?>
                    </td>
                    <td>
                    <?php if ($data['disease']=="TUBERCULOSIS") { ?>
                    <select name="tb_cultivo<?php echo $i; ?>" id="tb_cultivo<?php echo $i; ?>" data-mini="true">
                      <option value="" />...
                      <option value="1 a 5" />1 a 5
                      <option value="6" />6
                      <option value="7" />7
                      <option value="8" />8
                      <option value="9" />9
                      <option value="10" />10
                      <option value="11" />11
                      <option value="12" />12
                      <option value="13" />13
                      <option value="14" />14
                      <option value="15 a más" />15 a más
                      <option value="No determinado" />No determinado
                   	</select>
                    <?php } ?>
                    <?php if ($data['disease']=="MELANOMA") { ?>
                    <select name="mela_ubic<?php echo $i; ?>" id="mela_ubic<?php echo $i; ?>" data-mini="true">
                      <option value="" />...
                      <option value="Palmas de Pies o Manos" />Palmas de Pies o Manos
                      <option value="Cabeza" />Cabeza
                      <option value="Tronco" />Tronco
                      <option value="Extremidades" />Extremidades
                      <option value="No determinado" />No determinado
                    </select>
                    <?php } ?>
                    <?php if ($data['disease']=="VAGINOSIS") { ?>
                    <select name="vag_ami<?php echo $i; ?>" id="vag_ami<?php echo $i; ?>" data-mini="true">
                      <option value="" />...
                      <option value="Positiva" />Positiva
                      <option value="Negativa" />Negativa
                      <option value="No determinado" />No determinado
                    </select>
                    <?php } ?>
            		</td>
                    <td>
                    <?php if ($data['disease']=="TUBERCULOSIS") { ?>
                    <input name="tb_procesa<?php echo $i; ?>" id="tb_procesa<?php echo $i; ?>" type="date" data-mini="true" >
                    <?php } ?>
                    <?php if ($data['disease']=="VAGINOSIS") { ?>
                    <select name="vag_sec<?php echo $i; ?>" id="vag_sec<?php echo $i; ?>" data-mini="true">
                      <option value="" />...
                      <option value="Mayor 4.5" />Mayor 4.5
                      <option value="Menor o igual a 4.5" />Menor o igual a 4.5
                      <option value="No determinado" />No determinado
                    </select>
                    <?php } ?>
            		</td>
                    <td>
                    <?php if ($data['disease']=="TUBERCULOSIS") { ?>
                    <input name="tb_foto<?php echo $i; ?>" id="tb_foto<?php echo $i; ?>" type="date" data-mini="true" >
                    <?php } ?>
                    <?php if ($data['disease']=="VAGINOSIS") { ?>
                    <select name="vag_cel<?php echo $i; ?>" id="vag_cel<?php echo $i; ?>" data-mini="true">
                      <option value="" />...
                      <option value="Presencia" />Presencia
                      <option value="Ausencia" />Ausencia
                      <option value="No determinado" />No determinado
                    </select>
                    <?php } ?>
            		</td>
                    <td>
                    <?php if ($data['disease']=="VAGINOSIS") { ?>
                    <select name="vag_pru<?php echo $i; ?>" id="vag_pru<?php echo $i; ?>" data-mini="true">
                      <option value="" />...
                      <option value="Presencia" />Presencia
                      <option value="Ausencia" />Ausencia
                      <option value="No determinado" />No determinado
                    </select>
                    <?php } ?>
            		</td>
                    <td>
                    <?php if ($data['disease']=="VAGINOSIS") { ?>
                    <select name="vag_irr<?php echo $i; ?>" id="vag_irr<?php echo $i; ?>" data-mini="true">
                      <option value="" />...
                      <option value="Presencia" />Presencia
                      <option value="Ausencia" />Ausencia
                      <option value="No determinado" />No determinado
                    </select>
                    <?php } ?>
            		</td>
                    </tr>
                   	<?php } // --- fin bucle for : 10 fotos --- ?>
                  </tbody>
                </table>
		 <?php } else { // Para todas las demas enfermedades menos Melanoma ?>  
         
               	  <table data-role="table" id="movie-table" data-mode="reflow" class="ui-responsive table-stroke">
                  <thead>
                    <tr>
                      <th data-priority="1" style="width:300px;">Subir una <?php echo $data['jobtype']; ?> (Imagen)</th>
                      <th data-priority="2" style="width:300px;"> </th>
                      <th data-priority="3"> </th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php for ($i = 0; $i < 10; $i++) { // buccle hasta 10 fotos --- ?>
                    <tr>
                    <td><input id="uploadedfile<?php echo $i; ?>" name="uploadedfile<?php echo $i; ?>" type="file" accept="image/jpeg" data-mini="true"/></td>
                    <td>
                      <?php 
					  if ($i==0) {
					  if ($data['disease']=="TUBERCULOSIS") echo "Código de muestra";
                      if ($data['disease']=="CANCER DE CUELLO UTERINO") echo "Código de Lámina PAP";
                      if ($data['disease']=="VAGINOSIS") echo "Flujo Vaginal";
                      }
					  
					  if ($i==1) {
					  if ($data['disease']=="TUBERCULOSIS") echo "Diagnóstico de la imagen";
                      if ($data['disease']=="CANCER DE CUELLO UTERINO") echo "Edad";
                      if ($data['disease']=="VAGINOSIS") echo "Cantidad de Flujo vaginal";
                      } 
					  
					  if ($i==2) {
					  if ($data['disease']=="TUBERCULOSIS") echo "Tipo de pozo";
                      if ($data['disease']=="CANCER DE CUELLO UTERINO") echo "FUR";
                      if ($data['disease']=="VAGINOSIS") echo "Fetidez de flujo vaginal";
                      } 
					  
					  if ($i==3) {
					  if ($data['disease']=="TUBERCULOSIS") echo "Días de cultivo";
                      if ($data['disease']=="CANCER DE CUELLO UTERINO") echo "Último PAP";
                      if ($data['disease']=="VAGINOSIS") echo "Prueba de aminas";
                      } 
					  
					  if ($i==4) {
					  if ($data['disease']=="TUBERCULOSIS") echo "Fecha de proceso muestra";
                      if ($data['disease']=="CANCER DE CUELLO UTERINO") echo "DX PAP";
                      if ($data['disease']=="VAGINOSIS") echo "PH de secreción vaginal";
                      } 
					  
					  if ($i==5) {
					  if ($data['disease']=="TUBERCULOSIS") echo "Fecha toma foto";
                      if ($data['disease']=="CANCER DE CUELLO UTERINO") echo "G - P";
                      if ($data['disease']=="VAGINOSIS") echo "Células guia en solución salina";
                      } 
					  
					  if ($i==6) {
                      if ($data['disease']=="CANCER DE CUELLO UTERINO") echo "Lactancia - Gestante - MAC";
                      if ($data['disease']=="VAGINOSIS") echo "Prurito vaginal";
                      } 
					  
					  if ($i==7) {
					  if ($data['disease']=="CANCER DE CUELLO UTERINO") echo "Antecedente de importancia <small>(cáncer previo, VPH, TS, otro)</small>";  
                      if ($data['disease']=="VAGINOSIS") echo "Inflamación vaginal";
                      } 
					  
					  if ($i==8) {
					  if ($data['disease']=="CANCER DE CUELLO UTERINO") echo "Nombre del Laboratorista";
                      } 
					   ?>
                     
                    </td>
                    <td>
                    <?php 
					if ($i==0) {
					if ($data['disease']=="TUBERCULOSIS") { ?>
                    <input name="tb_muestra" id="tb_muestra" type="text" data-inline="true" data-mini="true" >
                    <?php } ?>
                    <?php if ($data['disease']=="CANCER DE CUELLO UTERINO") { ?>
                    <input name="ccu_lamina" id="ccu_lamina" type="text" data-inline="true" data-mini="true" >
                    <?php } ?>
                    <?php if ($data['disease']=="VAGINOSIS") { ?>
                    <select name="vag_flu" id="vag_flu" data-inline="true" data-mini="true" >
                      <option value="" />...
                      <option value="Leucorrea blanca o blanca-grisácea homogénea" />Leucorrea blanca o blanca-grisácea homogénea
                      <option value="Normal" />Normal
                      <option value="Otro" />Otro
                      <option value="No determinado" />No determinado
                   	</select>
                    <?php } 
					} if ($i==1) {
					if ($data['disease']=="TUBERCULOSIS") { ?>
                    <select name="tb_diagnos" id="tb_diagnos" data-inline="true" data-mini="true" >
                      <option value="" />...
                      <option value="Positivo" />Positivo
                      <option value="Negativo" />Negativo
                      <option value="Contaminada" />Contaminada
                      <option value="Indeterminado" />Indeterminado
                   	</select>
                    <?php } ?>
                    <?php if ($data['disease']=="CANCER DE CUELLO UTERINO") { ?>
                    <select name="ccu_edad" id="ccu_edad" data-inline="true" data-mini="true" >
                      <option value="" />...
                      <option value="0 a 9" />0 a 9
                      <option value="10 a 15" />10 a 15
                      <option value="16 a 20" />16 a 20
                      <option value="21 a 30" />21 a 30
                      <option value="31 a 40" />31 a 40
                      <option value="41 a 50" />41 a 50
                      <option value="51 a 60" />51 a 60
                      <option value="61 a más" />61 a más
                   	</select>
                    <?php } ?>
                    <?php if ($data['disease']=="VAGINOSIS") { ?>
                    <select name="vag_can" id="vag_can" data-inline="true" data-mini="true" >
                      <option value="" />...
                      <option value="Escaza" />Escaza
                      <option value="Moderada" />Moderada
                      <option value="Abundante" />Abundante
                      <option value="No determinado" />No determinado
                    </select>
                    <?php } 
					} if ($i==2) {
					if ($data['disease']=="TUBERCULOSIS") { ?>
                    <select name="tb_pozo" id="tb_pozo" data-inline="true" data-mini="true" >
                      <option value="" />...
                      <option value="control1" />Control 1
                      <option value="control2" />Control 2
                      <option value="isoniazida" />Isoniazida
                      <option value="rifampicina" />Rifampicina
                      <option value="No determinado" />No determinado
                   	</select>
                    <?php } ?>
                    <?php if ($data['disease']=="CANCER DE CUELLO UTERINO") { ?>
                    <input name="ccu_fur" id="ccu_fur" type="date" data-inline="true" data-mini="true" >
                    <?php } ?>
                    <?php if ($data['disease']=="VAGINOSIS") { ?>
                    <select name="vag_fet" id="vag_fet" data-inline="true" data-mini="true" >
                      <option value="" />...
                      <option value="Presencia" />Presencia
                      <option value="Ausencia" />Ausencia
                      <option value="No determinado" />No determinado
                    </select>
                    <?php } 
					} if ($i==3) {
					if ($data['disease']=="TUBERCULOSIS") { ?>
                    <select name="tb_cultivo" id="tb_cultivo" data-inline="true" data-mini="true" >
                      <option value="" />...
                      <option value="1 a 5" />1 a 5
                      <option value="6" />6
                      <option value="7" />7
                      <option value="8" />8
                      <option value="9" />9
                      <option value="10" />10
                      <option value="11" />11
                      <option value="12" />12
                      <option value="13" />13
                      <option value="14" />14
                      <option value="15 a más" />15 a más
                      <option value="No determinado" />No determinado
                   	</select>
                    <?php } ?>
                    <?php if ($data['disease']=="CANCER DE CUELLO UTERINO") { ?>
                    <input name="ccu_pap" id="ccu_pap" type="date" data-inline="true" data-mini="true" >
                    <?php } ?>
                    <?php if ($data['disease']=="VAGINOSIS") { ?>
                    <select name="vag_ami" id="vag_ami" data-inline="true" data-mini="true" >
                      <option value="" />...
                      <option value="Positiva" />Positiva
                      <option value="Negativa" />Negativa
                      <option value="No determinado" />No determinado
                    </select>
                    <?php } 
					} if ($i==4) {
					if ($data['disease']=="TUBERCULOSIS") { ?>
                    <input name="tb_procesa" id="tb_procesa" type="date" data-inline="true" data-mini="true" >
                    <?php } ?>
                    <?php if ($data['disease']=="CANCER DE CUELLO UTERINO") { ?>
                    <select name="ccu_dxpap" id="ccu_dxpap" data-inline="true" data-mini="true" >
                      <option value="" />...
                      <option value="No Sospechoso" />No Sospechoso
                      <optgroup label="Sospechoso">
                      	<option value="ASC-US">ASC-US</option>
                        <option value="ASC-HG">ASC-HG</option>
                        <option value="AGC">AGC</option>
                        <option value="LIE-LG">LIE-LG</option>
                        <option value="LIE-HG">LIE-HG</option>
                        <option value="Carcinoma">Carcinoma</option>
                        <option value="Adenocarcinoma">Adenocarcinoma</option>
                        <option value="Otro">Otro</option>
                    </optgroup>
                    </select>
                    <?php } ?>
                    <?php if ($data['disease']=="VAGINOSIS") { ?>
                    <select name="vag_sec" id="vag_sec" data-inline="true" data-mini="true" >
                      <option value="" />...
                      <option value="Mayor 4.5" />Mayor 4.5
                      <option value="Menor o igual a 4.5" />Menor o igual a 4.5
                      <option value="No determinado" />No determinado
                    </select>
                    <?php } 
					} if ($i==5) {
					if ($data['disease']=="TUBERCULOSIS") { ?>
                    <input name="tb_foto" id="tb_foto" type="date" data-inline="true" data-mini="true" >
                    <?php } ?>
                    <?php if ($data['disease']=="CANCER DE CUELLO UTERINO") { ?>
                    <input name="ccu_gp" id="ccu_gp" type="text" data-inline="true" data-mini="true" >
                    <?php } ?>
                    <?php if ($data['disease']=="VAGINOSIS") { ?>
                    <select name="vag_cel" id="vag_cel" data-inline="true" data-mini="true" >
                      <option value="" />...
                      <option value="Presencia" />Presencia
                      <option value="Ausencia" />Ausencia
                      <option value="No determinado" />No determinado
                    </select>
                    <?php } 
					} if ($i==6) {
					if ($data['disease']=="CANCER DE CUELLO UTERINO") { ?>
                     <fieldset data-role="controlgroup" data-type="horizontal" data-inline="true" data-mini="true" >
                    <select name="ccu_lacta" id="ccu_lacta" data-inline="true" data-mini="true" >
                      <option value="" />...
                      <option value="Si" />Si
                      <option value="No" />No
                      <option value="No determinado" />No determinado
                    </select>
                    
                    <select name="ccu_gesta" id="ccu_gesta" data-inline="true" data-mini="true" >
                      <option value="" />...
                      <option value="No" />No
                      <optgroup label="Si (# semanas)">
                      	  <option value="1 a 14" />1 a 14
                          <option value="15 a 28" />15 a 28
                          <option value="29 a 42" />29 a 42
                      </optgroup>
                      <option value="No determinado" />No determinado
                    </select>
                    
                    <select name="ccu_mac" id="ccu_mac" data-inline="true" data-mini="true" >
                      <option value="" />...
                      <option value="No" />No
                      <optgroup label="Si (Especifique)">
                      	<option value="Parentereal">Parentereal</option>
                        <option value="AOC">AOC</option>
                        <option value="DIU">DIU</option>
                        <option value="AOE">AOE</option>
                        <option value="Barra Natural">Barra Natural</option>
                    </optgroup>
                    </select>
                    </fieldset>
                    <?php } ?>
                    <?php if ($data['disease']=="VAGINOSIS") { ?>
                    <select name="vag_cel" id="vag_cel" data-inline="true" data-mini="true" >
                      <option value="" />...
                      <option value="Presencia" />Presencia
                      <option value="Ausencia" />Ausencia
                      <option value="No determinado" />No determinado
                    </select>
                    <?php }  ?>
                    <?php if ($data['disease']=="VAGINOSIS") { ?>
                    <select name="vag_pru" id="vag_pru" data-inline="true" data-mini="true" >
                      <option value="" />...
                      <option value="Presencia" />Presencia
                      <option value="Ausencia" />Ausencia
                      <option value="No determinado" />No determinado
                    </select>
                    <?php } 
					} if ($i==7) {
					if ($data['disease']=="CANCER DE CUELLO UTERINO") { ?>
                    <textarea name="ccu_antece" id="ccu_antece" data-inline="true" data-mini="true" ></textarea>
                    <?php } ?>
					<?php if ($data['disease']=="VAGINOSIS") { ?>
                    <select name="vag_irr" id="vag_irr" data-inline="true" data-mini="true" >
                      <option value="" />...
                      <option value="Presencia" />Presencia
                      <option value="Ausencia" />Ausencia
                      <option value="No determinado" />No determinado
                    </select>
                     <?php } 
					} if ($i==8) {
					if ($data['disease']=="CANCER DE CUELLO UTERINO") { ?>
                    <input name="ccu_per" id="ccu_per" type="text" data-inline="true" data-mini="true" >
                    <?php }
					} ?>
            		</td>
                    </tr>
                   	<?php } // --- fin bucle for : 10 fotos --- ?>
                  </tbody>
                </table>
            <?php } ?>      
        <?php } 
		} else { ?>
            <label for="uploadedfile">Subir una <?php echo $data['jobtype']; ?> (Imágen)</label>
            <input id="uploadedfile" name="uploadedfile" type="file" accept="image/jpeg"/>
            <label for="description">Nombre del Microscopio</label>
            <input id="description" name="description" type="text" data-clear-btn="true" />
        <?php } ?>
       <button data-icon="check" data-iconpos="left" data-mini="true" data-theme="e" class="show-page-loading-msg" data-textonly="false" data-textvisible="true" data-msgtext="Subiendo muestras, Espere por favor.." data-inline="true">Enviar</button>
       
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
<script>
$( document ).on( "click", ".show-page-loading-msg", function() {
    var $this = $( this ),
        theme = $this.jqmData( "theme" ) || $.mobile.loader.prototype.options.theme,
        msgText = $this.jqmData( "msgtext" ) || $.mobile.loader.prototype.options.text,
        textVisible = $this.jqmData( "textvisible" ) || $.mobile.loader.prototype.options.textVisible,
        textonly = !!$this.jqmData( "textonly" );
        html = $this.jqmData( "html" ) || "";
		
    $.mobile.loading( "show", {
            text: msgText,
            textVisible: textVisible,
            theme: theme,
            textonly: textonly,
            html: html
    });
	$(".show-page-loading-msg").hide();
})
.on( "click", ".hide-page-loading-msg", function() {
    $.mobile.loading( "hide" );
});
</script>
</body>

</html>
