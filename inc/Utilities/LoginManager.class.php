<?php

class LoginManager  {

    //This function checks if the user is logged in, if they are not they are redirected to the login page
    static function verifyLogin()   {

        //Check for a session
        if(!empty($_SESSION)){
            //Start it up
            //If there is session data
            if (isset($_SESSION)){
                //The user is loggedin, return true
                return true;
            } else {
                //The user is not logged in
                //Destroy any session just in case   
                unset($_SESSION["user"]);
                //Send them back to the login pages
                Page::showLogin();
                return false;
            }
        }
        
    }  
}

?>