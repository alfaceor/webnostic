<?php
	echo "<html><head><meta charset='utf-8' /><link rel='stylesheet' type='text/css' href='theme.css' /></head><body>";
	echo "<h3>Registered Grids</h3>";
	if($con=mysql_pconnect('localhost','root','upchlid')){
		mysql_select_db('tmp_frontend_db');
	}
	else
		exit(1);
	$query="SELECT * FROM grillas";
	$result=mysql_query($query);
	$n=mysql_num_rows($result);
	//echo ($n>0);
	if(!($n==0 || $n==-1)){
		//echo "hola";
		echo "<table border='1'>
		<tr>
		<th>Name Institute</th>
		<th>Name Microscope</th>
		<th>Grid Value</th>
		</tr>";
		for($i=0;$i<$n;$i++){
			$datos=mysql_fetch_assoc($result);
			echo "
				<tr>
					<td>".$datos['nameInstitute']."</td>
					<td>".$datos['nameMicro']."</td>
					<td>".$datos['gridvalue']."</td>
				</tr>
			";
		}
	}
	else{
		echo "No hay grillas registradas";
	}
	
	echo "</table>";	
	echo "<form action='registrar.php' method='post'>
	<p>
	<h3>Register Microscope with grid value:</h3>
	<label for='nameInstitute'>Name Institute</label>
	<input type='text' id='nameInstitute' name='nameInstitute' /><br />
	<label for='nameMicro'>Name Microscope</label>
	<input type='text' id='nameMicro' name='nameMicro' /><br />
	<label for='gridValue'>Grid Value</label>
	<input type='text' id='gridValue' name='gridValue' /><br />
	<input type='submit' value='Submit'/>
	</p>
	";
	echo "</form>";
	echo "<a href='submitform.html'>Ir a la página principal</a>";
	echo "</body></html>";
	mysql_colse($con);
?>
