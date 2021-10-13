<?php

define('IMAGE_PATH', '/home/alfaceor/Projects/web/webnostic-parasites/app/data/photos');
define('IMAGE_PATH_CALIBRATION', IMAGE_PATH.'/calibration');
define('IMAGE_PATH_SAMPLE', IMAGE_PATH.'/sample');

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
        $data['jobtype'] = 'calibration';
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

        $data['baseurl']    = Doo::conf()->APP_URL;
        $data['title']      = 'Calibration Result';
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
        // To save a new calibration with there corresponding parameters.
        Doo::loadModel('Calibration');
        Doo::autoload('DooDbExpression');
        $calibration    = new Calibration();
        $calibration->description   = $_POST['description'];

        // TODO: user validation is really necessary
        $calibration->user_id       = $_SESSION['user']['id']; //FIXME: use the correct variable.
        // TODO: Decide what value choose here.
        // change the status "in progress"
        $calibration->status_id     = '1';

        $calibration->imagepath     = IMAGE_PATH_CALIBRATION;
        // TODO: JPG file validation.        

        // Insert in the database
        $result_id = $calibration->insert();

        // create the image filename
        $calibration->imagename     = $_SESSION['user']['id'].'-calib-'.$result_id.'.jpg';
        $image_filename=IMAGE_PATH_CALIBRATION.'/'.$calibration->imagename;
        // Save the image in the filesystem

        if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'],$image_filename)){
            // Update the database.
            $calibration->id=$result_id;
            $calibration->update();
        }
       
        // make and update to the database
        $data['baseurl']    = Doo::conf()->APP_URL;
        $data['title']      = 'Calibration confirmation';
        $data['content']    = 'User <span><b>'.$user_id.'</b></span> has submitted a new calibration '.
                              $result->id.' and the calibration description is '.$result->description;
        $data['printr']     = 'job is in process please wait for the result <a href=\'#\' > here </a>';
        
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
        $calibration->user_id   = $_SESSION['user']['id'];
        $totalpages=$calibration->count();
        $data['baseurl']= Doo::conf()->APP_URL;
        $data['title']='Calibration list';
        $data['listurl']= $data['baseurl'].'index.php/jobs/calibration/list_all';

        $pager = new DooPager($data['listurl'], $totalpages, 1, 7);
        $page = $this->params['pindex'];

        if(isset($this->params['pindex']) && $this->params['pindex']>0)
            $pager->paginate($page);
        else
            $pager->paginate(1);

        $options['limit']       = $pager->limit;
        $data['calibrations']   = $this->db()->find($calibration, $options);
        $pager->defaultCss;
        $pager->components['prev_link'];
        $data['pager']  = $pager->output;
        //echo $pager->components['page_size'];
        $this->view()->render('list_all_calibrations', $data);
    }

}
?>
