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
$route['*']['/gen_site'] = array('MainController', 'gen_site', 'authName'=>'DooPHP Admin', 'auth'=>$admin, 'authFail'=>'Unauthorized!');
$route['*']['/gen_model'] = array('MainController', 'gen_model', 'authName'=>'DooPHP Admin', 'auth'=>$admin, 'authFail'=>'Unauthorized!');

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
$route['*']['/faqs']        = array('MainController', 'faqs');
$route['*']['/information'] = array('MainController', 'information');
$route['*']['/contactus']   = array('MainController', 'contactus');
$route['*']['/login']       = array('MainController', 'login');
$route['*']['/logout']      = array('MainController', 'logout');

// Jobs route
$route['*']['/jobs']                            = array('JobController', 'index');
$route['*']['/jobs/sample/submit']              = array('SampleController', 'submit');
$route['*']['/jobs/sample/:idsample']           = array('SampleController', 'sampleResult');
$route['*']['/jobs/sample/save']                = array('SampleController', 'save');
$route['*']['/jobs/sample/list_all']            = array('SampleController', 'list_all');
$route['*']['/jobs/sample/list_all/:pindex']    = array('SampleController', 'list_all');

$route['*']['/jobs/calibration/submit']         = array('CalibrationController', 'submit');
$route['*']['/jobs/calibration/update/:idsample'] = array('CalibrationController', 'update');
$route['post']['/jobs/calibration/save']           = array('CalibrationController', 'save');
$route['*']['/jobs/calibration/list_all']       = array('CalibrationController', 'list_all');
$route['*']['/jobs/calibration/list_all/:pindex'] = array('CalibrationController', 'list_all');

$route['*']['/jobs/preferences'] = array('PreferencesController', 'index');

// Admin route
$route['*']['/admin']               = array('AdminController', 'index');
$route['*']['/admin/adduser']       = array('AdminController', 'addUser');
$route['post']['/admin/save_user']  = array('AdminController', 'saveUser');
$route['*']['/admin/list_all_users'] = array('AdminController', 'list_all_users');
$route['*']['/admin/updateuser/id/:iduser']         = array('AdminController', 'updateUser');
$route['*']['/admin/updateuser/username/:username'] = array('AdminController', 'updateUser');

$route['*']['/admin/list_all_users/:pindex'] = array('AdminController', 'list_all_users');

// Web Services API
$route['*']['/api/sample/getSampleJob'] = array('APIController', 'getSampleJob');
$route['*']['/api/sample/putSampleResult'] = array('APIController', 'putSampleResult');
$route['*']['/api/calibration/getCalibrationJob'] = array('APIController', 'getCalibrationJob');
$route['*']['/api/calibration/putCalibrationResult'] = array('APIController', 'putCalibrationResult');

// SMS server
$route['*']['/api/sms/list2send']=array('APIController', 'list2send');

/*
$admin = array('admin'=>'1234');
 
$route['*']['/'] = array('MainController', 'index');
$route['*']['/error'] = array('ErrorController', 'index');

//---------- Delete if not needed ------------

//view the logs and profiles XML, filename = db.profile, log, trace.log, profile
$route['*']['/debug/:filename'] = array('MainController', 'debug', 'authName'=>'DooPHP Admin', 'auth'=>$admin, 'authFail'=>'Unauthorized!');

//show all urls in app
$route['*']['/allurl'] = array('MainController', 'allurl', 'authName'=>'DooPHP Admin', 'auth'=>$admin, 'authFail'=>'Unauthorized!');

//generate routes file. This replace the current routes.conf.php. Use with the sitemap tool.
$route['post']['/gen_sitemap'] = array('MainController', 'gen_sitemap', 'authName'=>'DooPHP Admin', 'auth'=>$admin, 'authFail'=>'Unauthorized!');

//generate routes & controllers. Use with the sitemap tool.
$route['post']['/gen_sitemap_controller'] = array('MainController', 'gen_sitemap_controller', 'authName'=>'DooPHP Admin', 'auth'=>$admin, 'authFail'=>'Unauthorized!');

//generate Controllers automatically
$route['*']['/gen_site'] = array('MainController', 'gen_site', 'authName'=>'DooPHP Admin', 'auth'=>$admin, 'authFail'=>'Unauthorized!');

//generate Models automatically
$route['*']['/gen_model'] = array('MainController', 'gen_model', 'authName'=>'DooPHP Admin', 'auth'=>$admin, 'authFail'=>'Unauthorized!');

*/
?>
