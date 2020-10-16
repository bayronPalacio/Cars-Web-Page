<?php

//Require configuration
require_once('inc/config.inc.php');

//Require Entities
require_once('inc/Entities/User.class.php');
require_once('inc/Entities/Car.class.php');
require_once('inc/Entities/Locations.class.php');


//Require Utilities
require_once('inc/Utilities/RestClientCar.class.php');
require_once('inc/Utilities/RestClientLocation.class.php');
require_once('inc/Utilities/Page.class.php');
require_once("inc/Utilities/LoginManager.class.php");
require_once('inc/Utilities/PDOAgent.class.php');
require_once('inc/Utilities/UserMapper.class.php');
require_once('inc/Utilities/CarMapper.class.php');
require_once('inc/Utilities/LocationMappper.class.php');

// Initiate the session
session_start();

Page::$title = "Cars Table";
Page::header();
//Page::logout();

##############################################################
//                      STATISTICS                          //

$jCars = RestClientCar::call("GET");
$jbrands = array();
$jName = array();
$jCount = array();

$totalCars = array();
$numberOfCars = 0;
foreach($jCars as $car){

    $brands[] = $car->CarBrand;

    $numberOfCars++;
}

$jName = array_unique($brands);

foreach ($jName as $key){

    $count =  RestClientCar::call("GETBRANDS", array("brand" => $key));
    
    $jCount[] = count($count);
}


##############################################################
//                          CRUD                           //

//- Checking for each POST options in the page i.e all the GETS from the database
 if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //- Sorting the list of cars
    if (isset($_POST["sortbtn"]) && $_POST["sortbtn"] == "Sort") {
            
        //- Sorting by lowest price first
        if($_POST["sort"] == "Price: Lowest first")    {

            $sortedCars = RestClientCar::call("SortByLowest");

            $lowestCars = array();

            foreach ($sortedCars as $car) {
                
                $sortCar = new Car();
                $sortCar->setCarID($car->CarID);
                $sortCar->setCarBrand($car->CarBrand);
                $sortCar->setCarModel($car->CarModel);
                $sortCar->setCarYear($car->CarYear);
                $sortCar->setCarPrice($car->CarPrice);
                $sortCar->setCarStatus($car->CarStatus);
                $sortCar->setCarIMG($car->CarIMG);
                $sortCar->setLocationID($car->LocationID);
            
                $lowestCars [] = $sortCar;
        
            }
            //- Displaying the sorted list
            Page::listCars($lowestCars);

            //- Sorting by highest price first
        }elseif ($_POST["sort"]  == "Price: Highest first") {

            $sortedCars = RestClientCar::call("SortByHighest");

            $highestCars = array();

            foreach ($sortedCars as $car) {
                
                $sortCar = new Car();
                $sortCar->setCarID($car->CarID);
                $sortCar->setCarBrand($car->CarBrand);
                $sortCar->setCarModel($car->CarModel);
                $sortCar->setCarYear($car->CarYear);
                $sortCar->setCarPrice($car->CarPrice);
                $sortCar->setCarStatus($car->CarStatus);
                $sortCar->setCarIMG($car->CarIMG);
                $sortCar->setLocationID($car->LocationID);

                $highestCars [] = $sortCar;
        
            }
            //- Displaying sorted list
            Page::listCars($highestCars);
            
        }

        //- Searching data inside the database and displaying it into a new list of cars
    } elseif(isset($_POST["searchBtn"]) && $_POST["searchBtn"] == "Search!"){
      
        $results = RestClientCar::call("SEARCH", array("input" => $_POST["searchInput"]));
        
        $searchCars = array();

        foreach($results as $result)    {

            $singleResult = new Car();

            $singleResult->setCarID($result->CarID);
            $singleResult->setCarBrand($result->CarBrand);
            $singleResult->setCarModel($result->CarModel);
            $singleResult->setCarYear($result->CarYear);
            $singleResult->setCarPrice($result->CarPrice);
            $singleResult->setCarStatus($car->CarStatus);
            $singleResult->setCarIMG($result->CarIMG);
            $singleResult->setLocationID($car->LocationID);

            $searchCars[] = $singleResult;
        }
        
        //- If no results were found, then:
        if(count($searchCars) == 0) {
            
            Page::redirect("No results were found. You will be redirected to the main page.");
            header('Refresh: 0; URL=http://localhost/CSIS3280/Project/CarsPage.php');
            
        }else {

            //- Displaying the search results in a list format
            Page::listCars($searchCars);
        }
              
        //- If action is create, then move to the NewCarPage to create a new car
    } elseif (isset($_POST["action"]) && $_POST["action"] == "create")    {
        
        header('Location: NewCarPage.php');
    } 

   
 }else {

    //- Get all the cars from the web service via the REST client
    $jCars = RestClientCar::call("GET");
    
    //- Store the cars objects 
    $cars = array();

    //- Iterate through the cars and convert them back to cars objects
    foreach($jCars as $jCar)   {

        $listCars = new Car();
        $listCars->setCarID($jCar->CarID);
        $listCars->setCarBrand($jCar->CarBrand);
        $listCars->setCarModel($jCar->CarModel);
        $listCars->setCarYear($jCar->CarYear);
        $listCars->setCarPrice($jCar->CarPrice);
        $listCars->setCarStatus($jCar->CarStatus);
        $listCars->setCarIMG($jCar->CarIMG);
        $listCars->setLocationID($jCar->LocationID);

        $cars [] = $listCars;
    }
    
    //- Displaying the list of cars
    Page::listCars($cars);

    }

#################################################################################
                        // Customers Table
if(isset($_POST["seeCustomers"]) && $_POST["seeCustomers"] == "Customer List"){

    header('Location: AddCustomerPage.php');
}


#################################################################################
                        // Logout
    if(isset($_POST["logout"]) && !empty($_POST["logout"])){

        if($_POST["logout"] == "Logout"){

        session_destroy();
        Page::redirect("You have logged out successfully. You will be redirected to the login page.");
        header('Refresh: 0; URL=http://localhost/CSIS_3280/Project/pro-bugs-Login.php');
       }
    }

###############################################################################
                // All the $_GETs (delete/sell and edit)
                
Page::showStatistics($jName, $jCount, $numberOfCars);

if (isset($_GET["action"])){
    //Perform the Action

    if ($_GET["action"] == "sell"){
        
        $sellingCar = RestClientCar::call("GET",array('id'=>$_GET['id']));

        $_SESSION["car"] = $sellingCar;

        header('Location: SellPage.php');
    }
    //Was there an edit?
    else if ($_GET["action"] == "edit"){
        //Call the rest client with GET, encode the result into a typed Customer
        
        $editCar = RestClientCar::call("GET",array('id'=>$_GET['id']));
        
        $_SESSION["car"] = $editCar;

        header('Location: CarEditPage.php');
        
    }elseif ($_GET["action"] == "location"){

        $carLocation = RestClientCar::call("GET",array('id'=> $_GET["id"]));
        $location = RestClientLocation::call("GET", array("LocationID" => (int)$carLocation->LocationID));
    
        Page::showCarLocation($location->Location);
        
    }
}


Page::footer();



?>