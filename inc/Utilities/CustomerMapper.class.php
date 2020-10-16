<?php

class CustomerMapper    {

    private static $db;

    static function initialize()    {

        //Initialize the database connection
        self::$db = new PDOAgent('Customer');
    
    }

    //CREATE a single Customer
     static function createCustomer(Customer $newCustomer): int   {

         //Generate the INSERT STATEMENT for the customer;
         $sql = "INSERT INTO Customer (CustomerName, CustomerEmail, CustomerPhone, CustomerAddress) 
                    VALUES (:name, :email, :phone, :address);";
  
        //prepare the query
         self::$db->query($sql);

         //Setup the bind parameters
         self::$db->bind(":name",$newCustomer->getCustomerName());
         self::$db->bind(":email",$newCustomer->getCustomerEmail());
         self::$db->bind(":phone",$newCustomer->getCustomerPhone());
         self::$db->bind(":address",$newCustomer->getCustomerAddress());
   
         //Execute the query
         self::$db->execute();

         //Return the last inserted ID!!
         return self::$db->lastInsertedId();       

     }
    
    //READ a list of Customers
    static function getCustomers(){

        $sql = "SELECT * FROM Customer ORDER BY CustomerID Asc;";

        // //Prepare the query
        self::$db->query($sql);
        // // //Execute the query
        self::$db->execute();
        // // //Get the row
        return self::$db->getResultSet();
    }

    //- get a single customer
    static function getCustomer(int $id){

        $sql = "SELECT * FROM Customer WHERE CustomerID = :id;";

        //Prepare the query
        self::$db->query($sql);
        //Bind
        self::$db->bind(":id", $id);
        //Execute the query
        self::$db->execute();
        //Get the resultset
        return self::$db->singleResult();
    }

    //UPDATE the customer
    static function updateCustomer(Customer $updatedCustomer) : int   {
       
        //Create the query
        $updateQuery = "UPDATE Customer SET CustomerName = :custname, CustomerEmail = :email, 
                   CustomerPhone = :phone, CustomerAddress = :custaddress WHERE CustomerID =:id;";
        //Query...
        self::$db->query($updateQuery);
        //Bind
        self::$db->bind(":custname", $updatedCustomer->getCustomerName());
        self::$db->bind(":email", $updatedCustomer->getCustomerEmail());
        self::$db->bind(":phone", $updatedCustomer->getCustomerPhone());
        self::$db->bind(":custaddress", $updatedCustomer->getCustomerAddress());
        self::$db->bind(":id", $updatedCustomer->getCustomerID());

       //Execute the query
       self::$db->execute();

        //Get the number of affected rows
        return self::$db->rowCount();
   }

    //- delete a customer
    static function deleteCustomer(int $id): int {

        // try {
            $sql = "DELETE FROM customer WHERE CustomerID = :id;";
            //Create the delete query
            self::$db->query($sql);
            //Bind the id
            self::$db->bind(":id",$id);
            //Execute the query
            self::$db->execute();

        //Return the amount of affected rows.
        return self::$db->rowCount();
    
    }

  
}


?>