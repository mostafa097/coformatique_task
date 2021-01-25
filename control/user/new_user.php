<?php

require_once '../../model/user.php';
$_name = filter_input(0, 'name');
$_pw = filter_input(0, 'pw');

$_uname = filter_input(0, 'username');
$_add = filter_input(0, 'add');
$_mob = filter_input(0, 'mob');
$email = filter_input(0, 'email1');
$key="t5u!U-rq3NUcg#*ABC";

$_User = new User();

if ($_User->newUser($_name, $_mob, $email)) {
      $_User->MaxID();;
     $_MaxID = $_User->MaxID();
    $_pw = md5($key.$_pw.$key);
    if ($_User->Login($_MaxID, $_uname, $_pw)) {

        echo '<script>alert("Acount Created!")</script>';
        echo '<script>window.location.href="../../view/index.php"</script>';
    }else{
        echo '<script>alert("Acount exists!")</script>';


    }



}








//echo'<script>window.location.href="../../view/new_user.php"</script>';


// on all screens requiring login, redirect if NOT logged in

?>
