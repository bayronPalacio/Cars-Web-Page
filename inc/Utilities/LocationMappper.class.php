<?php

class LocationMapper {

    static $db;

    static function initialize()    {

        //Initialize the database connection
        self::$db = new PDOAgent('Locations');
    
    }

    //- Get a single location from a CarID
    static function getLocation(int $locationID){

        $sql ="SELECT Location FROM Locations WHERE LocationID = :id;";

        self::$db->query($sql);
        self::$db->bind(":id", $locationID);
        self::$db->execute();

        return self::$db->singleResult();
    }

    //- Get all locations
    static function getLocations(){

        $sql = "SELECT * FROM Locations;";

        // //Prepare the query
        self::$db->query($sql);
        // // //Execute the query
        self::$db->execute();
        // // //Get the row
        return self::$db->getResultSet();
    }


}

?>