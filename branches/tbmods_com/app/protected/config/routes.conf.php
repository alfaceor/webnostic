<?php
/**
 * Define your URI routes here.
 *
 * $route[Request Method][Uri] = array( Controller class, action method, other options, etc. )
 *
 * RESTful api support, *=any request method, GET PUT POST DELETE
 * POST 	Create
 * GET      Read
 * PUT      Update, Create
 * DELETE 	Delete
 *
 * Use lowercase for Request Method
 *
 * If you have your controller file name different from its class name, eg. home.php HomeController
 * $route['*']['/'] = array('HomeController', 'index', 'className'=>'HomeController');
 * 
 * If you need to reverse generate URL based on route ID with DooUrlBuilder in template view, please defined the id along with the routes
 * $route['*']['/'] = array('HomeController', 'index', 'id'=>'home');
 */

// to generates controllers
//$route['*']['/gen_site'] = array('MainController', 'gen_site', 'authName'=>'DooPHP Admin', 'auth'=>$admin, 'authFail'=>'Unauthorized!');
//$route['*']['/gen_model'] = array('MainController', 'gen_model', 'authName'=>'DooPHP Admin', 'auth'=>$admin, 'authFail'=>'Unauthorized!');

/*
 * TODO:
 * -Principal route
 * -login/logout route
 * -error route
 * -admin:
 *      add user,
 *      update user,
 *      list users,
 *      search users
 * -jobs:
 *      submit sample
 *      search  result/status
 *      list sample
 *
 *      new calibration
 *      update calibration
 *      list calibration
 *
 */

// General routes all access.
// $route['*']['/'] = $route['*']['/allurl'] = array('MainController', 'allurl');
$route['*']['/'] = $route['*']['/home']        = array('MainController', 'index');

$route['*']['/error']       = array('ErrorController', 'index');
$route['*']['/login']       = array('MainController', 'login');
$route['*']['/logout']      = array('MainController', 'logout');

// Jobs route
$route['*']['/jobs']                            = array('JobController', 'index');
$route['*']['/jobs/sample/submit']              = array('SampleController', 'submit');
$route['*']['/jobs/sample/:idsample'] 			= array('SampleController', 'sampleResult');
$route['*']['/jobs/sample/:idsample/:verlist']  = array('SampleController', 'sampleResult');
$route['*']['/jobs/sample/save']                = array('SampleController', 'save');
$route['*']['/jobs/sample/list_all/:verlist/:orden/:nombre/:fecha/:labs/:paci/:pindex'] = array('SampleController', 'list_all');
$route['*']['/jobs/sample/ccu_lamina']          = array('SampleController', 'ccu_lamina');

$route['*']['/jobs/calibration/submit']           = array('CalibrationController', 'submit');
$route['*']['/jobs/calibration/update/:idsample'] = array('CalibrationController', 'update');
$route['post']['/jobs/calibration/save']          = array('CalibrationController', 'save');
$route['*']['/jobs/calibration/list_all']         = array('CalibrationController', 'list_all');
$route['*']['/jobs/calibration/list_all/:pindex'] = array('CalibrationController', 'list_all');

$route['*']['/jobs/preferences'] = array('PreferencesController', 'index');

//cron jobs
$route['*']['/jobs/sample/cron_sample']         = array('SampleController', 'cron_sample');
$route['*']['/admin/list_all_users/cron_mail']  = array('AdminController', 'cron_mail');

// Admin route
$route['*']['/admin']               = array('AdminController', 'index');
$route['*']['/admin/adduser']       = array('AdminController', 'addUser');
$route['post']['/admin/save_user']  = array('AdminController', 'saveUser');
$route['*']['/admin/list_all_users/:tipos']    = array('AdminController', 'list_all_users');

$route['*']['/admin/updateuser/id/:username']             = array('AdminController', 'updateUser');

// Web Services API
$route['*']['/api/sample/getSampleJob/:userlab'] = array('APIController', 'getSampleJob'); // define "userlab" var in order to classify the samples pics by labs -----------------
$route['*']['/api/sample/putSampleResult'] = array('APIController', 'putSampleResult');
$route['*']['/api/calibration/getCalibrationJob'] = array('APIController', 'getCalibrationJob');
$route['*']['/api/calibration/putCalibrationResult'] = array('APIController', 'putCalibrationResult');


?>
