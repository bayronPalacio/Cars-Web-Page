<?php
// - Activating triple buffering
// - https://www.php.net/manual/en/function.ob-start.php
ob_start();


class Page  {

    public static $title = "Set Title!";

    static function header()    { ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>

            <!-- Basic Page Needs
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
            <meta charset="utf-8">
            <title><?php echo self::$title; ?></title>
            <meta name="description" content="">
            <meta name="author" content="">

            <!-- Mobile Specific Metas
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
            <!-- FONT
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="css/skeletonBUGS.css">

        <!-- <script src="jsFunctions.js"></script>      -->

        </head>

        <body>
          
            <div class="logo">
                <h1>BUGS</h1>       
            </div>
                <div class="mainBox">  
                       
    <?php }

    static function footer()    { ?>
                </div>
        <!-- End Document
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        </body>
        </html>

    <?php }


    //- Logout button
    static function logout()    { ?>
        <form method="POST">
            <input id="logout" type="submit" name="logout" value="Logout">
        </form>
    <?php }


    //- List cars objects
    static function listCars($carData) { ?>
    <div class="box1">
        <form method="post" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <table id="interactions">
                <th>
                    <input type= hidden name= action value= "create">
                    <input id="btnStyle3" style="font-size: 15pt" type = submit value="Add Car">
                </th>
               <tr>
                    <td><label>Sort by </label></td>
                    <td><select name="sort">
                        <option name="Lowest" selected>Price: Lowest first</option>
                        <option name="Highest">Price: Highest first</option>
                        </select>
                    </td>
                    <td><input id="btn2" type="submit" name="sortbtn" value = "Sort"></td>
                    <td><label>Search: </label></td>
                    <td>
                        <input type="text" name="searchInput">
                    </td>
                    <td>
                        <input id="btn2" type="submit" name="searchBtn" value="Search!">
                    </td>
                    <td>
                        <input id="btnStyle3" type="submit" name="seeCustomers" value="Customer List">
                    </td>
               </tr>    
            </table>
            
            <table class="table-Cars">
            <thead>
                <tr>
                    <th>Car Brand</th>
                    <th>Car Model</th>
                    <th>Car Year</th>
                    <th>Car Price</th>
                    <th>Location</th>
                    <th colspan = 3>Picture</th>
                </tr>
                </thead>
                <tbody>
            <?php
                foreach ($carData as $car)  {
                    echo '<TR>';
                    echo '<TD>'.$car->getCarBrand().'</TD>';
                    echo '<TD>'.$car->getCarModel().'</TD>';
                    echo '<TD>'.$car->getCarYear().'</TD>';
                    echo '<TD>'.$car->getCarPrice().'</TD>';
                    echo '<td><a href=?action=location&id='.$car->getLocationID().'>Show Location</td>';
                    
                    echo '<td><a href="?action=sell&id='.$car->getCarID().'">Sell</td>';
                    echo '<td><a href="?action=edit&id='.$car->getCarID().'">Edit</td>';
                    echo '<td id="img"><img src="'.$car->getCarIMG().'" alt="not uploaded"></td>';
                    echo '</TR>';
                }
                ?>
                </tbody>
            </table>
        </form>
    </div>
    <?php }

    //- Add a new car
    static function addCar($locations)   { ?>

        <form class="addCar" method="POST" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data"> 
            <table class="table-Cars">
                <thead>
                <th>Brand</th>
                <th>Model</th>
                <th>Year</th>
                <th>Price</th>
                <th>Location</th>
                <th>Picture</th>
                </thead>
                <tbody>
                    <tr>
                        <td><input type = text name = "brand"></td>
                        <td><input type = text name = model></td>
                        <td><input type = text name = year></td>
                        <td><input type = text name = price></td>
                        <td><select name="locationid">
                            <?php
                                foreach($locations as $location){
                                    echo '<option value="'.$location->LocationID.'">'.$location->Location.'</option>';
                                }
                            ?>
                        </select></td>
                        <td><input type = file name="file"></td>
                    </tr>
                </tbody>

            </table>
            <input class="button-primary" type="submit" value="Add Car"> 
        </form>
      
    <?php }

