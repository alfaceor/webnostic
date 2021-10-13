<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Sistema de Telediagnóstico</title>
	<link rel="stylesheet" type="text/css" href="theme.css" />
</head>
<body>
<div id='cuerpo'>
	<h1>Sistema de Telediagnóstico TBMODS</h1>
	<div id='principal'> 
		<p>
		<h3>Subir nueva imagen a procesar</h3>
		<form action="submit_sample.php" method="post" enctype="multipart/form-data">
		<label for="file">Filename:</label>
		<input type="file" name="file" id="file" />
		<br />
		<select name='grid'>
		<?php
	  if($con=mysql_pconnect('localhost','root','upchlid')){
			mysql_select_db('tmp_frontend_db');
		}
		else
			exit(1);
		$query="SELECT nameInstitute,nameMicro,gridvalue FROM grillas";
    $result=mysql_query($query);
    $n=mysql_num_rows($result);
		for($i=0;$i<$n;$i++){
			$data=mysql_fetch_array($result);
			echo "<option value='".$data['gridvalue']."'>".$data['nameInstitute']."/".$data['nameMicro'].":".$data['gridvalue']."</option>";
		}
		?>
		</select>
		<br />
		<input type="submit" name="submit" value="Submit" />
		</form>
		</p>
	</div>
	<div id='otras'>
		<h4>Otras opciones:</h4>
		<p><a href='listar_ultimos.php'>Listar 30 últimos</a></p>
		<p><a href='buscar_sampleid.php'>Buscar</a></p>
		<p><a href='registrar_microscopio.php'>Registrar Microscopio</a></p>
	</div>
</div>
<?php
mysql_close($con);
?>
</body>
</html> 
