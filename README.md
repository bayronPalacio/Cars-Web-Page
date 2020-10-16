##################################################################
                        1- Database

The database should be loaded normally on the wamp server.

##################################################################
                        2- Cloud Images

The project contains a cloud feature to hold and access the cars images.

In order to proper use this functionallity, please follow these guidelines:

    1- Download the latest curl recognized certificates here: https://curl.haxx.se/ca/cacert.pem
    2- Save the cacert.pem file in a reachable destination.
    3- Then, in your php.ini file, scroll down to where you find [curl].
    4- You should see the CURLOPT_CAINFO option commented out. Uncomment and point it to the cacert.pem file. 
        You should have a line like this:
            curl.cainfo = "certificate path\cacert.pem"
            
            As example our path was:
                curl.cainfo = "C:\wamp\www\images\cacert.pem"
            
            **Note: It must be an absolute path**
    5- Save and close your php.ini. Restart your webserver and try your request again.

    6- If you do not set the right location, you will get a CURL 77 error.

**IMPORTANT: Those steps are really importat in order to see the images when a new car is added to the database.

This information were collected in: 
https://github.com/yabacon/paystack-php/wiki/cURL-error-60:-SSL-certificate-problem:-unable-to-get-local-issuer-certificate-(see-http:--curl.haxx.se-libcurl-c-libcurl-errors.html)


##################################################################
                        3- Project
                        
In order to access the project properly, you must login with a user from the database.
First go to the pro-bugs-Login.php to login into the project.

    Choose a user from the database. The password is equal to the usernames.
        bapalacior is the default user.
