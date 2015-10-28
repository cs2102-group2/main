/*********************************************************
 * SQL: Data Definition Language (DDL)
 *
 * Use the following to delete (note that the order of
 deletion are in reverse order w.r.t to CARPOOL_TABLES.sql)
 *********************************************************/
DROP VIEW SearchQuery;
DROP VIEW PendingRide;

DROP TRIGGER trigger_birth_date_checks;
DROP TRIGGER trigger_tripdate_check;

DROP TRIGGER trigger_profile;
DROP TRIGGER trigger_bookings;
DROP TRIGGER trigger_trips;
DROP TRIGGER trigger_booking_invoice;

DROP SEQUENCE seq_profile;
DROP SEQUENCE seq_bookings;
DROP SEQUENCE seq_trips;
DROP SEQUENCE seq_invoice;

DROP TABLE Bookings;
DROP TABLE Trips;
DROP TABLE Vehicle;
DROP TABLE Profile;
