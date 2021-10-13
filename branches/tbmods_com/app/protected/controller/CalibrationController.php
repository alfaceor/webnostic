<?php
//define('IMAGE_PATH_CALIBRATION', 'C:\Users\Augusto\Documents\xampp\htdocs\_tbmods\app\data\photos\calibration');
define('IMAGE_PATH_CALIBRATION', '/var/www'.Doo::conf()->SUBFOLDER.'data/photos/calibration');

class CalibrationController extends DooController {
    var $data;
    public function beforeRun($resource, $action){
        session_start();

        global $data;
        if(isset($_SESSION['user'])){
            $data['user'] = $_SESSION['user'];
        }else{
            $data['user'] = null;
        }

        //if not login, group = anonymous
        $role = (isset($_SESSION['user']['type'])) ? $_SESSION['user']['type'] : 'anonymous';
        //if user.type == 1 then admin
        if (isset($_SESSION['user']['type']) && $_SESSION['user']['type']== 1)
            $role = 'admin';
        //if user.type == 2 then member
        if (isset($_SESSION['user']['type']) && $_SESSION['user']['type']== 0)
            $role = 'member';

        //check against the ACL rules
        if($rs = $this->acl()->process($role, $resource, $action )){
            //echo $role .' is not allowed for '. $resource . ' '. $action;
            return $rs;
        }
    }

    /**
     * Function to submit a CALIBRATION job.
     */
    function submit() {
        global $data;

        //echo 'You are visiting '.$_SERVER['REQUEST_URI'];
        $data['baseurl'] = Doo::conf()->APP_URL;
		$data['disease'] = Doo::conf()->SITE;
		$data['title']   = 'Agregar Calibración';
        $data['jobtype'] = 'calibracion';
        $data['action']  = $data['baseurl'].'index.php/jobs/calibration/save';
        $data['more_params'] = false;
        // TODO: make a submit photo.
        $this->view()->render('newjob', $data);
    }
    
    /**
     * To update the calibration parameter.
     */
    function update() {
        echo 'You are visiting '.$_SERVER['REQUEST_URI'];
    }

    function calibrationResult(){
        global $data;

        $data['baseurl'] = Doo::conf()->APP_URL;
		$data['disease'] = Doo::conf()->SITE;
        $data['title'] = 'Resultado de Calibración';
/*
        if(isset($this->params['idsample']))
            echo 'This is the id '.$this->params['idsample'];
        else
            echo 'You are visiting '.$_SERVER['REQUEST_URI'].'Not a sample';
*/
        Doo::loadModel('Calibration');
        $calibration = new Calibration();
        $calibration->id         = $this->params['idcalibration'];
        $options['limit']   = 1;
        $data['calibration']     = $this->db()->find( $calibration, $options );
        $data['image_url']  = IMAGE_PATH_CALIBRATION.$data['sample']['imagename'];

        $this->view()->render('jobresult', $data);

    }

    /**
     * Save job.
     */
    function save(){
        global $data;
        // TODO: Save the job
        // Remove blank spaces in the post variables.
        foreach($_POST as $k=>$v){
            $_POST[$k] = trim($v);
        }
        
        if($_POST['url']=='http://' || empty($_POST['url']))
            unset($_POST['url']);
			
		if ($_POST['description'] <> "" and $_FILES['uploadedfile']['tmp_name'] <> "") { //--- validate all empty fields--------------------------------
			// To save a new calibration with there corresponding parameters.
			Doo::loadModel('Calibration');
			Doo::autoload('DooDbExpression');
			$calibration    = new Calibration();
			$calibration->description   = $_POST['description'];
	
			// TODO: user validation is really necessary
			
			// TODO: Decide what value choose here.
			// change the status "in progress"
			$calibration->status_id     = '1';
			$calibration->user_id     = $_SESSION['user']['username'];
			$calibration->imagepath     = IMAGE_PATH_CALIBRATION;
			// TODO: JPG file validation.        
	
			// Insert in the database
			$result_id = $calibration->insert();
	
			// create the image filename
			$calibration->imagename     = 'calib-'.$result_id.'.jpg';
			$image_filename=IMAGE_PATH_CALIBRATION.'/'.$calibration->imagename;
			// Save the image in the filesystem
	
			if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'],$image_filename)){
				// Update the database.
				$calibration->id=$result_id;
				$calibration->update();
			}
		   
			// make and update to the database
			$data['baseurl'] = Doo::conf()->APP_URL;
			$data['disease'] = Doo::conf()->SITE;
			$data['title']      = 'Confirmación de calibración';
			$data['content']    = 'Se ha agregado una nueva calibración '.
								  $result->id.'- Nombre del Microscopio: '.$calibration->description;
			$data['printr']     = "Procesando calibración, por favor espere el resultado <a href='".$data['baseurl']."index.php/jobs/calibration/list_all' rel='external'> Aquí </a>";
		} else {
			$data['baseurl'] = Doo::conf()->APP_URL;
			$data['disease'] = Doo::conf()->SITE;
			$data['title']      = 'Error de calibración';
			$data['content']    = 'NO pudo agregarse una calibración: Debe ingresar el <b>nombre del microscopio</b> y <b>subir una imágen de calibración</b> ';
			$data['printr']     = "Intentelo nuevamente <a href='".$data['baseurl']."index.php/jobs/calibration/submit' rel='external'> Aquí </a>";
		}
        // TODO: Send to the web service.
        $this->render('general_template', $data);
    }

    /**
     * list all calibration files.
     */
    function list_all() {
        global $data;
        
        Doo::loadHelper('DooPager');
        Doo::loadModel('Calibration');


        $calibration = new Calibration();
        
        $totalpages=$calibration->count();
        $data['baseurl'] = Doo::conf()->APP_URL;
		$data['disease'] = Doo::conf()->SITE;
        $data['title']='Lista de Calibraciones';
        $data['listurl']= $data['baseurl'].'index.php/jobs/calibration/list_all';

          if ($_POST['id_calib']){
		//hide or show sample ------------------------------------------------------------
		$calibration2 = new Calibration();
		$calibration2->id = $_POST['id_calib'];
        $calibration2->hide = $_POST['hide_calib'];
        $calibration2->update();
		}
		
		$calibration->user_id = $_SESSION['user']['username'];
        $data['calibrations']   = $this->db()->find($calibration, array("desc" => "id"));
        
        $this->view()->render('list_all_calibrations', $data);
    }

}
?>
