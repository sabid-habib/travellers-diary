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
$transport_name = $mysqli->real_escape_string(strip_tags($_POST['transport_name']));
$transport_type = $mysqli->real_escape_string(strip_tags($_POST['transport_type']));
$from_site = $mysqli->real_escape_string(strip_tags($_POST['from_site']));
$to_site = $mysqli->real_escape_string(strip_tags($_POST['to_site']));

$tablename = "transport";
$return=false;
if ($stmt = $mysqli->prepare("INSERT INTO " .$tablename. "  (transport_name,transport_type,from_site,to_site) VALUES ( ? , ? , ? , ? )")) {

	$stmt->bind_param("ssss", $transport_name, $transport_type, $from_site, $to_site);
	$return = $stmt->execute();
	$stmt->close();
}             
$mysqli->close();        

echo $return ? "ok" : "error";

      

