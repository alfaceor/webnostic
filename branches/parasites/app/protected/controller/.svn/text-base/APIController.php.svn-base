<?php

define('IMAGE_PATH', '/home/alfaceor/Projects/web/webnostic-parasites/app/data/photos');
define('IMAGE_PATH_CALIBRATION', IMAGE_PATH.'/calibration');
define('IMAGE_PATH_SAMPLE', IMAGE_PATH.'/sample');

/**
 * Description of APIController
 * The web service for the comunication with the cluster.
 * Send Job to calculate and store results from that.
 *
 * @author alfaceor
 */
class APIController extends DooController{
	public function test(){
		echo 'TEST FUNCTION';
	}

    /**
     * Description: API to get the sample.
     */
    function getSampleJob(){
        // Check the client authentication
        // From $_POST recibe  $date,  $signature
        // KEYs
        $cluster_private_key	= 'cluster_endpoint_private_key';
        // Remove blank spaces in the post variables.
        foreach($_POST as $k=>$v){
                $_POST[$k] = trim($v);
                //echo $_POST[$k];
        }
        // $time: Just a random variable for the HMAC authentication.
        $rand_message	= $_POST['rand_message'];
        $cluster_public_key	= $_POST['cluster_public_key'];
        // $signature: the hash generated for the authorizaded client
        $signature	= $_POST['signature'];
        // IMPORTANT: the order must be the same in server and client.
        $messg		= "".$cluster_public_key.$rand_message;
        //echo $messg;
        $generated_signature	= hash_hmac('sha1',$messg,$cluster_private_key);
        echo $generated_signature;

        // HMAC: With the $date and the $public_key generate the $generated_signature

        if(trim($signature)==trim($generated_signature)){
            // Find in the database for the sample status_id = 1 and getOne
            Doo::loadModel('Sample');
            $sample = new Sample();
            $sample->status_id  = 1;
            $query_result = $sample->getOne();
            if($query_result->id===NULL){
                echo 'No job to process...';
                exit("Please wait\n");
            }

            $filename = tempnam('tmp','zip');
            $img_filename = IMAGE_PATH_SAMPLE."/".$query_result->imagename;
            // Create a zip file: Image and meta.inf
            $zip = new ZipArchive();
            $opener = $zip->open($filename, ZIPARCHIVE::OVERWRITE);
            $zip->addFile($img_filename,basename($img_filename));
            $zip->addFromString("meta.inf",json_encode($query_result));
            $zip->close();
            echo $img_filename;
            header("Content-Type: application/octect-stream");
            readfile($filename);
            // Change the status_id = 2;
            $sample->id=$query_result->id;
            $sample->status_id=2;
            $sample->update();
        }else{
            echo 'You are not an authorized endpoint';
        }
    }

