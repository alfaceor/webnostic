<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
//ini_set('display_errors',1);
//ini_set('display_startup_errors',1);
//error_reporting(-1);


include "header.php"; ?>
<script>
$(document).ready(function () {
$(".lamina").click(function () {	
		
	lam=$(this).attr("title");
	$("#lam").val(lam); 
		
	});
});
</script>
</head>
<body>
<form id="ccu_lamina" action="<?php echo $data['action']; ?>" method="post" data-ajax="false">  
<div data-role="page" class="ui-responsive-panel">
<div data-role="header" data-theme="b" data-position="fixed">
       
        <a href="#nav-panel" data-icon="bars">MENU / <?php echo $data['title']; ?></a>
        
       <h1><?php echo $data['disease']." (<i>".$data['user']['nombres']." ".$data['user']['apellidos']."</i>)"; ?></h1>
        
        <a href="#" data-rel="back" data-icon="back" data-iconpos="notext">Regresar</a>   
        
     </div><!-- /header -->
    
<div data-role="content" class="jqm-content">

  <table data-role="table" data-mode="reflow" class="ui-responsive table-stroke">
      <thead>
        <tr>
          <th>PACIENTE</th>
          <th>LAMINA</th>
          <th>LABORATORIO</th>
          <th style="text-align:center;">EXPERTOS</th>
          <th>SOFTWARE</th>
        </tr>
      </thead>
      <tbody>
     <?php  
	 $i = 0;
	 
	 foreach($data['lamina_diag'] as $k1=>$v1): 
	 $i++;
	
	 $j=0; $expe=0; $soft=0;
		foreach($data['lamina_sample'.$i] as $c1=>$b1):
		//$j++;
		preg_match_all('/\[(.*?)\]/',$b1->status, $e_res);
		$paciente = explode("|",$b1->user_id);
		
		if ($v1->soft=="") { // --------------  si ya hay resultado del software ----
		
			if ($b1->result=="") $soft=11;
			if ($b1->result==0 and $soft<2) $soft=1;
			if ($b1->result==1) $soft=2;
		}
		
		if ($v1->expe=="") { // --------------  si ya hay resultado del experto ----
		
			if($paciente[2]) {
				if ($e_res[1][0]=="") $expe=11;
				
				if ($e_res[1][0]=="No Sospechoso" and $expe<2) $expe=1;
				if ($e_res[1][0]=="Otro"  and $expe<3) $expe=2;
				if ($e_res[1][0]=="ASC-US" and $expe<4) $expe=3;
				if ($e_res[1][0]=="ASC-HG" and $expe<5) $expe=4;
				if ($e_res[1][0]=="AGC" and $expe<6) $expe=5;
				if ($e_res[1][0]=="LIE-LG" and $expe<7) $expe=6;
				if ($e_res[1][0]=="LIE-HG" and $expe<8) $expe=7;
				if ($e_res[1][0]=="Carcinoma" and $expe<9) $expe=8;
				if ($e_res[1][0]=="Adenocarcinoma") $expe=9;
				
			}
			if($paciente[3]) {
				if ($e_res[1][1]=="") $expe=11;
				
				if ($e_res[1][1]=="No Sospechoso" and $expe<2) $expe=1;
				if ($e_res[1][1]=="Otro"  and $expe<3) $expe=2;
				if ($e_res[1][1]=="ASC-US" and $expe<4) $expe=3;
				if ($e_res[1][1]=="ASC-HG" and $expe<5) $expe=4;
				if ($e_res[1][1]=="AGC" and $expe<6) $expe=5;
				if ($e_res[1][1]=="LIE-LG" and $expe<7) $expe=6;
				if ($e_res[1][1]=="LIE-HG" and $expe<8) $expe=7;
				if ($e_res[1][1]=="Carcinoma" and $expe<9) $expe=8;
				if ($e_res[1][1]=="Adenocarcinoma") $expe=9;
				
			}
			if($paciente[4]) {
				if ($e_res[1][2]=="") $expe=11;
				
				if ($e_res[1][2]=="No Sospechoso" and $expe<2) $expe=1;
				if ($e_res[1][2]=="Otro"  and $expe<3) $expe=2;
				if ($e_res[1][2]=="ASC-US" and $expe<4) $expe=3;
				if ($e_res[1][2]=="ASC-HG" and $expe<5) $expe=4;
				if ($e_res[1][2]=="AGC" and $expe<6) $expe=5;
				if ($e_res[1][2]=="LIE-LG" and $expe<7) $expe=6;
				if ($e_res[1][2]=="LIE-HG" and $expe<8) $expe=7;
				if ($e_res[1][2]=="Carcinoma" and $expe<9) $expe=8;
				if ($e_res[1][2]=="Adenocarcinoma") $expe=9;
				
			}
		
		} 
		
		endforeach; ?>   
        <tr>
        <th><?php  echo $paciente[1]; ?></th>
        <td><?php echo $v1->lam; ?></td>
        <td>
        <?php if (!$v1->diag)
         echo '<a href="#popupLab" class="lamina" title="'.$v1->lam.'" data-rel="popup">Sin Diagnóstico</a>';
		 else
		 echo $v1->diag;
		 ?>
        </td>
        <td><?php 
		if ($v1->expe=="") {
			if ($expe==11) echo "Pendiente.."; 
			else {
				if ($expe==1) $expe = "No Sospechoso";
				if ($expe==2) $expe = "Otro";
				if ($expe==3) $expe = "ASC-US";
				if ($expe==4) $expe = "ASC-HG";
				if ($expe==5) $expe = "AGC";
				if ($expe==6) $expe = "LIE-LG" ;
				if ($expe==7) $expe = "LIE-HG";
				if ($expe==8) $expe = "Carcinoma";
				if ($expe==9) $expe = "Adenocarcinoma";
				
				echo $expe;
				$expe_up = new Ccu_lamina();
				$expe_up->lam  = $v1->lam;
				$expe_up->expe = $expe;
				$expe_up->update();
				
				$user2 = new User();
				$user2->username=$paciente[1];
				$result=Doo::db()->find($user2, array('limit'=>1));
				
				/*if ($result->telefono<>"") {
				
					require("./protected/viewc/twilio/Services/Twilio.php");
		 
					$account_sid = 'AC8b29a897814b0aa0fd87e9ff5eae5035'; 
					$auth_token = 'e975449427c0731443c98d90c3694231'; 
					$client = new Services_Twilio($account_sid, $auth_token); 
					 
					if ($expe<>"No Sospechoso") $expe = "Sospechoso"; 
					 
					$client->account->messages->create(array( 
						'To' => "+51".$result->telefono, 
						'From' => "+12017316903", 
						'Body' => "Estimado(a) ".$result->nombres." ".$result->apellidos.", su resultados de PAP es: ".$expe,   
					));
				
				 }*/
				 
				
				}
		} else {
		echo $v1->expe;	
		}
		//echo "veces".$j;
		?></td>
        <td><?php 
		if ($v1->soft=="") {
			if ($soft==11) echo "Pendiente.."; 
			else {
				if ($soft==1) $soft = "No Sospechoso";
				if ($soft==2) $soft = "Sospechoso";
				
				echo $soft;
				$soft_up = new Ccu_lamina();
				$soft_up->lam  = $v1->lam;
				$soft_up->soft = $soft;
				$soft_up->update();
				
				}
		} else {
		echo $v1->soft;	
		}
		?></td>
        </tr>
       
        <?php 
		endforeach; ?>
      </tbody>
    </table> 
    
    <div data-role="popup" id="popupLab" data-theme="d">
     <fieldset data-role="controlgroup" data-type="horizontal">
    <input type="hidden" name="lam" id="lam">
     
 	<select name="diag" id="diag" data-mini="true">
      <option value="" />Elegir Diagnóstico
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
    
    <input value="Agregar Diagnostico" type="submit" data-icon="check" data-iconpos="left" data-mini="true" data-theme="e" data-inline="true" />
    </fieldset>

    </div>  


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
</form>
</body>
</html>
