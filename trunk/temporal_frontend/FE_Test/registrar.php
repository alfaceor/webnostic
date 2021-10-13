<?php
	echo "<html><head><meta charset='utf-8' /><link rel='stylesheet' type='text/css' href='theme.css' /></head><body>";
	$institute=$_POST["nameInstitute"];
	$micro=$_POST["nameMicro"];
	$grid=$_POST["gridValue"];
	if($con=mysql_pconnect('localhost','root','upchlid')){
		mysql_select_db('tmp_frontend_db');
	}
	else
		exit(1);
	$query=("INSERT INTO grillas values('',".$grid.",'".$micro."','".$institute."')");
	mysql_query($query);
	$n=mysql_affected_rows($con);
	if($n>0)
		echo "<br />Registered<br />";
	else
		echo "<br />No Registered<br />";
	mysql_close($con);
	echo "<a href='submitform.html'>Ir a la página principal</a>";
	echo "</body></html>";
?>
