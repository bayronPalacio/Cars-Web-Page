<?php

// mysql> desc user;
// +---------------+-------------+------+-----+---------+----------------+
// | Field         | Type        | Null | Key | Default | Extra          |
// +---------------+-------------+------+-----+---------+----------------+
// | UserID        | int(11)     | NO   | PRI | NULL    | auto_increment |
// | UserFirstName | tinytext    | NO   |     | NULL    |                |
// | UserLast      | tinytext    | NO   |     | NULL    |                |
// | UserEmail     | tinytext    | NO   |     | NULL    |                |
// | UserAddress   | tinytext    | NO   |     | NULL    |                |
// | UserCity      | tinytext    | NO   |     | NULL    |                |
// | UserPhone     | tinytext    | NO   |     | NULL    |                |
// | UserName      | varchar(50) | NO   |     | NULL    |                |
// | UserPassword  | varchar(50) | NO   |     | NULL    |                |
// +---------------+-------------+------+-----+---------+----------------+
// 9 rows in set (0.00 sec)

class User {

    //Attributes for our POPO
    private $UserID;
    private $UserFirstName;
    private $UserLast;
    private $UserEmail;
    private $UserAddress;
    private $UserCity;
    private $UserPhone;
    private $UserName;
    private $UserPassword;

    //Getters
    public function getUserID() : int {
        return $this->UserID;
    }

    public function getUserFirstName() : string {
        return $this->UserFirstName;
    }
    
    public function getUserLast() : string {
        return $this->UserLast;
    }

    public function getEmail() : string {
        return $this->UserEmail;
    }

    public function getUserAddress() : string {
        return $this->UserAddress;
    }

    public function getUserCity() : string {
        return $this->UserCity;
    }

    public function getUserPhone() : string {
        return $this->UserPhone;
    }

    public function getUserName() : string {
        return $this->UserName;
    }

    //Setters
    public function setUserID(int $_userID){
        $this->UserID = $_userID;
    }

    public function setUserFirstName(string $_userFirstName){
        $this->UserFirstName = $_userFirstName;
    }

    public function setUserLast(string $_userLast){
        $this->UserLast = $_userLast;
    }

    public function setUserEmail(string $_userEmail){
        $this->UserEmail = $_userEmail;
    }

    public function setUserAddress(string $_userAddress){
        $this->UserAddress = $_userAddress;
    }

    public function setUserCity(string $_userCity){
        $this->UserCity = $_userCity;
    }

    public function setUserPhone(string $_userPhone){
        $this->UserPhone = $_userPhone;
    }
    //Serialize the object to JSON.
    public function jsonSerialize(){   

        //Or you can specify a new object of stdClass and add the attributes you want to return.
        $obj = new stdClass;
        //Add all the attributes you want.
        $obj->UserID = $this->UserID;
        $obj->UserFirstName = $this->UserFirstName;
        $obj->UserLast = $this->UserLast;
        $obj->UserEmail = $this->UserEmail;
        $obj->UserAddress = $this->UserAddress;
        $obj->UserCity = $this->UserCity;
        $obj->UserPhone = $this->UserPhone;
        $obj->UserName = $this->UserName;
        $obj->UserPassword = $this->UserPassword;
        return $obj;
    }

    function verifyPassword(string $passwordToVerify) {
        
        return password_verify($passwordToVerify, $this->UserPassword);
    }

}

?>