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
PostalCode varchar(255) NOT NULL,
ContactNum char(11) UNIQUE NOT NULL,
DateOfBirth date NOT NULL,
CreditCardNum varchar(32) NOT NULL,
CardSecurityCode char(3) NOT NULL,
CardHolderName varchar(255) NOT NULL,
AccBalance DECIMAL(38,2) DEFAULT 0,
PRIMARY KEY (ProfileID),
CONSTRAINT email_formatting
  CHECK(REGEXP_LIKE(Email, '^\S+@\S+$'))  -- Using RegEx, or regular expression to filter obviously invalid email
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
  CHECK (NUMOFSEATS > 0),
CONSTRAINT unique_owner_car
  UNIQUE (PLATENO, PROFILEID)
);

CREATE TABLE Trips
(
TRIPNO int NOT NULL,
START_LOCATION VARCHAR(255) NOT NULL,
END_LOCATION VARCHAR(255) NOT NULL,
RIDING_COST INT NOT NULL,
SEATS_AVAILABLE INT NOT NULL,
TRIP_DATE DATE NOT NULL,
PLATE_NUM VARCHAR(16),
PROFILEID INT,
PRIMARY KEY (TRIPNO),
CONSTRAINT vehicle_foreignkey_trips
  FOREIGN KEY (PLATE_NUM, PROFILEID) REFERENCES VEHICLE(PLATENO, PROFILEID)
  ON DELETE CASCADE,
CONSTRAINT riding_cost_check
  CHECK (RIDING_COST >= 0)
);

CREATE TABLE Bookings
(
BNO int NOT NULL,
PROFILEID int,
TRIPID int,
RECEIPTNO char(256) UNIQUE NOT NULL,
PRIMARY KEY (BNO),
CONSTRAINT tripid_foreignkey_bookings
  FOREIGN KEY (TRIPID) REFERENCES TRIPS(TRIPNO)
  ON DELETE CASCADE,
CONSTRAINT profileid_foreignkey_bookings
  FOREIGN KEY (PROFILEID) REFERENCES PROFILE(PROFILEID)
  ON DELETE CASCADE
);

/*********************************************************
 * Corresponding sequences defined for the above tables'
 * primary key
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

CREATE SEQUENCE seq_bookings
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

CREATE OR REPLACE TRIGGER trigger_bookings
  BEFORE INSERT ON Bookings
  FOR EACH ROW
BEGIN
  :new.bno := seq_bookings.nextval;
END;
/

CREATE OR REPLACE TRIGGER trigger_trips
  BEFORE INSERT ON Trips
  FOR EACH ROW
BEGIN
  :new.tripno := seq_trips.nextval;
END;
/

CREATE OR REPLACE TRIGGER trigger_booking_invoice
  BEFORE INSERT ON Bookings
  FOR EACH ROW
BEGIN
  :new.receiptno := TO_CHAR(seq_invoice.nextval, 'FM 099999999') + '-IN';
END;
/

/*********************************************************
 * Trigger: Ensure that date of birth entered is neither in
 * the future, nor too far in the past.
 *
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