    /**
     * Description: Save the result and score to the corresponding sample job after the calculation in the cluster. The client (compute) must simulate a form.
     */
    function putSampleResult(){
        // KEYs
        $cluster_private_key	= "cluster_endpoint_private_key";
        // TODO:
        // From $_POST sample_id, score, result
        // Remove blank spaces in the post variables.
        foreach($_POST as $k=>$v){
                $_POST[$k] = trim($v);
        }

        $sample_id          = $_POST['sample_id'];
        $trichu_result	= $_POST['trichu_result'];
        $trichu_score	= $_POST['trichu_score'];
        $diphy_result	= $_POST['diphy_result'];
        $diphy_score	= $_POST['diphy_score'];
        $fascio_result	= $_POST['fascio_result'];
        $fascio_score	= $_POST['fascio_score'];
        $taenia_result	= $_POST['taenia_result'];
        $taenia_score	= $_POST['taenia_score'];
        $rand_message	= $_POST['rand_message'];
        $cluster_public_key	= $_POST['cluster_public_key'];
        $signature          = $_POST['signature'];
        $messg		= "".$cluster_public_key.$sample_id.$trichu_result.$trichu_score.$diphy_result.$diphy_score.$fascio_result.$fascio_score.$taenia_result.$taenia_score.$rand_message;
        $generated_signature	= hash_hmac('sha1',$messg,$cluster_private_key);
        // echo $messg;
        // echo $generated_signature;
        // Find the private_key and generated_signature
        // Validate with hmac
        if(trim($signature)==trim($generated_signature)){
            // Update the database
            Doo::loadModel('Sample');
            $sample = new Sample();
            $sample->status_id  = 3;
            $sample->id         = $sample_id;
            $sample->trichu_result     = $trichu_result;
            $sample->trichu_score      = $trichu_score;
            $sample->diphy_result     = $diphy_result;
            $sample->diphy_score      = $diphy_score;
            $sample->fascio_result     = $fascio_result;
            $sample->fascio_score      = $fascio_score;
            $sample->taenia_result     = $taenia_result;
            $sample->taenia_score      = $taenia_score;
            $sample->update();
            
            $message='sample id: '.$sample_id.', trichu_result: '.$trichu_result.', trichu_score: '.$trichu_score.', diphy_result: '.$diphy_result.', diphy_score: '.$diphy_score.', fascio_result: '.$fascio_result.', fascio_score: '.$fascio_score.', taenia_result: '.$taenia_result.', taenia_score: '.$taenia_score;
            $this->sendResultMail($sample_id,$message);
            
            //$$this->sendResultMail('alfaceor@gmail.com',$jobid,$result,$score);
            echo 'The job '.$sample_id.' result was successfully saved\n';
            
            // sendResultSMS();
        }else{
            echo 'You are not an authorized endpoint';
        }
    }

    /**
     * Description
     */
    function getCalibrationJob(){
        // Check the client authentication
        // From $_POST recibe  $date,  $signature
        // KEYs
        $cluster_private_key	= 'cluster_endpoint_private_key';
        // Remove blank spaces in the post variables.
        foreach($_POST as $k=>$v){
                $_POST[$k] = trim($v);
                //echo $_POST[$k];
        }
        // $time: Just a random variable for the HMAC authentication.
        $rand_message	= $_POST['rand_message'];
        $cluster_public_key	= $_POST['cluster_public_key'];
        // $signature: the hash generated for the authorizaded client
        $signature	= $_POST['signature'];
        // IMPORTANT: the order must be the same in server and client.
        $messg		= "".$cluster_public_key.$rand_message;
        //echo $messg;
        $generated_signature	= hash_hmac('sha1',$messg,$cluster_private_key);
        //echo $generated_signature;

        // HMAC: With the $date and the $public_key generate the $generated_signature

        if(trim($signature)==trim($generated_signature)){
            // Find in the database for the sample status_id = 1 and getOne
            Doo::loadModel('Calibration');
            $calibration = new Calibration();
            $calibration->status_id  = 1;
            $query_result = $calibration->getOne();
            if($query_result->id===NULL){
                echo 'No job to process';
                exit("Please wait...\n");
            }

            $filename = tempnam('tmp','zip'); 
            $img_filename = IMAGE_PATH_CALIBRATION."/".$query_result->imagename;
            // Create a zip file: Image and meta.inf
            $zip = new ZipArchive();
            $opener = $zip->open($filename, ZIPARCHIVE::OVERWRITE);
            $zip->addFile($img_filename,basename($img_filename));
            $zip->addFromString("meta.inf",json_encode($query_result));
            $zip->close();
            header("Content-Type: application/octect-stream");
            readfile($filename);
            // Change the status_id = 2;
            $calibration->id=$query_result->id;
            $calibration->status_id=2;
            $calibration->update();
        }else{
            echo 'You are not an authorized endpoint';
        }

    }

    /**
     * Description
     */

