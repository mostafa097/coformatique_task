<?php

/**
 * BaseDao Abstract Class - Provides database connection 
 * and abstract functions to be implemented by the child DAO classes
 */
 class BaseDao {
    private $db         = null;
    private static $_instance;
    const DB_SERVER     = "";
    const DB_USER       = "";
    const DB_PASSWORD   = "";
    const DB_NAME       = "";
    
    
    
	public static function getInstance() {
		if(!self::$_instance) { 
			self::$_instance = new self();
		}
		return self::$_instance;
	}
    
    private  function __construct(){
        $dsn = 'mysql:dbname='.self::DB_NAME.';host='.self::DB_SERVER;

        try {
            $this->db = new PDO($dsn, self::DB_USER, self::DB_PASSWORD);
        } catch (PDOException $e) {
            throw new Exception('Connection failed: ' . $e->getMessage());
        }
        
    }
    
    private function __clone() { }


	public function getConnection() {

                    return $this->db;
	}
    
}
?>
