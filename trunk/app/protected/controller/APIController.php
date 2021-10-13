<?php

define('IMAGE_PATH', '/home/alfaceor/Projects/web/webnostic/app/data/photos');
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
     * Description: Save the result and score to the corresponding sample job after the calculation in the cluster. The client must simulate a form.
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
        $score		= $_POST['score'];
        $result		= $_POST['result'];
        $rand_message	= $_POST['rand_message'];
        $cluster_public_key	= $_POST['cluster_public_key'];
        $signature          = $_POST['signature'];
        $messg		= "".$cluster_public_key.$sample_id.$score.$result.$rand_message;
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
            $sample->result     = $result;
            $sample->score      = $score;
            $sample->update();
            
            $this->sendResultMail($sample_id,$score,$result);
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

    
    function sendResultMail($sample_id,$score,$result){
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
        $message = 'sample id: '.$sample_id.', score: '.$score.', result: '.$result;
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

}
?>
