<?php
require_once '../../model/db/UserDao.php';
$message = filter_input(0, 'msg');
$parent = filter_input(0, 'parent');
$msgObj=new UserDao();
$messageObj=new UserDao();

session_start();
$userid=$_SESSION["u_id"] ;
if ($messageObj->insert('Messages',array("message"=>$message,'parent'=>$parent,"addedby"=>$userid))) {
 echo true;
}
