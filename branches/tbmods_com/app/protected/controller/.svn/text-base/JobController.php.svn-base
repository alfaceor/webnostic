<?php
/**
 * Description of JobController
 *
 * @author alfaceor
 */
class JobController extends DooController{
    public function index(){
        $data['baseurl'] = Doo::conf()->APP_URL;
		$data['disease'] = Doo::conf()->SITE;
        $data['title'] = 'Jobs';
        /* FIXME: */
        $data['content'] = '
            <p>FIXME<b> You can do all this process:</b></p>
            <p><a href="'.$data['baseurl'].'index.php/jobs/sample/submit">Submit a sample image</a></p>
            <p><a href="'.$data['baseurl'].'index.php/jobs/sample/list_all">List all samples</a></p>
            <p><a href="'.$data['baseurl'].'index.php/jobs/calibration/submit">new calibration image</a></p>
            <p><a href="'.$data['baseurl'].'index.php/jobs/calibration/list_all">List all calibrations</a></p>
                            ';
        $data['printr'] = '<p>You are visiting '.$_SERVER['REQUEST_URI'].'</p>';
        //var_dump($data);
        $this->view()->render('general_template', $data);
        
    }


}
?>
