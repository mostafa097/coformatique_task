<?php
require_once '../../model/db/UserDao.php';
$MSGOBJ=new UserDao();
$parent = filter_input(0, 'parent');
$result=$MSGOBJ->select_messages('0',$parent);


for($i=0;$i<count($result);$i++){

    echo $result[$i];


}
