<?php

//Require configuration
require_once('inc/config.inc.php');

//Require Entities
require_once('inc/Entities/User.class.php');
require_once('inc/Entities/Car.class.php');

//Require Utilities
require_once('inc/Utilities/RestClientCar.class.php');
require_once('inc/Utilities/RestClientCustomer.class.php');
require_once('inc/Utilities/Page.class.php');
require_once("inc/Utilities/LoginManager.class.php");
require_once('inc/Utilities/PDOAgent.class.php');
require_once('inc/Utilities/UserMapper.class.php');
require_once('inc/Utilities/CarMapper.class.php');

session_start();

Page::$title = "Selling a car";
Page::header();

###################################################################################################
                            // Selling = deleting a car

//- The car is actually not deleted from the database, the attribute CarStatus is changed to "Sold"

//- User must be logged in in order to make the sale
if(isset($_SESSION["user"])){
    if(isset($_SESSION["car"])) {

        Page::sellCar($_SESSION["car"], $_SESSION["user"], RestClientCustomer::call("GET"));

            if (isset($_POST["newCust"]) && $_POST["newCust"] == "Create new customer") {

                $_SESSION["sentinel"] = true;

                header('Location:AddCustomerPage.php');
                    
            }

        if (isset($_POST["sellCar"]) && $_POST["sellCar"] == "Place order!"){
                $car = $_SESSION["car"];

                RestClientCar::call("DELETE",array('id'=>$car->CarID));

                header('Location:CarsPage.php');
               
                Page::redirect("The car was sold successfully.");
                
        }
//- Sale is successful? Move back to main page
}else{
    header('Location:MainPage.php');
}
Page::footer();


}
?>