<?php

require_once '../model/db/UserDao.php';
$_Uname = filter_input(0, 'uname');
$_password = filter_input(0, 'password');
$key="t5u!U-rq3NUcg#*ABC";
$_password = md5($key.$_password.$key);
session_start();

$_Login = new UserDao();

$_EmpData = $_Login->select_user($_Uname,$_password);

if ($_EmpData[0]>0) {
    $_SESSION["u_id"]=$_EmpData[0];
    echo'<script>window.location.href="../view/home.php"</script>';
}
else {
    echo '<script>alert("invalid username or password!!")</script>';
    echo '<script>window.location.href="../view/index.php"</script>';

}


// on all screens requiring login, redirect if NOT logged in

?>
