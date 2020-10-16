<?php


//Require configuration
require_once('inc/config.inc.php');

//Require Entities
require_once('inc/Entities/Customer.class.php');

//Require Utillity Classes

require_once('inc/Utilities/PDOAgent.class.php');
require_once('inc/Utilities/CustomerMapper.class.php');

/*
Create  - INSERT - POST
Read    - SELECT - GET
Update  - UPDATE - PUT
DELETE  - DELETE - DELETE
*/

//Instantiate a new Customer Mapper
CustomerMapper::initialize();


//Pull the request data
// parse_str(file_get_contents('php://input'), $requestData);
$requestData = json_decode(file_get_contents('php://input'));


//Do something based on the request
switch ($_SERVER["REQUEST_METHOD"])   {

    case "POST":    

        $nc = new Customer();
        $nc->setCustomerName($requestData->CustomerName);
        $nc->setCustomerEmail($requestData->CustomerEmail);
        $nc->setCustomerPhone($requestData->CustomerPhone);
        $nc->setCustomerAddress($requestData->CustomerAddress);
       

    $result = CustomerMapper::createCustomer($nc);
    //Return the results
    echo json_encode($result);

    break;
    
    //If there was a request with an id return that customer, if not return all of them!
    case "GET":
       
        if (isset($requestData->id))    {
            
            //Return the customer object
            $c = CustomerMapper::getCustomer($requestData->id);
            //Set the header
            header('Content-Type: application/json');
                   
            echo json_encode($c->jsonSerialize());

        }else{

            //All the customers!
            $customers = CustomerMapper::getCustomers();
            
            //Walk the customers and add them to a serialized array to return.
            $serializedCustomers = array();

            foreach ($customers as $customer)    {
                
                $serializedCustomers[] = $customer->jsonSerialize();
            }
            
            header('Content-Type: application/json');
            //Return the entire array
            echo json_encode($serializedCustomers);            
        }

    break;

    case "PUT":

        //- Modified customer
         $modCustomer = new Customer();
         $modCustomer ->setCustomerID($requestData->CustomerID);
         $modCustomer->setCustomerName($requestData->CustomerName);
         $modCustomer->setCustomerEmail($requestData->CustomerEmail);
         $modCustomer->setCustomerPhone($requestData->CustomerPhone);
         $modCustomer->setCustomerAddress($requestData->CustomerAddress);
        
         $result = CustomerMapper::updateCustomer($modCustomer);
         //Set the header
         header('Content-Type: application/json');
         //Return the number of rows affected
         echo json_encode($result);

    break;

    case "DELETE":
        
        $result = CustomerMapper::deleteCustomer($requestData->id);
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