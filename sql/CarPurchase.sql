-- DROP the database if it exists
DROP DATABASE IF EXISTS CarPurchase;

-- CREATE THE DATABASE
CREATE DATABASE CarPurchase;

-- Use the database
USE CarPurchase;

-- Table User
CREATE TABLE User (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    UserFirstName TINYTEXT NOT NULL,
    UserLast TINYTEXT NOT NULL,
    UserEmail TINYTEXT NOT NULL,
    UserAddress TINYTEXT NOT NULL,
    UserCity TINYTEXT NOT NULL,
    UserPhone TINYTEXT NOT NULL,
    UserName VARCHAR(50) NOT NULL,
    UserPassword VARCHAR(250) NOT NULL
    
) Engine=InnoDB;

CREATE TABLE Locations(
    LocationID INT AUTO_INCREMENT PRIMARY KEY,
    Location TINYTEXT NOT NULL
) Engine = InnoDB; 

-- Table Car
 CREATE TABLE Car (
    CarID INT AUTO_INCREMENT PRIMARY KEY,
    CarBrand TINYTEXT NOT NULL,
    CarModel TINYTEXT NOT NULL,
    CarYear INT NOT NULL,
    CarPrice DOUBLE NOT NULL,
    CarStatus TINYTEXT NOT NULL,
    CarIMG TINYTEXT NOT NULL,
    LocationID INT NOT NULL,
    FOREIGN KEY (LocationID) REFERENCES Locations(LocationID) ON UPDATE CASCADE
) Engine=InnoDB;

-- Customer table
CREATE TABLE Customer (
    CustomerID INT AUTO_INCREMENT PRIMARY KEY,
    CustomerName TINYTEXT NOT NULL,
    CustomerEmail TINYTEXT NOT NULL,
    CustomerPhone TINYTEXT NOT NULL,
    CustomerAddress TINYTEXT NOT NULL
) Engine=InnoDB;

-- -- Table Order
CREATE TABLE OrderTable (    
    OrderID INT AUTO_INCREMENT PRIMARY KEY,
    OrderDate DATE NOT NULL,
    UserID INT NOT NULL,
    FOREIGN KEY (UserID) REFERENCES User(UserID) ON UPDATE CASCADE 
) Engine=InnoDB;

-- --Table Order_Details
CREATE TABLE OrderDetails (
    OrderID INT NOT NULL,
    CarID INT NOT NULL,
    OrderQyt INT NOT NULL,
    FOREIGN KEY (OrderID) REFERENCES OrderTable(OrderID) ON UPDATE CASCADE,  
    FOREIGN KEY (CarID) REFERENCES Car(CarID) ON UPDATE CASCADE 
) Engine = InnoDB;



-- Insert data into User Entity
insert into User (UserFirstName, UserLast, UserEmail, UserAddress, UserCity, UserPhone, UserName, UserPassword) values ('Cecilio', 'Brownsey', 'cbrownsey0@oakley.com', '725 Brown Park', 'Canaries', '300-901-9135','bapalacior','$2y$10$wmaTeZe138.sZAMZkn8b0eFJibQRWSHymI7veibZGlISh2QEuM8t2');
insert into User (UserFirstName, UserLast, UserEmail, UserAddress, UserCity, UserPhone, UserName, UserPassword) values ('Gloriana', 'Tuhy', 'gtuhy1@vimeo.com', '13 Ramsey Circle', 'Unidad', '350-498-1455','arturo','$2y$10$CAhLKUT2FJ27zR5MiWPhreHNb9F6INJ0pE9XETcpW3VYOp.Fo.1zC');
insert into User (UserFirstName, UserLast, UserEmail, UserAddress, UserCity, UserPhone, UserName, UserPassword) values ('Tab', 'Moncur', 'tmoncur2@devhub.com', '3698 3rd Court', 'Manoc-Manoc', '408-261-2434','root','$2y$10$Za3afTWpj66hDoQQKZKof.ttQDmHmZoVGSlgPuNlXQYNVfFX0xi6a');
insert into User (UserFirstName, UserLast, UserEmail, UserAddress, UserCity, UserPhone, UserName, UserPassword) values ('Decca', 'Bygrove', 'dbygrove3@google.fr', '29 Jenna Trail', 'Ovruch', '104-444-7525','green','$2y$10$wNAHKkO6LN3cwR/2hFp4M.p2OuUGL/glVXjbbArFOJIuRpM.HOEjK');
insert into User (UserFirstName, UserLast, UserEmail, UserAddress, UserCity, UserPhone, UserName, UserPassword) values ('Odo', 'Feavers', 'ofeavers4@slideshare.net', '95 Eggendart Avenue', 'Kundung', '251-904-6204','black','$2y$10$M88yoAKEYQyS2nep//E48ugy.Fibuvmq4OHDasNGg8rhA7ygFX0ee');

