<?php
//Require configuration
require_once('inc/config.inc.php');

//Require Entities
require_once('inc/Entities/User.class.php');

require_once('inc/Utilities/RestClient.class.php');
require_once('inc/Utilities/Page.class.php');
require_once("inc/Utilities/LoginManager.class.php");
require_once('inc/Utilities/PDOAgent.class.php');
require_once('inc/Utilities/UserMapper.class.php');


Page::$title = "User Table";
Page::header();
Page::showLogin();
//Check username and password to login
if(!empty($_POST) && ($_POST["action"] == "Login")) {
    //Initialize the DAO
    UserMapper::initialize();
    //Get the current user
    $authUser = UserMapper::getUserLogin($_POST["username"]);
    //Check the DAO returned an object of type user
    
        if($authUser instanceof User){

               //Check the password
               if ($authUser->verifyPassword($_POST['password']))  {
                    //Start the session
                    session_start();
                    //Set the user to logged in
                    $_SESSION["user"] = $authUser;
                    echo "user exist";

                    
                    if(LoginManager::verifyLogin()){
                     
                        header("location: CarsPage.php");
                        
                    }
                }
                echo '<p id="wrongLogin">Please enter a valid username and password.</p>';
        }
       // else Page::wrongEntry();
       echo '<p id="wrongLogin">Please enter a valid username and password.</p>';
}

Page::footer();

?>