    //- Edit a car
    static function editCar($car, $locations)    { ?>

        <form class="addCar" method="POST" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>"> 

            <table class="table-Cars">
            <h4>Edit Car - <?php echo $car->CarID; ?></h4>
                <thead>
                <th>Brand</th>
                <th>Model</th>
                <th>Year</th>
                <th>Price</th>
                <th>Location</th>
                <th>Picture</th>
                </thead>
                <tbody>
                    <tr>
                        <td><input type = text name = brand value = "<?php echo $car->CarBrand;?>" ></td>
                        <td><input type = text name = model value = "<?php echo $car->CarModel;?>" ></td>
                        <td><input type = text name = year value = "<?php echo $car->CarYear; ?>" ></td>
                        <td><input type = text name = price value = "<?php echo $car->CarPrice; ?>" ></td>
                        <td><select name="locationid">
                            <?php
                                foreach($locations as $location){
                                    echo '<option value="'.$location->LocationID.'">'.$location->Location.'</option>';
                                }
                            ?>
                        </select></td>
                        <td><input type = text name = img value = "<?php echo $car->CarIMG;?>" ></td>
                    </tr>
                </tbody>
            </table>

            <input type="hidden" name="carID" value="<?php  echo $car->CarID; ?>">
            <input type="hidden" name="action" value="edit">
            <input class="button-primary" type="submit" value="Submit">
        </form>

    <?php }

    //- Showing statistics
    static function showStatistics(array $jBrands, array $jCount, int $total) { ?>

      <div class="box2">        
        <h4 > <?php Page::logout(); ?></h4>
        <br>
        <table id="table-Stats">
        <th>Available Brands</th>

            <?php
            echo '<th></th>';
            echo '<th>Cars</th>';
            //echo '<th>Total cars in Stock</th>';
            $counter = 0;
            foreach($jBrands as $brand){

                echo '<tr>
                        <td>'.$brand.'</td>
                        <td><progress value="'.$jCount[$counter].'" max="'.$total.'"></td>
                        <td>'.$jCount[$counter].' car(s)</td>
                    </tr>';
                $counter++;
            }
            echo '<tr>
                    <td style="font-weight:bold">Total Cars in Stock: '.$total.'</td>
                </tr>';
            ?>
        </table>
        
    <?php }

    //- Show the car location in the map
    static function showCarLocation($location){?>
          
        <iframe class="map"
        src="http://maps.google.com/maps?q=4<?php echo $location; ?>&amp;oe=utf-8&amp;client=firefox-a&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo $location; ?>&amp;ll=&amp;spn=0.008827,0.020041&amp;t=m&amp;z=14&amp;output=embed">
        </iframe>
        </div>
        <?php }

    //- Sell car form
    static function sellCar($car, $user, $customers)   { ?>
    
        <form method="POST" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <table class="table-Cars">
                <thead>
                    <th colspan = 2>Sale Information: </th>
                </thead>
                <tbody>
                <tr>
                    <td><label for="name">Seller name: </label></td>
                    <td><label type = text name = seller><?php echo $user->getUserFirstName()." ".$user->getUserLast();?> </label></td>
                </tr>
                <tr>
                    <td><label for="name">Seller email: </label></td>
                    <td><label type = text name = sellerEmail ><?php echo $user->getEmail();?></label></td>
                </tr>
                <tr>
                    <td><label for="name">Brand: </label></td>
                    <td><label type = text name = seller><?php echo $car->CarBrand;?></label></td>
                </tr>
                <tr>
                    <td><label for="name">Model: </label></td>
                    <td><label type = text name = sellerEmail ><?php echo $car->CarModel;?></label></td>
                </tr>
                <tr>
                    <td><label for="name">Year: </label></td>
                    <td><label type = text name = seller><?php echo $car->CarYear; ?> </label></td>
                </tr>
                <tr>
                    <td><label for="name">Price: </label></td>
                    <td><label type = text name = sellerEmail ><?php echo $car->CarPrice; ?></label></td>
                </tr>
                <tr>
                    <td><label for="name">Image: </label></td>
                    <td><label type = text name = seller><?php echo $car->CarIMG;?> </label></td>
                </tr>
                <tr>
                <tr>
                    <td>Existing Customer?</td>
                    <td><select>
                        <?php

                        foreach($customers as $customer){
                        echo '<option value ="'.$customer->CustomerID.'">'.$customer->CustomerName.'</option>';
                        }
                        ?>
                        </select></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="newCust" value="Create new customer"></td>
                    <td>
                    <input type="hidden" name="action" value="sell">
                    <input type="submit" name="sellCar" value="Place order!">
                    </td>
                </tr>
                </tbody>
        </table>
    <?php }

