<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "header_noajax.php"; ?>

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
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        //mywindow.close();

        return true;
    }

</script>

<script>
function ocultar(x,a) {
document.sampleform.id_sample.value=x;
document.sampleform.hide_sample.value=a;
document.sampleform.submit();
}			
</script>
<style>
.ui-input-search { display:inline-block !important;}
.ui-select { display:inline-block !important;}
</style>
</head>
<body>

<div data-role="page" class="ui-responsive-panel">
    <div data-role="header" data-theme="b" data-position="fixed">
       
        <a href="#nav-panel" data-icon="bars">MENU / <?php echo $data['title']; ?></a>
        
       <h1><?php echo $data['disease']." (<i>".$data['user']['nombres']." ".$data['user']['apellidos']."</i>)"; ?></h1>
       
        <a href="#" data-rel="back" data-icon="back" data-iconpos="notext">Regresar</a>   
        
    </div><!-- /header -->
    
    <div data-role="content" class="jqm-content">
    
    <form name="sampleform" action="<?php echo $data['listurl']; ?>/desc/////1" method="post">
    
     <input type="hidden" name="id_sample">
	 <input type="hidden" name="hide_sample">

     <input type="search" name="s_nam" id="s_nam" value="<?php echo $_POST['s_nam']; ?>" placeholder="Nombre de Imágen" data-mini="true">
     <select name="s_ano" id="s_ano" data-mini="true">
        <option value="">Año</option>
        <?php for ($ano = 2013; $ano <= date("Y"); $ano++) { ?>
        <option value= "<?php echo $ano; ?>" <?php if ($_POST['s_ano']==$ano) echo "selected"; ?>><?php echo $ano; ?></option>
        <?php } ?>
     </select>
     
     <select name="s_mes" id="s_mes" data-mini="true">
        <option value="">Mes</option>
        <option value="01" <?php if ($_POST['s_mes']=="01") echo "selected"; ?>>Enero</option><option value="02" <?php if ($_POST['s_mes']=="02") echo "selected"; ?>>Febrero</option>
        <option value="03" <?php if ($_POST['s_mes']=="03") echo "selected"; ?>>Marzo</option><option value="04" <?php if ($_POST['s_mes']=="04") echo "selected"; ?>>Abril</option>
        <option value="05" <?php if ($_POST['s_mes']=="05") echo "selected"; ?>>Mayo</option><option value="06" <?php if ($_POST['s_mes']=="06") echo "selected"; ?>>Junio</option>
        <option value="07" <?php if ($_POST['s_mes']=="07") echo "selected"; ?>>Julio</option><option value="08" <?php if ($_POST['s_mes']=="08") echo "selected"; ?>>Agosto</option>
        <option value="09" <?php if ($_POST['s_mes']=="09") echo "selected"; ?>>Setiembre</option><option value="10" <?php if ($_POST['s_mes']=="10") echo "selected"; ?>>Octubre</option>
        <option value="11" <?php if ($_POST['s_mes']=="11") echo "selected"; ?>>Noviembre</option><option value="12" <?php if ($_POST['s_mes']=="12") echo "selected"; ?>>Diciembre</option>
     </select>
     
     <select name="s_dia" id="s_dia" data-mini="true">
        <option value="">Día</option>
        <option value="01" <?php if ($_POST['s_dia']=="01") echo "selected"; ?>>1</option><option value="02" <?php if ($_POST['s_dia']=="02") echo "selected"; ?>>2</option>
        <option value="03" <?php if ($_POST['s_dia']=="03") echo "selected"; ?>>3</option><option value="04" <?php if ($_POST['s_dia']=="04") echo "selected"; ?>>4</option>
        <option value="05" <?php if ($_POST['s_dia']=="05") echo "selected"; ?>>5</option><option value="06" <?php if ($_POST['s_dia']=="06") echo "selected"; ?>>6</option>
        <option value="07" <?php if ($_POST['s_dia']=="07") echo "selected"; ?>>7</option><option value="08" <?php if ($_POST['s_dia']=="08") echo "selected"; ?>>8</option>
        <option value="09" <?php if ($_POST['s_dia']=="09") echo "selected"; ?>>9</option><option value="10" <?php if ($_POST['s_dia']=="10") echo "selected"; ?>>10</option>
        <option value="11" <?php if ($_POST['s_dia']=="11") echo "selected"; ?>>11</option><option value="12" <?php if ($_POST['s_dia']=="12") echo "selected"; ?>>12</option>
        <option value="13" <?php if ($_POST['s_dia']=="13") echo "selected"; ?>>13</option><option value="14" <?php if ($_POST['s_dia']=="14") echo "selected"; ?>>14</option>
        <option value="15" <?php if ($_POST['s_dia']=="15") echo "selected"; ?>>15</option><option value="16" <?php if ($_POST['s_dia']=="16") echo "selected"; ?>>16</option>
        <option value="17" <?php if ($_POST['s_dia']=="17") echo "selected"; ?>>17</option><option value="18" <?php if ($_POST['s_dia']=="18") echo "selected"; ?>>18</option>
        <option value="19" <?php if ($_POST['s_dia']=="19") echo "selected"; ?>>19</option><option value="20" <?php if ($_POST['s_dia']=="20") echo "selected"; ?>>20</option>
        <option value="21" <?php if ($_POST['s_dia']=="21") echo "selected"; ?>>21</option><option value="22" <?php if ($_POST['s_dia']=="22") echo "selected"; ?>>22</option>
        <option value="23" <?php if ($_POST['s_dia']=="23") echo "selected"; ?>>23</option><option value="24" <?php if ($_POST['s_dia']=="24") echo "selected"; ?>>24</option>
        <option value="25" <?php if ($_POST['s_dia']=="25") echo "selected"; ?>>25</option><option value="26" <?php if ($_POST['s_dia']=="26") echo "selected"; ?>>26</option>
        <option value="27" <?php if ($_POST['s_dia']=="27") echo "selected"; ?>>27</option><option value="28" <?php if ($_POST['s_dia']=="28") echo "selected"; ?>>28</option>
        <option value="29" <?php if ($_POST['s_dia']=="29") echo "selected"; ?>>29</option><option value="30" <?php if ($_POST['s_dia']=="30") echo "selected"; ?>>30</option>
        <option value="31" <?php if ($_POST['s_dia']=="31") echo "selected"; ?>>31</option>
     </select>
     <input value="Buscar" type="submit" data-icon="search" data-iconpos="left" data-mini="true" data-theme="e" data-inline="true" />
    <!-- <a href="<?php //echo $data['listurl']; ?>" data-role="button" data-mini="true" data-inline="true" data-theme="b" rel="external">Ver Todo</a>-->
     <a href="javascript:PrintElem('#printArea')" data-role="button" data-mini="true" data-inline="true" rel="external">Imprimir</a>
    
    <div id="printArea"> <!-- Print area -------------------------------------------->
    <table data-role="table" id="movie-table" data-mode="reflow" class="ui-responsive table-stroke">
        <thead>
        <tr class="ui-bar-e">
            <th>ID</th>
            <?php if ($_SESSION['user']['type']==1 or $_SESSION['user']['type']==2) { ?><th>
            <a href="#popupPac" data-rel="popup" data-transition="pop">Paciente</a>
            <div data-role="popup" id="popupPac" data-theme="d">
            <ul data-role="listview" data-filter="true" data-filter-placeholder="Buscar Paciente.." data-inset="true">
                <?php foreach($data['users'] as $k1=>$v1): ?>
                <?php 
				if ($_SESSION['user']['type']==1) {
					if ($v1->type==3 and $v1->status==$_SESSION['user']['username']) { ?>
					<li><a href="<?php echo $data['listurl']; ?>/asc////<?php echo $v1->username; ?>/1"><?php echo $v1->username; ?></a></li>
                <?php } }
				if ($_SESSION['user']['type']==2) {
					if ($v1->type==3) { ?>
					<li><a href="<?php echo $data['listurl']; ?>/asc////<?php echo $v1->username; ?>/1"><?php echo $v1->username; ?></a></li>
                <?php } } ?>
    			<?php endforeach;?>
            </ul>
            </div>
            </th><?php } ?>
            <th>Nombre de Imágen</th>
            <th>Software</th>
            <th>Puntaje</th>
            <?php if ($data['disease']<>"MELANOMA") { ?><th>Microscopio</th><?php } ?>
            <th>
            <a href="#popupMenu" data-rel="popup" data-mini="true" data-transition="pop">Fecha</a>
		<div data-role="popup" id="popupMenu" data-theme="d">
        <ul data-role="listview" data-inset="true">
            <li><a href="<?php echo $data['listurl']; ?>/asc/////1">Antiguos</a></li>
            <li><a href="<?php echo $data['listurl']; ?>/desc/////1">Recientes</a></li>
        </ul>
		</div>
            <th>Estado</th>
            <th>Comentarios</th>
            <?php if ($data['ver']==1) { ?><th>Resultado de los Expertos</th><?php } ?>
            <?php if ($_SESSION['user']['type']==2) { ?><th>
             <a href="#popupLab" data-rel="popup" data-mini="true" data-transition="pop">Laboratorio</a>
            <div data-role="popup" id="popupLab" data-theme="d">
            <ul data-role="listview" data-filter="true" data-filter-placeholder="Buscar Laboratorio.." data-inset="true">
                <?php foreach($data['users'] as $k1=>$v1): ?>
                <?php if ($v1->type==1) { ?>
     			<li><a href="<?php echo $data['listurl']; ?>/asc///<?php echo $v1->username; ?>//1"><?php echo $v1->username; ?></a></li>
                <?php } ?>
    			<?php endforeach;?>
            </ul>
            </div>
            </th><?php } ?>
        </tr>
        </thead>

        <tbody>
        
		<?php $contsamp=0;
		foreach($data['samples'] as $k1=>$v1): 
		$expos = explode("|", $v1->user_id);
        ?>
        <tr <?php if ($v1->hide==1) echo 'style="border: 2px dashed #ff9896;opacity: 0.3;"'; ?>>
            <td><?php echo $v1->id; ?></td>
            <?php if ($_SESSION['user']['type']==1 or $_SESSION['user']['type']==2) { ?><td><?php echo $expos[1]; ?></td><?php } ?>
            <td><a href="<?php echo $data['baseurl']; ?>index.php/jobs/sample/<?php echo $v1->id."/".$data['ver']; ?>" rel="external"> <?php echo $v1->originame; ?></a></td>
            <td> <?php if ($v1->result=="0") echo "Negativo"; if ($v1->result=="1") echo "Positivo"; ?>             </td>
            <td> <?php echo $v1->score; ?>              </td>
            <?php if ($data['disease']<>"MELANOMA") { ?><td> <?php echo $v1->calibration_descr; ?>  </td><?php } ?>
            <td> <?php echo $v1->ts; ?>  </td>
            <td> <?php if($v1->status_id==1) echo "<b>En cola</b>";if($v1->status_id==2) echo "<b><i>Procesando<i></b>";if($v1->status_id==3) echo "Listo";if($v1->status_id==4) echo "<b>Error</b>"; ?> </td>
            <td>
            
            <?php if ($_SESSION['user']['type']==1) { if ($v1->hide==1) { ?>
            <a href="javascript:ocultar(<?php echo $v1->id;?>,0);" data-role="button" data-icon="alert" data-iconpos="notext" data-theme="e" data-inline="true">Desocultar</a>
            <?php } else { ?>
            <a href="javascript:ocultar(<?php echo $v1->id;?>,1);" data-role="button" data-icon="alert" data-iconpos="notext" data-theme="c" data-inline="true">Ocultar</a>
            <?php } } ?>
            
            <a href="#popEsp<?php echo $contsamp; ?>" data-rel="popup" class="ui-icon-alt" data-role="button" data-inline="true" data-mini="true" data-transition="pop">
            <?php echo $v1->numcomment; ?></a>
			<div data-role="popup" id="popEsp<?php echo $contsamp; ?>" class="ui-content" data-theme="e">
 			<p><?php 
			
			echo $expos[2]." - ".$expos[3]." - ".$expos[4]; ?></p>
			</div>
            </td>
            <?php if ($data['ver']==1) { ?> <td> <?php preg_match_all('/\[(.*?)\]/',$v1->status, $e_res); echo $e_res[1][0]." ".$e_res[1][1]." ".$e_res[1][2]; ?>  </td><?php } ?>
            <?php if ($_SESSION['user']['type']==2) { ?> <td> <?php echo $expos[0]; ?>  </td><?php } ?>
        </tr>
        <?php $contsamp++; 
		
		endforeach;
        ?>
        
        </tbody>
    </table>
    </div> <!-- end print area ----------------->
   
    </form>

    <script>
	
    $("tbody tr:nth-child(even)").css("background-color", "#efeef0");
	$("tbody tr:nth-child(odd)").css("background-color", "#fff");
    
    	$('tbody tr').mouseenter(function(){
    $(this).css({ background: '#f5e56d' });
}).mouseleave(function(){
    $("tbody tr:nth-child(even)").css("background-color", "#efeef0");
	$("tbody tr:nth-child(odd)").css("background-color", "#fff");
});
    </script>
    
  </div><!-- /content -->
    <div data-role="footer" data-position="fixed" data-theme="b">
        <div><?php echo $data['pager']; ?><?php echo "Total de Muestras: ".$data['totalpages']; ?></div>
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
