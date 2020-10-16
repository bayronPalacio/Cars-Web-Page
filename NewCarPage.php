<?php

//Require configuration
require_once('inc/config.inc.php');
require_once('configImage.php');
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

//Check for post data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST) && !empty($_POST))    {

        try{

            if(empty($_POST["brand"]) || empty($_POST["model"]) || empty($_POST["year"]) || empty($_POST["price"])){

                throw new Exception ("Please fill the forms");

            } elseif((int)$_POST["year"] < 1950 || (int)$_POST["year"] > (int)date("Y")){

                throw new Exception ("Please enter a valid year.");

            } elseif((float)$_POST["price"] < 0 || is_numeric($_POST["price"]) == false){

                throw new Exception ("Please enter a valid price.");

            }
            //Assemble the Customer
            $addCar = new Car();
            $addCar->setCarBrand($_POST["brand"]);
            $addCar->setCarModel($_POST["model"]);
            $addCar->setCarYear($_POST["year"]);
            $addCar->setCarPrice($_POST["price"]);
            $addCar->setLocationID($_POST["locationid"]);
            $addCar->setCarIMG($_FILES["file"]["name"]);

            $postData = (array)$addCar->jsonSerialize();
            
            // //Add the data 
            RestClientCar::call("POST", $postData);

            //----------------ADD IMAGE TO CLOUD----------------------------------//
            $response['code'] = "200";
            if ($_FILES['file']['error'] != 4) {
            //set which bucket to work in
            $bucketName = "myphppics";
            // get local file for upload testing
            $fileContent = file_get_contents($_FILES["file"]["tmp_name"]);
            // NOTE: if 'folder' or 'tree' is not exist then it will be automatically created !
            $cloudPath = 'uploads/' . $_FILES["file"]["name"];
    
            $isSucceed = uploadFile($bucketName, $fileContent, $cloudPath);
    
            if ($isSucceed == true) {
                $response['msg'] = 'SUCCESS: to upload ' . $cloudPath . PHP_EOL;
                // TEST: get object detail (filesize, contentType, updated [date], etc.)
                $response['data'] = getFileInfo($bucketName, $cloudPath);
            } else {
                $response['code'] = "201";
                $response['msg'] = 'FAILED: to upload ' . $cloudPath . PHP_EOL;
            }
        }
    
            header('Location:CarsPage.php');


        }catch (Exception $ex){
            echo '<p id="exception">'.$ex->getMessage().'</p>';
        }
        
    }
 }

Page::$title = "Add a new car";
Page::header();
Page::addCar(RestClientLocation::call("GET"));

Page::footer();



?>