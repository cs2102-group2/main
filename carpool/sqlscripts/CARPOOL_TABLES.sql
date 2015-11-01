/*********************************************************
 * SQL: Data Definition Language (DDL)
 *********************************************************/
CREATE TABLE Profile
(
ProfileID int NOT NULL,
Email varchar(255) UNIQUE NOT NULL,
Password varchar (255) NOT NULL,
FirstName varchar(255) NOT NULL,
LastName varchar(255) NOT NULL,
PostalCode int NOT NULL,
ContactNum int UNIQUE NOT NULL,
DateOfBirth date NOT NULL,
CreditCardNum int NOT NULL,
CardSecurityCode int NOT NULL,
CardHolderName varchar(255) NOT NULL,
AccBalance DECIMAL(38,2) DEFAULT 0,
Admin number(1) DEFAULT 0,
PRIMARY KEY (ProfileID),
CONSTRAINT email_formatting -- Using RegEx to filter obviously invalid email
  CHECK(REGEXP_LIKE(Email, '^\S+@\S+$')),
CONSTRAINT accbalance_check
  CHECK(AccBalance >= 0),
CONSTRAINT admin_boolean --SQL do not support boolean type: 0 = false, 1 = true
  CHECK(Admin IN (0, 1))
);

CREATE TABLE Vehicle
(
PLATENO varchar(16) NOT NULL,
PROFILEID int,
MODEL varchar(255),
NUMOFSEATS int NOT NULL,
PRIMARY KEY (PLATENO),
CONSTRAINT profileid_foreignkey
  FOREIGN KEY (PROFILEID) REFERENCES PROFILE(PROFILEID)
  ON DELETE CASCADE,
CONSTRAINT initial_seat_number
  CHECK (NUMOFSEATS > 0)
);

CREATE TABLE Trips
(
TRIPNO int NOT NULL,
START_LOCATION VARCHAR(255) NOT NULL,
END_LOCATION VARCHAR(255) NOT NULL,
RIDING_COST INT NOT NULL,
SEATS_AVAILABLE INT NOT NULL,
TRIP_DATE DATE NOT NULL,
PLATENO VARCHAR(16),
PRIMARY KEY (TRIPNO),
CONSTRAINT vehicle_foreignkey_trips
  FOREIGN KEY (PLATENO) REFERENCES VEHICLE(PLATENO)
  ON DELETE CASCADE,
CONSTRAINT riding_cost_check
  CHECK (RIDING_COST >= 0),
CONSTRAINT seats_available_check
  CHECK (SEATS_AVAILABLE >= 0)
);

CREATE TABLE Bookings
(
PROFILEID int,
TRIPID int,
RECEIPTNO varchar(16) UNIQUE NOT NULL,
PRIMARY KEY (PROFILEID, TRIPID),
CONSTRAINT tripid_foreignkey_bookings
  FOREIGN KEY (TRIPID) REFERENCES TRIPS(TRIPNO)
  ON DELETE CASCADE,
CONSTRAINT profileid_foreignkey_bookings
  FOREIGN KEY (PROFILEID) REFERENCES PROFILE(PROFILEID)
  ON DELETE CASCADE
);

/*********************************************************
 * Corresponding sequences defined for the above tables' primary key
 *********************************************************/
CREATE SEQUENCE seq_profile
MINVALUE 1
START WITH 1
INCREMENT BY 1
NOMAXVALUE
NOCYCLE
CACHE 10;

CREATE SEQUENCE seq_trips
MINVALUE 1
START WITH 1
INCREMENT BY 1
NOMAXVALUE
NOCYCLE
CACHE 10;

CREATE SEQUENCE seq_invoice
MINVALUE 1
START WITH 1
INCREMENT BY 1
NOMAXVALUE
NOCYCLE
CACHE 10;

/*********************************************************
 * Triggers defined to allow automatic input of
 * primary keys in the table above
 *
 * Note: Forward slash on a new line after each trigger
 * executes the command in buffer
 * Source: http://stackoverflow.com/questions/7233210/is-there-a-way-to-create-multiple-triggers-in-one-script
 *********************************************************/
CREATE OR REPLACE TRIGGER trigger_profile
  BEFORE INSERT ON Profile
  FOR EACH ROW
BEGIN
  :new.profileid := seq_profile.nextval;
END;
/

CREATE OR REPLACE TRIGGER trigger_trips
  BEFORE INSERT ON Trips
  FOR EACH ROW
BEGIN
  :new.tripno := seq_trips.nextval;
END;
/

CREATE OR REPLACE TRIGGER trigger_booking
  BEFORE INSERT ON Bookings
  FOR EACH ROW
BEGIN
  :new.receiptno := TO_CHAR(seq_invoice.nextval, 'FM099999999') || '-IN';
END;
/

/*********************************************************
 * Trigger as constraints

 * Note: CHECK is not used as CHECK constraints must be deterministic.
 * As SYSDATE is inherently non-deterministic, TRIGGER are used instead.
 * Source: http://stackoverflow.com/questions/8424900/check-constraint-on-date-of-birth
 *
 * Note: Error numbers are defined between -20,000 and -20,999.
 *********************************************************/
