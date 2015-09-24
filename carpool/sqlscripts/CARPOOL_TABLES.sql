CREATE TABLE Profile 
(
ProfileID int NOT NULL,
Email varchar(255) UNIQUE NOT NULL,
Password varchar (255) NOT NULL,
FirstName varchar(255) NOT NULL,
LastName varchar(255) NOT NULL,
PostalCode varchar(255) NOT NULL,
ContactNum char(11) UNIQUE NOT NULL,
DateOfBirth date NOT NULL,
CreditCardNum char(32),
CardSecurityCode char(16),
CardHolderName varchar(255),
AccBalance DECIMAL(38,2),
PRIMARY KEY (ProfileID)
);

CREATE TABLE Bookings 
(
BNO int,
PROFILEID int,
TRIPID int,
RECEIPTNO char(256),
PRIMARY KEY(BNO),
FOREIGN KEY (TRIPID) REFERENCES TRIPS(TRIPNO),
FOREIGN KEY (PROFILEID) REFERENCES PROFILE(PROFILEID)
);

CREATE TABLE Vehicle 
(
PLATENO char(16),
PROFILEID int,
MODEL varchar(256),
NUMOFSEATS int,
PRIMARY KEY(PLATENO),
FOREIGN KEY (PROFILEID) REFERENCES PROFILE(PROFILEID)
);

CREATE TABLE Trips 
(
TRIPNO int,
START_LOCATION VARCHAR(255) NOT NULL,
END_LOCATION VARCHAR(255) NOT NULL,
RIDING_COST INT NOT NULL,
SEATS_AVAILABLE INT NOT NULL,
TRIP_DATE DATE NOT NULL,
FIRSTNAME VARCHAR(255),
PROFILEID INT,
PRIMARY KEY(TRIPNO),
FOREIGN KEY (PROFILEID) REFERENCES PROFILE(PROFILEID)
);

INSERT INTO TRIPS (Email, Password, Firstname, LastName, PostalCode, ContactNum, DateOfBirth, CreditCardNum, CardSecurityCode,CardHolderName, AccBalance) 
VALUES ('lai.munkeat@gmail.com', '123', 'MunKeat', 'Lai', '145678', '912345678', '01-JAN-92', '789456159', '364', 'Lai MunKeat', 0);

INSERT INTO PROFILE (Email, Password, Firstname, LastName, PostalCode, ContactNum, DateOfBirth, CreditCardNum, CardSecurityCode,CardHolderName, AccBalance) 
VALUES ('johntan@gmail.com', '123', 'John', 'Tan', '121278', '9133414245', '01-MAR-85', '1144145369', '417', 'John Tan', 0);