<?php
ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
// include file config
require '../config/config.inc.php';

// sql file to execute
$sql_execute = 'Run.sql';

// create a new database connection
$mysqli      = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$mysqli->set_charset('utf8');

// Check if any error occurred
if (mysqli_connect_errno()){
    die('An error occurred while connecting to the database');
}
$query = file_get_contents($sql_execute);
/* execute multi query */
@mysqli_multi_query($mysqli, $query);
do {
    if ($result = mysqli_store_result($mysqli)) {
        mysqli_free_result($result);
            header('location: ../index.php');
        }
    } while (mysqli_next_result($mysqli));
    if (mysqli_error($mysqli)) {
         header('location: setup-config.php');
    }
