<?php
/**
 * @author Carlos Olivares - alfaceor@gmail.com
 * @abstract There two types of user "member" and "admin"
 * members = submit job and etc.
 * admin = create, delete, managment users.
 *  */

/*
 * TODO:
 *
 * Access Rule
 * -----------
 * anonymous:
 *  allow: Principal, Information, FAQs
 *  deny:  Job and Admin pages
 * member:
 *  allow: Principal, Information, FAQs, Job Pages.
 *  deny:  Admin Pages
 * admin:
 *  allow: *
 *
 * If access deny
 * --------------
 * Make error controller and rules failRoute.
 *
 */

// Admin access
$acl['admin']['allow'] = '*';

$acl['member']['allow'] = '*';

$acl['member']['deny'] = array(
    'AdminController' => '*'
);

// anonymous
$acl['anonymous']['deny'] ='*';
$acl['anonymous']['allow'] ='PageController';

// if denied


?>
