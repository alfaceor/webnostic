<?php
/**
 * @author Carlos Olivares - alfaceor@gmail.com
 * @abstract There two types of user "member" and "admin"
 * members = submit job and etc.
 * admin = create, delete, managment users.
 *  */

# admin can access everywhere
$acl['admin']['allow'] = '*';

# member can't access to admin modules
$acl['member']['deny'] = array(
                            'AdminController'=>'*'
                        );
$acl['member']['failRoute'] = array(
                            '_default'=>'/error/loginfirst',
                        );

# member can access to the Calibration and Sample controllers.
$acl['member']['allow'] = array(
                            'JobController'=>'*',
                            'CalibrationController'=>'*',
                            'SampleController'=>'*'
                        );
# member failRoute then 'You don't have admin privileges'

# anonymous can access just information pages and login.
$acl['anonymous']['allow'] = array(
                            'MainController'=>array('index')
                            );
$acl['anonymous']['deny'] = '*';

$acl['anonymous']['failRoute'] = array(
				'_default'=>'/error/loginfirst',
				);

/*
$acl['vip']['allow'] =
$acl['member']['allow'] = array(
				'SnsController'=>'*',
				'BlogController'=>'*',
        			);

$acl['member']['deny'] = array(
				'SnsController'=>array('banUser', 'showVipHome'),
				'BlogController' =>array('deleteComment', 'writePost')
				);

$acl['vip']['deny'] = array(
				'SnsController'=>array('banUser'),
				'BlogController' =>array('deleteComment', 'writePost')
				);

$acl['admin']['allow'] = '*';
$acl['admin']['deny'] = array(
        			'SnsController'=>array('showVipHome')
				);


$acl['member']['failRoute'] = array(
				'_default'=>'/error/member',	//if not found this will be used
				'SnsController/banUser'=>'/error/member/sns/notAdmin',
				'SnsController/showVipHome'=>'/error/member/sns/notVip',
				'BlogController'=>'/error/member/blog/notAdmin'
				);

$acl['vip']['failRoute'] = array(
				'_default'=>'/error/vip',	//if not found this will be used
				'SnsController/banUser'=>'/error/member/sns/notAdmin',
				'BlogController'=>'/error/member/blog/notAdmin'
				);

$acl['admin']['failRoute'] = array(
				'SnsController/showVipHome'=>'/error/admin/sns/vipOnly'
				);

$acl['anonymous']['failRoute'] = array(
				'_default'=>'/error/loginfirst',
				);
 *
 */
?>
