<?php                                                                      //script for scriptGetDiagnostic.sh loop infinity                       
 
//Ejecuto el script para obtener el diganostico                         
$json=shell_exec("sh scriptGetDiagnostic.sh");                          
//Convierto el resultado que viene en formato JSON, en array.           
$result=json_decode($json,true);                              
print_r( $result);
if(isset($result["sampleID"])){
	if($con=mysql_pconnect('localhost','root','upchlid')){
		mysql_select_db('tmp_frontend_db');
	}
	else{
		echo "Error no se pudo conectar a la base de datos.";
	}
	$date=shell_exec("date");
	$query="update tbmods set diagnostic=".$result['diagnostic'].",score=".$result['sampleScore'].",status='Complete',time_get='".$date."' where sampleid='".$result['sampleID']."'";
	mysql_query($query);
	echo mysql_affected_rows($con);
	mysql_close($con);
	echo "Resultado obtenido";
}
else{
	echo "No hay resultados";
}
?>  
