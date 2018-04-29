<?php
/**
 * @return mysqli connection
 */

function get_dbc() {
    $dbc = mysqli_connect("127.0.0.1", "root", "root", "catalog", "8889");
    if(!$dbc) die("Unable to connect to MySQL: " . mysqli_error($dbc));
    return $dbc;
}

/**
 * create connection variable and use it everywhere in this application
 */

$db = get_dbc();