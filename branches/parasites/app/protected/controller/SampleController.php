<?php

define('IMAGE_PATH', '/home/alfaceor/Projects/web/webnostic-parasites/app/data/photos');
define('IMAGE_PATH_CALIBRATION', IMAGE_PATH.'/calibration');
define('IMAGE_PATH_SAMPLE', IMAGE_PATH.'/sample');

class SampleController extends DooController {
    var $data;
    // FIXME: Repair this for denied access to the no admin user.
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
     * Function to submit a SAMPLE job.
     */
    function submit() {
        //echo 'You are visiting '.$_SERVER['REQUEST_URI'];
        global $data;
        $data['baseurl'] = Doo::conf()->APP_URL;
        $data['jobtype'] = 'sample';
        $data['action']  = $data['baseurl'].'index.php/jobs/sample/save';
        $data['more_params'] = false;

        // Search for the corresponding calibration data
        Doo::loadModel('Calibration');
        $calibration = new Calibration();
        $calibration->user_id   = $_SESSION['user']['id'];
        $calibration->status_id = '3';
        $data['calibrations']   = $this->db()->find($calibration);

        $this->view()->render('newjob', $data);
    }

    /**
     * To save sample image to upload and diagnostic.
     */
    function save(){
        global $data;
        // Action for the form newjob
        // Remove blank spaces in the post variables.
        foreach($_POST as $k=>$v){
            $_POST[$k] = trim($v);
        }

        if($_POST['url']=='http://' || empty($_POST['url']))
            unset($_POST['url']);

        // To save a new calibration with there corresponding parameters.
        Doo::loadModel('Sample');
        Doo::autoload('DooDbExpression');
        $sample     = new Sample();
        $sample->calibration_value  = $_POST['calibration_value'];
        $sample->user_id            = $_SESSION['user']['id'];
        $sample->status_id          = '1';
        $sample->imagepath          = IMAGE_PATH_SAMPLE;
        // TODO: JPG file validation.
        
        // Insert in the database
        $result_id = $sample->insert();
        
        // create the image filename
        $sample->imagename     = $_SESSION['user']['id'].'-sample-'.$result_id.'.jpg';
        $image_filename=IMAGE_PATH_SAMPLE.'/'.$sample->imagename;
        // Save the image in the filesystem

        if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'],$image_filename)){
            // Update the database.
            $sample->id=$result_id;
            $sample->update();
        }

        // make and update to the database
        $data['baseurl']    = Doo::conf()->APP_URL;
        $data['title']      = 'Sample confirmation';
        $data['content']    = 'User <span><b>'.$user_id.'</b></span> has submitted a new sample '.$result->id;
        
        $data['printr']     = "The job is in progress
                                please wait for the result
                                <a href='".$data['baseurl']."index.php/jobs/sample/".$result_id."' > here </a>";
                                
        // TODO: Send to the web service.
        $this->render('general_template', $data);
    }
    /**
     * To view the result of the sample, id, image, status, score, result
     */
    function sampleResult(){
        global $data;
        
        $data['baseurl']    = Doo::conf()->APP_URL;
        $data['title']      = 'Sample Result';
/*
        if(isset($this->params['idsample']))
            echo 'This is the id '.$this->params['idsample'];
        else
            echo 'You are visiting '.$_SERVER['REQUEST_URI'].'Not a sample';
*/
        Doo::loadModel('Sample');
        
        $sample = new Sample();
        $sample->id         = $this->params['idsample'];
        $options['limit']   = 1;
        $result = Doo::db()->find($sample, array('limit'=>1));

        $data['id']         = $result->id;
        $data['user_id']    = $result->user_id;
        $data['calibration_value']  = $result->calibration_value;
        $data['status_id']          = $result->status_id;
        //$data['image_url']  = IMAGE_PATH_SAMPLE.$data['sample']['imagename'];
        $data['image_url']  = 'http://localhost/webnostic-parasites/app/data/photos/sample/'.$result->imagename;

        $data['trichu_result']      = $result->trichu_result;
        $data['trichu_score']       = $result->trichu_score;
        $data['diphy_result']       = $result->diphy_result;
        $data['diphy_score']        = $result->diphy_score;
        $data['fascio_result']      = $result->fascio_result;
        $data['fascio_score']       = $result->fascio_score;
        $data['taenia_result']      = $result->taenia_result;
        $data['taenia_score']       = $result->taenia_score;
        
        $this->view()->render('jobresult', $data);
    }

    /**
     * List all sample to the corresponding user.
     */
    function list_all() {
        global $data;
        Doo::loadHelper('DooPager');
        Doo::loadModel('Sample');

        $sample     = new Sample();
        $sample->user_id    = $_SESSION['user']['id'];
        $totalpages         = $sample->count();
        $data['baseurl']    = Doo::conf()->APP_URL;
        $data['title']      = 'Sample list';
        $data['listurl']    = $data['baseurl'].'index.php/jobs/sample/list_all';

        $pager  = new DooPager($data['listurl'], $totalpages, 10, 5);
        $page   = $this->params['pindex'];

        if(isset($this->params['pindex']) && $this->params['pindex']>0)
            $pager->paginate($page);
        else
            $pager->paginate(1);

        $options['limit']       = $pager->limit;
        $data['samples']   = $this->db()->find($sample, $options);
        $pager->defaultCss;
        $pager->components['prev_link'];
        $data['pager']  = $pager->output;
        //echo $pager->components['page_size'];

        $this->view()->render('list_all_samples', $data);
    }
}
?>
