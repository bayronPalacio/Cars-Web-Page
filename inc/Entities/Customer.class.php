<?php

class Customer {

    //Attributes for our POPO
    private $CustomerID;
    private $CustomerName;
    private $CustomerEmail;
    private $CustomerPhone;
    private $CustomerAddress;


    //Getters
    public function getCustomerID() : int {
        return $this->CustomerID;
    }

    public function getCustomerName() : string {
        return $this->CustomerName;
    }
    
    public function getCustomerEmail() : string {
        return $this->CustomerEmail;
    }

    public function getCustomerPhone() : string {
        return $this->CustomerPhone;
    }

    public function getCustomerAddress() : string {
        return $this->CustomerAddress;
    }

    //Setters
    public function setCustomerID(int $newCustomerID){
        $this->CustomerID = $newCustomerID;
    }

    public function setCustomerName(string $newCustomerName){
        $this->CustomerName = $newCustomerName;
    }

    public function setCustomerEmail(string $newEmail){
        $this->CustomerEmail = $newEmail;
    }

    public function setCustomerPhone(string $newPhone){
        $this->CustomerPhone = $newPhone;
    }

    public function setCustomerAddress(string $newAddress){
        $this->CustomerAddress = $newAddress;
    }


    //Serialize the object to JSON.
    public function jsonSerialize(){   

        //Or you can specify a new object of stdClass and add the attributes you want to return.
        $obj = new stdClass;
        //Add all the attributes you want.
        $obj->CustomerID = $this->CustomerID;
        $obj->CustomerName = $this->CustomerName;
        $obj->CustomerEmail = $this->CustomerEmail;
        $obj->CustomerPhone = $this->CustomerPhone;
        $obj->CustomerAddress = $this->CustomerAddress;
      
        return $obj;
    }

}