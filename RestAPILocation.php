<?php

require_once('inc/config.inc.php');

//Require Entities
require_once('inc/Entities/Locations.class.php');

//Require Utillity Classes
require_once('inc/Utilities/PDOAgent.class.php');
require_once('inc/Utilities/LocationMappper.class.php');

LocationMapper::initialize();

$requestData = json_decode(file_get_contents('php://input'));

switch ($_SERVER["REQUEST_METHOD"])   {

    case "GET":

        if (isset($requestData->LocationID))    {

            $location = LocationMapper::getLocation($requestData->LocationID);
            
            header('Content-Type: application/json');
           
            echo json_encode($location->jsonSerialize());         
        }else{

                        
            //All the customers!
            $locations = LocationMapper::getLocations();
            
            //Walk the customers and add them to a serialized array to return.
            $serializedLoc = array();

            foreach ($locations as $location)    {
                
                $serializedLoc[] = $location->jsonSerialize();
            }
            //Return the results
            //Set the header
            
            header('Content-Type: application/json');
            //Return the entire array
            echo json_encode($serializedLoc);  
        }
    break;

    default:
    echo json_encode(array("message"=> "Você fala HTTP?"));
    break;
}
?>