    //- Login form
    static function showLogin() { ?>
    
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Please Sign In</h3>
                </div>
                <div class="card-body">
                    <form ACTION="" METHOD="POST">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="User Name" name = "username">   
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="Password" name = "password">
                        </div>
                        <div class="form-group">
                        <input type="hidden" name="action" value="Login">
                        <button type="submit" id="btnStyle3" value="Login">Log In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php }

    //- JS function to display an alert for conformation purposes
    static function redirect(string $msg) { 

        echo '<script language="javascript">';
        echo 'alert("'.$msg.'")';
        echo '</script>';
    } 

######################################################################################
                        // Customer's functions
    //- Add a new customer
    static function newCustomer(){ ?>
        <form method="POST" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <table class="customer">
                    <th>Customer Information: </th>
                    <tr>
                        <td><label for="name">Name: </label></td>
                        <td><input type = text name = customerName></td>
                    </tr>
                    
                    <tr>
                        <td><label for="name">Email: </label></td>
                        <td><input type = text name = customerEmail></td>
                    </tr>

                    <tr>
                        <td><label for="name">Phone</label></td>
                        <td><input type = text name = customerPhone></td>
                    </tr>

                    <tr>
                    <td><label for="name">Address</label></td>
                    <td><input type = text name = customerAddress></td>
                    </tr>
                </table>

                    <input type="hidden" name="action" value="add">
                    <input id="btnStyle3" type="submit" name="addCust" value="Add Customer">
        </form>
        
    <?php }

    //- List the customers
    static function listCustomers($customerData) { ?>

        <form method="post" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <table class="table-Cars">
            <thead>
            <tr>
                <th>Customer Name</th>
                <th>Car Email</th>
                <th>Car Phone</th>
                <th>Car Address</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
            </thead>
            <tbody>

        <?php
            foreach ($customerData as $customer)  {
                echo '<TR>';
                echo '<TD>'.$customer->CustomerName.'</TD>';
                echo '<TD>'.$customer->CustomerEmail.'</TD>';
                echo '<TD>'.$customer->CustomerPhone.'</TD>';
                echo '<TD>'.$customer->CustomerAddress.'</TD>';
                
                echo '<td><a href="?action=delete&id='.$customer->CustomerID.'">Delete</td>';
                echo '<td><a href="?action=edit&id='.$customer->CustomerID.'">Edit</td>';
                echo '</TR>';
            }
            ?>
            </tbody>
            <tr>
                
            </table> 
            <input id="btnStyle3" type="submit" name="return" value="Return to main page">
        
        </form>
   <?php }

    //- Edit a customer
    static function editCustomer($customer){
        ?>
    
        <form method="POST" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <table class="customer">
                <thead>
                    <th>
                    Edit Customer - <?php echo $customer->CustomerID; ?>
                    </th>
                </thead>
                <tr>
                    <td><label for="name">Customer Name: </label></td>
                    <td><input type = text name = custName value = "<?php echo $customer->CustomerName;?>" ></td>
                </tr>
                <tr>
                    <td><label for="name">Custome Email: </label></td>
                    <td><input type = text name = custMail value = "<?php echo $customer->CustomerEmail;?>" ></td>
                </tr>
                <tr>
                    <td><label for="name">Customer Phone</label></td>
                    <td><input type = text name = custPhone value = "<?php echo $customer->CustomerPhone; ?>" ></td>
                </tr>
                <tr>
                    <td><label for="name">Customer Address</label></td>
                    <td><input type = text name = custAdd value = "<?php echo $customer->CustomerAddress; ?>" ></td>
                </tr>
            </table>

            <input type="hidden" name="custID" value="<?php  echo $customer->CustomerID; ?>">
            <input type="hidden" name="action" value="edit">
            <input id="btnStyle3" type="submit" name = "editCustomer" value="Edit">
        </form>

    <?php }

    
}

