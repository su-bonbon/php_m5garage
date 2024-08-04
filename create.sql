CREATE TABLE Car (
 vin varchar(45) NOT NULL,
 year INT,
 make varchar(45),
 model varchar(45),
 PRIMARY KEY (vin));
CREATE TABLE Customer (
 customerID INT NOT NULL,
 fname varchar(45),
 lname varchar(45),
 `phoneNum` varchar(45),
 email varchar(45),
 PRIMARY KEY (customerID));
CREATE TABLE Employee (
 employeeID INT NOT NULL,
 fname varchar(45),
 lname varchar(45),
 `phoneNum` varchar(45),
 email varchar(45),
 PRIMARY KEY (employeeID));
CREATE TABLE Mechanic (
 employeeID INT NOT NULL,
 yearsOfExperience INT,
 PRIMARY KEY (employeeID),
 FOREIGN KEY (employeeID) REFERENCES Employee (employeeID));
CREATE TABLE Part (
 partID INT NOT NULL,
 partName varchar(45),
 description text,
 PRIMARY KEY (partID));
CREATE TABLE Supplier (
 supplierID INT NOT NULL,
 supplierName varchar(45),
 PRIMARY KEY (supplierID));
 CREATE TABLE Payment (
 paymentID INT NOT NULL,
 paymentDate DATETIME,
 amount DECIMAL(10,2),
 PRIMARY KEY (paymentID));
 CREATE TABLE Works_On (
 employeeID INT NOT NULL,
 vin varchar(45) NOT NULL,
 repairDate DATETIME,
 PRIMARY KEY (employeeID, vin),
 FOREIGN KEY (employeeID) REFERENCES Employee (employeeID),
 FOREIGN KEY (vin) REFERENCES Car (vin));
 CREATE TABLE Supplies (
 supplierID INT NOT NULL,
 partID INT NOT NULL,
 PRIMARY KEY (supplierID, partID),
 FOREIGN KEY (supplierID) REFERENCES Supplier (supplierID),
 FOREIGN KEY (partID) REFERENCES Part (partID));
 CREATE TABLE Needs_Part (
 vin varchar(45) NOT NULL,
 partID INT NOT NULL,
 PRIMARY KEY (vin, partID),
 FOREIGN KEY (vin) REFERENCES Car (vin),
 FOREIGN KEY (partID) REFERENCES Part (partID));
CREATE TABLE Pays (
 paymentID INT NOT NULL,
 customerID INT NOT NULL,
 PRIMARY KEY (paymentID, customerID),
 FOREIGN KEY (paymentID) REFERENCES Payment (paymentID),
 FOREIGN KEY (customerID) REFERENCES Customer (customerID));
 CREATE TABLE Provides (
 vin varchar(45) NOT NULL,
 customerID INT NOT NULL,
 PRIMARY KEY (vin, customerID),
 FOREIGN KEY (vin) REFERENCES Car (vin),
 FOREIGN KEY (customerID) REFERENCES Customer (customerID));
 CREATE TABLE Orders_Part (
 orderNum INT NOT NULL,
 employeeID INT NOT NULL,
 partID INT NOT NULL,
 PRIMARY KEY (orderNum),
 FOREIGN KEY (employeeID) REFERENCES Employee (employeeID),
 FOREIGN KEY (partID) REFERENCES Part (partID));
