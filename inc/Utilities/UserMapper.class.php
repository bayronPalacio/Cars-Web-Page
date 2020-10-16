<?php

class UserMapper    {

    private static $db;

    static function initialize()    {

        //Initialize the database connection
        self::$db = new PDOAgent('User');
    
    }

    //READ a single User by ID
    static function getUser(int $id){
        $sql = "SELECT * FROM user WHERE UserID = :id;";
        //Prepare the query
        self::$db->query($sql);
        //Set the bind parameters
        self::$db->bind(":id",$id);
        //Execute the query
        self::$db->execute();
        //Get the row
        return self::$db->singleResult();
    
    }

    //READ a single User by USER FOR LOGIN
    static function getUserLogin(string $username){
        
        $sql = "SELECT * FROM user WHERE UserName = :username;";
        //Prepare the query
        self::$db->query($sql);
        //Set the bind parameters
        self::$db->bind(":username", $username);
        //Execute the query
        self::$db->execute();
        //Get the row
        return self::$db->singleResult();
    
    }

    //READ a list of Users
    static function getUsers(){
        $sql = "SELECT * FROM user ORDER BY UserID Asc;";
        // //Prepare the query
        self::$db->query($sql);
        // // //Execute the query
        self::$db->execute();
        // // //Get the row
        return self::$db->getResultSet();
    }

}

?>