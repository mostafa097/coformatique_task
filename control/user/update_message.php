<?php

require_once '../../model/db/UserDao.php';
$obj = new UserDao();
$id = filter_input(0, 'id');
$msg = filter_input(0, 'msg');
$obj->update_msg($id,$msg);
