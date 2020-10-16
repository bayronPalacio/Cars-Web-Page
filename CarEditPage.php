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

session_start();


Page::$title = "Cars Table";
Page::header();

if(isset($_SESSION["car"])) {

        Page::editCar($_SESSION["car"], RestClientLocation::call("GET"));

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST["action"]) && $_POST["action"] == "edit")    {

            try{
                if(empty($_POST["brand"]) || empty($_POST["model"]) || empty($_POST["year"]) || empty($_POST["price"])){

                    throw new Exception ("Please fill the forms");
        
                } elseif((int)$_POST["year"] < 1950 || (int)$_POST["year"] > (int)date("Y")){
        
                    throw new Exception ("Please enter a valid year.");
        
                } elseif((float)$_POST["price"] < 0 || is_numeric($_POST["price"]) == false){
        
                    throw new Exception ("Please enter a valid price.");
        
                }

                //Assemble the the postData
                $newCar = new Car();
                $newCar->setCarID($_POST["carID"]);
                $newCar->setCarBrand($_POST["brand"]);
                $newCar->setCarModel($_POST["model"]);
                $newCar->setCarYear($_POST["year"]);
                $newCar->setLocationID($_POST["locationid"]);
                $newCar->setCarPrice($_POST["price"]);
                $postData = (array)$newCar->jsonSerialize();

                //Call the RestClient with PUT
                RestClientCar::call("PUT",$postData);


                Page::redirect("The car was edited successfully. You will be redirected to the main page.");
                //header('Location: CarsPage.php');
                header('Refresh: 0; URL=http://localhost/PHPCARPROJECT/CarsPage.php');
                
            }catch (Exception $ex){
                echo '<p id="exception">'.$ex->getMessage().'</p>';
            }     

        }
    }
}

Page::footer();



?>