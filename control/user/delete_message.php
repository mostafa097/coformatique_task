<?php


require_once '../../model/db/UserDao.php';
$obj = new UserDao();
$id = filter_input(0, 'id');
$obj->delete_msg($id);
