<?php
if ($_FILES["file"]["error"] > 0){
	echo "Error: " . $_FILES["file"]["error"] . "<br />";
}
else{
	echo "Upload: " . $_FILES["file"]["name"] . "<br />";
  echo "Type: " . $_FILES["file"]["type"] . "<br />";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
  echo "Stored in: " . $_FILES["file"]["tmp_name"];
  if(is_uploaded_file($_FILES['file']['tmp_name'])){
			if(copy($_FILES['file']['tmp_name'],'uploads/'.$_FILES["file"]["name"])){
				if(copy($_FILES['file']['tmp_name'],'sams2calc/'.$_FILES["file"]["name"])){
					echo 'Archivo copiado de forma satisfactoria<br />';
				}
				else{
					echo 'Error al Copiar el archivo';
				}
	    	echo 'Archivo subido de forma satisfactoria<br />';
			}
			else{
				echo '<br />Error al mover el archivo <br />';
			}
  }
  else{
    echo "<br />Error al mover el archivo<br />".PHP_EOL;
  }
/*
  //TODO: la imagen subida se tiene que colocar de 'alguna forma' para que el script pueda crear el zip
  // mover el file al directorio sams2calc con el nombre 'imagesample.jpg'
  // correr el script
	$con=mysql_pconnect('localhost','root','upchlid');
	mysql_select_db('tmp_frontend_db');
	$ids=mysql_query('select sampleid from tbmods order by sampleid desc');
	$ids=mysql_fetch_assoc($ids);
	$id=$ids['sampleid'];
//  $result=shell_exec("sh FE_Test/scriptUpSamp.sh ".$id+1." ".$_FILES["file"]["name"]);
	mysql_query('insert into tbmods values(,0.65,0,0,"En proceso")');
	mysql_close($con);
*/
 $id=5;
 $id++;
 $result=shell_exec("./scriptUpSamp.sh ".$id." ".$_FILES["file"]["name"]);
 // $result=shell_exec("./test.sh 1 mama");
 echo $result;

}
?> 
