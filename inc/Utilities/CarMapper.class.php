<?php

class CarMapper    {

    private static $db;
    private static $dbL;

    static function initialize()    {

        //Initialize the database connection
        self::$db = new PDOAgent('Car');
        self::$dbL = new PDOAgent('Locations');
    
    }

    //CREATE a single Car
     static function createCar(Car $newCar): int   {

         //Generate the INSERT STATEMENT for the customer;
         $sql = "INSERT INTO Car (CarBrand, CarModel, CarYear, CarPrice, CarStatus, CarIMG, LocationID) 
                    VALUES (:carbrand, :carmodel, :caryear, :carprice, :carstatus, :carimg, :locationid);";
  
        //prepare the query
         self::$db->query($sql);

         //Setup the bind parameters
         self::$db->bind(":carbrand",$newCar->getCarBrand());
         self::$db->bind(":carmodel",$newCar->getCarModel());
         self::$db->bind(":caryear",$newCar->getCarYear());
         self::$db->bind(":carprice",$newCar->getCarPrice());
         self::$db->bind(":carstatus", 'Available');
         self::$db->bind(":carimg",$newCar->getCarIMG());
         self::$db->bind(":locationid", $newCar->getLocationID());
   
         //Execute the query
         self::$db->execute();

         //Return the last inserted ID!!
         return self::$db->lastInsertedId();       

     }

    //READ a single Car by ID
    static function getCarByID(int $id){
        $sql = "SELECT * FROM Car WHERE CarID = :id;";
        //Prepare the query
        self::$db->query($sql);
        //Set the bind parameters
        self::$db->bind(":id",$id);
        //Execute the query
        self::$db->execute();
        //Get the row
        return self::$db->singleResult();
    
    }

    //Search engine
    static function searchEngine(string $br){

        $sql = "SELECT * FROM Car WHERE CarStatus = 'Available' AND (CarBrand LIKE CONCAT('%',:br,'%') 
                OR CarModel LIKE CONCAT('%',:br,'%')
                    OR CarYear LIKE CONCAT('%',:br,'%')
                        OR CarPrice LIKE CONCAT('%',:br,'%'));";

        //Prepare the query
        self::$db->query($sql);
        //Set the bind parameters
        self::$db->bind(":br", $br);
        //Execute the query
        self::$db->execute();
        //Get the row
        return self::$db->getResultSet();
    
    }

    //READ a list of Car
    static function getCars(){

        $sql = "SELECT * FROM car WHERE CarStatus = 'Available' ORDER BY CarID Asc;";

        // //Prepare the query
        self::$db->query($sql);
        // // //Execute the query
        self::$db->execute();
        // // //Get the row
        return self::$db->getResultSet();
    }

    //UPDATE 
     static function updateCar(Car $updatedCar) : int   {
       
         //Create the query
         $updateQuery = "UPDATE Car SET CarBrand = :brand, CarModel = :model, 
                    CarYear = :caryear, CarPrice = :price, LocationID = :locationid WHERE CarID =:id;";
         //Query...
         self::$db->query($updateQuery);
             // //Bind
         self::$db->bind(":brand",$updatedCar->getCarBrand());
         self::$db->bind(":model",$updatedCar->getCarModel());
         self::$db->bind(":caryear",$updatedCar->getCarYear());
         self::$db->bind(":price",$updatedCar->getCarPrice());
         self::$db->bind(":locationid", $updatedCar->getLocationID());
         self::$db->bind(":id",$updatedCar->getCarID());

        //Execute the query
        self::$db->execute();

         //Get the number of affected rows
         return self::$db->rowCount();
    }

    //"DELETE" - We are not actually deleting, because we need the CarID for the order table
    //We have decided to change the CarStatus to "Sold" instead of deleting it as it can be useful later on.
    static function sellCar(int $id): int {

             $sql = "UPDATE Car SET CarStatus = :carstatus WHERE CarID = :id;";
             //Create the delete query
             self::$db->query($sql);
             //Bind the id
             self::$db->bind(":id",$id);
             self::$db->bind(":carstatus", "Sold");
             //Execute the query
             self::$db->execute();

         //Return the amount of affected rows.
         return self::$db->rowCount();
    
         
    }

    //SORT BY LOWEST PRICE
    static function sortByLowest()  {

        $sql = "SELECT * FROM Car WHERE CarStatus = 'Available' ORDER BY CarPrice Asc;";

        // //Prepare the query
        self::$db->query($sql);
        // // //Execute the query
        self::$db->execute();
        // // //Get the row
        return self::$db->getResultSet();
    }

     //SORT BY HIGHEST PRICE
     static function sortByHighest()  {

        $sql = "SELECT * FROM Car WHERE CarStatus = 'Available' ORDER BY CarPrice Desc;";

        // //Prepare the query
        self::$db->query($sql);
        // // //Execute the query
        self::$db->execute();
        // // //Get the row
        return self::$db->getResultSet();
    }

    //STATISTICS
    static function getBrands(string $brand) {

        $sql ="SELECT * FROM Car WHERE CarBrand = :carbrand AND CarStatus = 'Available';";

        self::$db->query($sql);
        self::$db->bind(":carbrand", $brand);
        self::$db->execute();
        return self::$db->getResultSet();

    }

  
}


?>