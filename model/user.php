<?php
require_once 'db/UserDao.php';

class User
{
    //put your code here

    private $_DBConnector;

    public function __construct()
    {

        $this->_DBConnector = new UserDao();
    }

    public function newUser($name, $mob, $email)
    {
        return $this->_DBConnector->insert('user', array('name' => $name, 'mobile_number' => $mob, 'email' => $email));
    }

    public function MaxID()
    {

        return $this->_DBConnector->SelectMaxID('user');

    }

    public function Login($userid, $username, $password)
    {

        return $this->_DBConnector->insert('login', array('userid' => $userid, 'username' => $username, 'password' => $password));
    }



}

?>
