<?php


//Require configuration
require_once('inc/config.inc.php');

//Require Entities
require_once('inc/Entities/Car.class.php');

//Require Utillity Classes
require_once('inc/Utilities/PDOAgent.class.php');
require_once('inc/Utilities/CarMapper.class.php');


/*
Create  - INSERT - POST
Read    - SELECT - GET
Update  - UPDATE - PUT
DELETE  - DELETE - DELETE
*/

//Instantiate a new Customer Mapper
CarMapper::initialize();
//Pull the request data
// parse_str(file_get_contents('php://input'), $requestData);
$requestData = json_decode(file_get_contents('php://input'));


//Do something based on the request
switch ($_SERVER["REQUEST_METHOD"])   {

    case "POST":    

        $path = explode("/", $requestData->CarIMG);

        $nc = new Car();
        $nc->setCarBrand($requestData->CarBrand);
        $nc->setCarModel($requestData->CarModel);
        $nc->setCarYear($requestData->CarYear);
        $nc->setCarPrice($requestData->CarPrice);
        $nc->setLocationID($requestData->LocationID);
        $nc->setNewCarIMG($path[5]);

    $result = CarMapper::createCar($nc);
    //Return the results
    echo json_encode($result);

    break;
    
    //If there was a request with an id return that customer, if not return all of them!
    case "GET":

        if (isset($requestData->id))    {
            
            //Return the customer object
            $c = CarMapper::getCarByID($requestData->id);
            //Set the header
            header('Content-Type: application/json');
            
            //Barf out the JSON version
           
            echo json_encode($c->jsonSerialize());

        } else {
            
            //All the customers!
            $cars = CarMapper::getCars();
            
            //Walk the customers and add them to a serialized array to return.
            $serializedCars = array();

            foreach ($cars as $car)    {
                
                $serializedCars[] = $car->jsonSerialize();
            }
            //Return the results
            //Set the header
            
            header('Content-Type: application/json');
            //Return the entire array
            echo json_encode($serializedCars);            
        }
    break;
    

    case "SortByLowest":
         $carLowestPrice = CarMapper::sortByLowest();

            $LowestToHighest = array();
            
            foreach($carLowestPrice as $car){

                $LowestToHighest[] = $car->jsonSerialize();
            }
            header('Content-Type: application/json');

            echo json_encode($LowestToHighest);
        
    break;

    case "SortByHighest":

        $carHighestPrice = CarMapper::sortByHighest();

           $HighestToLowest = array();
           
           foreach($carHighestPrice as $car){

               $HighestToLowest[] = $car->jsonSerialize();
           }
           header('Content-Type: application/json');

           echo json_encode($HighestToLowest);
       
   break;

    case "SEARCH":

        $carByBrand = CarMapper::searchEngine($requestData->input);

        $sortCarByBrand = array();
           
           foreach($carByBrand as $car){

               $sortCarByBrand[] = $car->jsonSerialize();
           }
           header('Content-Type: application/json');

           echo json_encode($sortCarByBrand);

    break;

    case "GETBRANDS":

        $total = CarMapper::getBrands($requestData->brand);

        $totalBrands = array();
            
            foreach($total as $brands){

                $totalBrands[] = $brands->jsonSerialize();
            }
            header('Content-Type: application/json');

            echo json_encode($totalBrands);
    break;

    case "PUT":
    
         $newCar = new Car();
         $newCar->setCarID($requestData->CarID);
         $newCar->setCarBrand($requestData->CarBrand);
         $newCar->setCarYear($requestData->CarYear);
         $newCar->setCarModel($requestData->CarModel);
         $newCar->setLocationID($requestData->LocationID);
         $newCar->setCarPrice($requestData->CarPrice);
        
         $result = CarMapper::updateCar($newCar);
         //Set the header
         header('Content-Type: application/json');
         //Return the number of rows affected
         echo json_encode($result);

    break;

    case "DELETE":
        
        $result = CarMapper::sellCar($requestData->id);

        // //Set the header
        header('Content-Type: application/json');
        // //return the confirmation of deletion
         echo json_encode($result);
    break; 

    default:
        echo json_encode(array("message"=> "Você fala HTTP?"));
    break;
}


?>