    function putCalibrationResult(){
        // KEYs
        $cluster_private_key	= "cluster_endpoint_private_key";
        // TODO:
        // From $_POST sample_id, score, result
        // Remove blank spaces in the post variables.
        foreach($_POST as $k=>$v){
                $_POST[$k] = trim($v);
        }

        $calibration_id = $_POST['calibration_id'];
        $rand_message	= $_POST['rand_message'];
        $value          = $_POST['value'];

        $cluster_public_key = $_POST['cluster_public_key'];
        $signature          = $_POST['signature'];
        $messg		= "".$cluster_public_key.$calibration_id.$value.$rand_message;
        $generated_signature	= hash_hmac('sha1',$messg,$cluster_private_key);
        echo $messg;
        echo $generated_signature;
        // Find the private_key and generated_signature
        // Validate with hmac
        if(trim($signature)==trim($generated_signature)){
            // Update the database
            Doo::loadModel('Calibration');
            $calibration = new Calibration();
            $calibration->id        = $calibration_id;
            $calibration->status_id = 3;
            $calibration->value     = $value;
            $calibration->update();
            echo 'The job '.$sample_id.' result was successfully saved';
        }else{
            echo 'You are not an authorized endpoint';
        }
    }

    
    function sendResultMail($sample_id,$message){
        // TODO: get the email user from the $sample_id
        Doo::loadModel('Sample');
        $sample = new Sample();
        $sample->id = $sample_id;
        $query_result_samp = $sample->getOne();
        print_r($query_result_samp);

        // Obtain user to send result.
        Doo::loadModel('User');
        $user   = new User();
        $user->id   = $query_result_samp->user_id;
        $query_result_user = $user->getOne();
        print_r($query_result_user) ;
        
        $to = $query_result_user->correo;
        //$to      = 'alfaceor@gmail.com';
        $subject = 'Webnostic-Sample Result '.$sample_id;
        //$message = 'sample id: '.$sample_id.', score: '.$score.', result: '.$result;
        $headers = 'From: no-reply@webnostic.com' . "\r\n" .
            'Reply-To: no-reply@webnostic.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        echo 'before function mail php <br />';
        mail($to, $subject, $message, $headers);
        echo 'AFTER function mail php';

        /*
        $jobid='2';
        $score='3.43';
        $result = '1';
         
        Doo::loadHelper('DooMailer');

        $mail = new DooMailer();

        $mail->addTo('alfaceor@gmail.com');
        //$mail->addTo($_SESSION['user']['correo'], $_SESSION['user']['nombres']." ".$_SESSION['user']['apellidos']);

        $mail->setSubject("Result Job Id: ".$jobid);
        $mail->setBodyText("Este mensaje muestra el resultado de las muestra cuyo id es "+$jobid);
        // $mail->setBodyHtml("score = ".$score.", result = ".$result);
        // $mail->addAttachment('/var/web/files/file1.jpg');
        // $mail->addAttachment('/var/web/files/file2.zip');
        $mail->setFrom('webnostic@upch.pe', 'Webnostic parasites');
        $mail->send();
         *
         */
        echo 'mail sended';
    }

    /**
     * Generate list to send SMS server and dequeue id for SMS Server
     */
    function list2send(){
    /**
     * TODO:
     * Generar la tabla para ser leida por el SMS Sever en el siguiente formato
     * samples.status->4 // resultado
     * samples.count()  //conteo de base de datos
     * Crear un vista con la tabla que tiene id,numero de celular,mensaje
     *
     */
     // Para que el SMS server lea los mensajes a enviar
     echo "$n\n"; // donde $n es el numero de mensajes a enviar.

      while(CONDITION){
          echo "$id\n$cel\n$mensaje\n";
      }

      // para hacer el dequeue se hace la validacion por el id y el algoritmo
      // el SMS server envia por POST el id a dequeue($bid) y el cadena de validacion ($c)
      
      //ejemplo
      $c = '134154'; //mensaje de validacion
      $bid=5; //id de la muestra
      if ($c==($bid%3).($bid%5 + 1).($bid%7 + 2).($bid%11 + 3).($bid%13 + 4).($bid%17 + 5))
          echo 'validado';//concatenacion de numeros.
          // Cambiar status a SMS enviado (4 o 5)
    }

}
?>
