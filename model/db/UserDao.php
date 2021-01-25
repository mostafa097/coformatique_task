<?php

require_once 'BaseDao.php';

/**
 * User DAO Class - Objects are meant to act as Data Access Objects.
 * Performs select, insert, update & delete operations upon 'users' table.
 * Inherits form BaseDao class.
 */
class UserDao
{

    private $db;
    private $_Conn;

    public function __construct()
    {

    }


    public function Delete($_Tablename, $_ColNameID)
    {
        $db = BaseDao::getInstance();
        $_Conn = $db->getConnection();
        $_SQL = 'DELETE FROM ' . $_Tablename . ' WHERE id = :_id';
        $_Statment = $_Conn->prepare($_SQL);
        $_Statment->bindParam(':_id', $_ColNameID);
        $_Statment->execute();
    }


    public function insert($TableName, array $values)
    {
        $db = BaseDao::getInstance();
        $_Conn = $db->getConnection();
        $sql = 'INSERT INTO ' . $TableName;
        $fields = array_keys($values);
        $vals = array_values($values);

        $sql .= '(' . implode(',', $fields) . ') ';

        $arr = array();
        foreach ($fields as $f) {
            $arr[] = ' ? ';
        }
        $sql .= 'VALUES(' . implode(', ', $arr) . ') ';

        $statement = $_Conn->prepare($sql);
        foreach ($vals as $i => $v) {
            $statement->bindValue($i + 1, $v);
        }

        return $statement->execute();
    }


    public function SelectAll($_TableName, $_ColName)
    {

        $db = BaseDao::getInstance();
        $_Conn = $db->getConnection();
        $_SQL = 'SELECT * FROM ' . $_TableName . ' ORDER BY ' . $_ColName . ' ASC';
        $_Statment = $_Conn->prepare($_SQL);
        $_Statment->execute();
        $_Result = array();
        $i = 0;
        while ($_Row = $_Statment->fetch()) {
            $_Result[$i] = $_Row;
            $i++;
        }
        return $_Result;
    }

    public function select_user($username, $password)
    {

        $db = BaseDao::getInstance();
        $_Conn = $db->getConnection();

        $_SQL = 'SELECT  userid FROM login WHERE username =:_UN AND password =:_PW';
        $_Statment = $_Conn->prepare($_SQL);
        $_Statment->bindParam(':_UN', $username);
        $_Statment->bindParam(':_PW', $password);
        $_Statment->execute();


        $arr = array();
        while ($result = $_Statment->fetch()) {

            $row = $result[0];
            array_push($arr, $row);


        }

        return $arr;

    }

    public function select_messages($condtion, $parent)
    {

        $db = BaseDao::getInstance();
        $_Conn = $db->getConnection();

        $_SQL = 'SELECT Messages.id, `message`, `parent`, user.name FROM `Messages` INNER JOIN user ON Messages.addedby = user.id WHERE `is_deleted`=:_C';
        $_Statment = $_Conn->prepare($_SQL);
        $_Statment->bindParam(':_C', $condtion);


        $_Statment->execute();


        $arr = array();
        while ($result = $_Statment->fetch()) {

            $row = $result[0] . "~" . $result[1] . "~" . $result[2] . "~" . $result[3] . "~";
            array_push($arr, $row);


        }

        return $arr;

    }


    public function update($_TableName, $id, array $values)
    {
        $db = BaseDao::getInstance();
        $_Conn = $db->getConnection();
        $sql = 'UPDATE' . $_TableName . 'SET ';
        $fields = array_keys($values);
        $vals = array_values($values);

        foreach ($fields as $i => $f) {
            $fields[$i] .= ' = ? ';
        }

        $sql .= implode(',', $fields);

        $statement = $_Conn->prepare($sql);
        foreach ($vals as $i => $v) {
            $statement->bindValue($i + 1, $v);
        }
        $sql .= ' WHERE id =:_id';
        echo $statement;
        $statement->bindParam(':_id', $id);

        $statement->execute();
    }


    public function delete_msg($_Values)
    {

        $db = BaseDao::getInstance();
        $_Conn = $db->getConnection();

        echo "here";
        $sql = 'UPDATE `Messages` SET `is_deleted`= 1 WHERE id =:_Values';
        // $_Values = (int)$_Values;
        $_Statement = $_Conn->prepare($sql);
        $_Statement->bindParam(':_Values', $_Values);
        print_r($_Statement);
        $_Statement->execute();


    }  public function update_msg($id,$_Values)
    {

        $db = BaseDao::getInstance();
        $_Conn = $db->getConnection();

        echo "here";
        $sql = 'UPDATE `Messages` SET `message`= :_M WHERE id =:_ID';
        // $_Values = (int)$_Values;
        $_Statement = $_Conn->prepare($sql);
        $_Statement->bindParam(':_ID', $id);
        $_Statement->bindParam(':_M', $_Values);

        $_Statement->execute();


    }

    public function SelectMaxID($_TableName)
    {
        $db = BaseDao::getInstance();
        $_Conn = $db->getConnection();

        $_SQL = 'SELECT MAX(ID) FROM ' . $_TableName;
        $_Statement = $_Conn->prepare($_SQL);
        $_Statement->execute();
        $_MaxID = $_Statement->fetch();
        return $_MaxID[0];
    }


}

?>