-- Insert data into Customer Entity
insert into Customer (CustomerName, CustomerEmail, CustomerPhone, CustomerAddress) values ('Daniel Roma', 'daniel@oakley.com', '353-453-3453','442 Elbow');
insert into Customer (CustomerName, CustomerEmail, CustomerPhone, CustomerAddress) values ('Paul Smith', 'paul@gmail.com', '432-342-7687','352 Normandy');
insert into Customer (CustomerName, CustomerEmail, CustomerPhone, CustomerAddress) values ('Pat Red', 'patred@oakley.com', '324-253-4664','435 Oak');

insert into Locations (Location) VALUES ('1720 W 2nd Ave, Vancouver, BC V6J 1H6');
insert into Locations (Location) VALUES ('1581 W 4th Ave, Vancouver, BC V6J 1L6');
insert into Locations (Location) VALUES ('550 Terminal Ave, Vancouver, BC V6A 0C3');

-- Insert data into Car Entity
insert into Car (CarBrand, CarModel, CarYear, CarPrice, CarStatus, CarIMG, LocationID) values ('Acura', 'CL', 1999, '2721.47', 'Available', 'acura.jpg', 1);
insert into Car (CarBrand, CarModel, CarYear, CarPrice, CarStatus, CarIMG, LocationID) values ('Kia', 'Rondo', 2010, '3596.57', 'Available', 'rondo.jpg', 2);
insert into Car (CarBrand, CarModel, CarYear, CarPrice, CarStatus, CarIMG, LocationID) values ('Chevrolet', 'Astro', 2000, '8419.62', 'Available', 'astro.jpg', 3);
insert into Car (CarBrand, CarModel, CarYear, CarPrice, CarStatus, CarIMG, LocationID) values ('MINI', 'Cooper', 2002, '3479.82', 'Sold', 'cooper.jpg', 1);
insert into Car (CarBrand, CarModel, CarYear, CarPrice, CarStatus, CarIMG, LocationID) values ('Maserati', 'Biturbo', 1985, '6641.48', 'Available', 'biturbo.jpg', 2);
insert into Car (CarBrand, CarModel, CarYear, CarPrice, CarStatus, CarIMG, LocationID) values ('Geo', 'Tracker', 1995, '9230.39', 'Available', 'tracker.jpg', 3);
insert into Car (CarBrand, CarModel, CarYear, CarPrice, CarStatus, CarIMG, LocationID) values ('Volkswagen', 'GTI', 1991, '3341.33', 'Available', 'gti.jpg', 1);
insert into Car (CarBrand, CarModel, CarYear, CarPrice, CarStatus, CarIMG, LocationID) values ('Chevrolet', '3500', 1992, '8601.89', 'Available', '3500.jpg', 2);
insert into Car (CarBrand, CarModel, CarYear, CarPrice, CarStatus, CarIMG, LocationID) values ('Scion', 'FR-S', 2013, '8603.10', 'Available', 'frs.jpg', 3);
insert into Car (CarBrand, CarModel, CarYear, CarPrice, CarStatus, CarIMG, LocationID) values ('Saab', '9000', 1999, '5289.79', 'Available', 'saab.jpg', 1);



-- Insert data into OrderTable  
INSERT INTO OrderTable(OrderDate,UserID)
    VALUES
    ("2020/01/29",1),
    ("2020/02/4",3),
    ("2020/02/17",5);

-- Insert data into OrderDetails  
INSERT INTO OrderDetails(OrderID,CarID,OrderQyt)
    VALUES
    (1,3,3),
    (2,4,5),
    (3,7,4);

-- -- SELECT
SELECT USER.UserID,
       USER.UserFirstName,
       USER.UserLast,
       User.UserCity,
       User.UserPhone,
       User.UserName,
       User.UserPassword,
       date_format(ORDERTABLE.OrderDate,"%M %D %Y") AS 'DATE',
       OrderDetails.OrderQyt,
       CAR.CarBrand
FROM USER
INNER JOIN ORDERTABLE ON USER.UserID = ORDERTABLE.UserID
INNER JOIN OrderDetails ON  ORDERTABLE.OrderID = OrderDetails.OrderID
INNER JOIN CAR ON  OrderDetails.CarID = Car.CarID
WHERE ORDERTABLE.OrderID = 3