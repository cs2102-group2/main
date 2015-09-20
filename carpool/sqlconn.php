<?php
/**
 * Created by PhpStorm.
 * User: Bobby
 * Date: 20/9/2015
 * Time: 8:42 PM
 */

$username = 'nusnet id';
$password = 'nusnet password';

putenv('ORACLE_HOME=/oraclient');

$dbh = ocilogon($username, $password, ' (DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = sid3.comp.nus.edu.sg)(PORT = 1521)))
    (CONNECT_DATA = (SERVICE_NAME = sid3.comp.nus.edu.sg)))');

// Check connection
if(isset($dbh)) {
    echo 'Connected to Database successfully';
}

?>