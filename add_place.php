<?php
 
/*
 * 
 * http://editablegrid.net
 *
 * Copyright (c) 2011 Webismymind SPRL
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://editablegrid.net/license
 */
      
require_once('config.php');         

// Database connection                                   
$mysqli = mysqli_init();
$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5);
$mysqli->real_connect($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']); 

// Get all parameter provided by the javascript
$place_name = $mysqli->real_escape_string(strip_tags($_POST['place_name']));
$division = $mysqli->real_escape_string(strip_tags($_POST['division']));
$weather = $mysqli->real_escape_string(strip_tags($_POST['weather']));
$tablename = "place";
$return=false;
if ($stmt = $mysqli->prepare("INSERT INTO " .$tablename. "  (place_name, division,weather) VALUES ( ? , ? , ? )")) {

	$stmt->bind_param("sss", $place_name, $division, $weather);
	$return = $stmt->execute();
	$stmt->close();
}             
$mysqli->close();        

echo $return ? "ok" : "error";

      

