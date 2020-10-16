<?php

//Require configuration
require_once('inc/config.inc.php');

//Require Entities
require_once('inc/Entities/User.class.php');
require_once('inc/Entities/Customer.class.php');

//Require Utilities
require_once('inc/Utilities/RestClientCustomer.class.php');
require_once('inc/Utilities/Page.class.php');
require_once("inc/Utilities/LoginManager.class.php");
require_once('inc/Utilities/PDOAgent.class.php');
require_once('inc/Utilities/UserMapper.class.php');
require_once('inc/Utilities/CustomerMapper.class.php');

//- Starting a session
session_start();

Page::$title = "Add a new Customer";
Page::header();
Page::newCustomer();

###################################################################################################
                                // Checking for creating
//- Check for post data
        if(isset($_POST["addCust"])){

            try{

                if(empty($_POST["customerName"]) || empty($_POST["customerEmail"]) 
                || empty($_POST["customerPhone"]) || empty($_POST["customerAddress"])){

                    throw new Exception ("Please fill the form");
        
                } elseif(is_numeric($_POST["customerPhone"]) == false){
                    
                    throw new Exception ("Please enter a valid phone number.");
                } 

                $newCustomer = new Customer();
                $newCustomer->setCustomerName($_POST["customerName"]);
                $newCustomer->setCustomerEmail($_POST["customerEmail"]);
                $newCustomer->setCustomerPhone($_POST["customerPhone"]);
                $newCustomer->setCustomerAddress($_POST["customerAddress"]);

                $customer = (array)$newCustomer->jsonSerialize();

                RestClientCustomer::call("POST", $customer);

                /* If the user wanted to create a new customer, sentinel is true
                It means that the user came from another page and should return to that page once the creation is done
                */
                if(isset($_SESSION["sentinel"]) && $_SESSION["sentinel"] == true){

                    $_SESSION["sentinel"] = false;

                    header('Location:SellPage.php');
                }               
                
            } catch(Exception $ex){
                
                echo $ex->getMessage();
            }
        }
  
###################################################################################################
                        // Checking for edit and delete actions 

    if (isset($_GET) && !empty($_GET)){
    
    
        if ($_GET["action"] == "delete"){
           
           RestClientCUstomer::call("DELETE",array('id'=>$_GET['id']));

        }elseif ($_GET["action"] == "edit"){
            //Call the rest client with GET, encode the result into a typed Customer
        
            $editCustomer = RestClientCustomer::call("GET",array('id'=>$_GET['id']));
    
            Page::editCustomer($editCustomer); 
        }
    }

    //- Updating a customer
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST["action"]) && $_POST["action"] == "edit")    {

        $modifiedCust = new Customer();
       
        $modifiedCust->setCustomerID((int)$_POST["custID"]);
        $modifiedCust->setCustomerName($_POST["custName"]);
        $modifiedCust->setCustomerEmail($_POST["custMail"]);
        $modifiedCust->setCustomerPhone((int)$_POST["custPhone"]);
        $modifiedCust->setCustomerAddress($_POST["custAdd"]);
        
        $postData = (array)$modifiedCust->jsonSerialize();
        
        RestClientCustomer::call("PUT", $postData);
        
        }
    }
    
    // - Return to cars page
    if(isset($_POST["return"])){

        header('Location: CarsPage.php');
        
    } 

//- Display the list of customers
Page::listCustomers(RestClientCustomer::call("GET"));

Page::footer();



?>