CREATE OR REPLACE TRIGGER trigger_birth_date_checks
  BEFORE INSERT OR UPDATE ON Profile
  FOR EACH ROW
DECLARE
  yearsInMonths CONSTANT INTEGER := 216;  -- 18 years calculated as months
BEGIN
  IF ( :new.dateofbirth < DATE '1900-01-01' OR :new.dateofbirth > SYSDATE ) THEN
    RAISE_APPLICATION_ERROR( -20001, 'User birthdate must be later than Jan 1, 1900 and earlier than today!' );
  ELSIF ( ADD_MONTHS( :new.dateofbirth, yearsInMonths) > TRUNC(SYSDATE)) THEN
    RAISE_APPLICATION_ERROR(-20002,'User is under 18!');
  END IF;
END;
/

CREATE OR REPLACE TRIGGER trigger_tripdate_check
  BEFORE INSERT OR UPDATE ON Trips
  FOR EACH ROW
BEGIN
  IF ( :new.trip_date < SYSDATE ) THEN
    RAISE_APPLICATION_ERROR( -20003, 'Trip date cannot be in the past!' );
  END IF;
END;
/

/*********************************************************
 * Views
 *********************************************************/
CREATE OR REPLACE VIEW SearchQuery AS
  SELECT T.TripNo AS TripNo,
         T.Start_Location AS Departure,
         T.End_Location AS Destination,
         T.Riding_Cost AS Cost,
         T.Seats_Available AS Seats_Available,
         TO_CHAR(T.Trip_Date, 'DD-Mon-YY') AS Trip_Date,
         TO_CHAR(T.Trip_Date, 'HH24:MI') AS Trip_Time,
         (P.FirstName || ' ' || P.LastName) AS Driver
  FROM Trips T, Vehicle V, Profile P
  WHERE T.PlateNo = V.PlateNo AND
        V.ProfileID = P.ProfileID;

CREATE OR REPLACE VIEW PendingRide AS
  SELECT Driver.ProfileID AS Driver_ID,
         (Driver.FirstName || ' ' || Driver.LastName) AS Driver,
         Driver.ContactNum AS Driver_Contact,
         Passenger.ProfileID AS Passenger_ID,
         (Passenger.FirstName || ' ' || Passenger.LastName) AS Passenger,
         Passenger.ContactNum AS Passenger_Contact,
         T.TripNo AS TripNo, T.Start_Location AS Departure,
         T.End_Location AS Destination,
         T.Riding_Cost AS Cost,
         T.Seats_Available AS Seats_Available,
         TO_CHAR(T.Trip_Date, 'DD-Mon-YY') AS Trip_Date,
         TO_CHAR(T.Trip_Date, 'HH24:MI') AS Trip_Time,
         V.PlateNo AS PlateNo,
         V.Model AS Model
  FROM Bookings B, Trips T, Profile Passenger, Profile Driver, Vehicle V
  WHERE T.PlateNo = V.PlateNo AND
        V.ProfileID = Driver.ProfileID AND
        T.TripNo = B.TripID AND
        B.ProfileID = Passenger.ProfileID;

/*********************************************************
 * Stored Procedure
 *********************************************************/
CREATE OR REPLACE PROCEDURE BookingTransaction (PassengerID IN INT, TripNumber IN INT) IS
      PassengerAcctBalance FLOAT;
      DriverID INT;
      SeatsAvail INT;
      TripCost INT;
    BEGIN
      --Retrive values
      SELECT AccBalance INTO PassengerAcctBalance
        FROM Profile WHERE ProfileID = PassengerID;
      SELECT P.ProfileID, T.Seats_Available, T.Riding_Cost INTO DriverID, SeatsAvail, TripCost
        FROM Trips T, Vehicle V, Profile P
        WHERE T.TripNo = TripNumber AND
              T.PlateNo = V.PlateNo AND
              V.ProfileID = P.ProfileID;
      --Set Savepoint
      SAVEPOINT Origin;
      -- Deduct amount from account balance
      UPDATE Profile
        SET AccBalance = (PassengerAcctBalance - TripCost)
        WHERE ProfileID = PassengerID;
      -- Decrement of seats_available in trip
      UPDATE Trips
        SET Seats_Available = (SeatsAvail - 1)
        WHERE TripNo = TripNumber;
      -- Increase account balance of driver
      UPDATE Profile
        SET AccBalance = (PassengerAcctBalance + TripCost)
        WHERE ProfileID = DriverID;
      -- Create entry in booking table
      INSERT INTO Bookings(ProfileID, TripID) VALUES (PassengerID, TripNumber);
    EXCEPTION
      WHEN OTHERS THEN
        -- We roll back to the savepoint.
        ROLLBACK TO Origin;
        RAISE_APPLICATION_ERROR( -21000, 'Booking trip failed...' );
    END;
/
