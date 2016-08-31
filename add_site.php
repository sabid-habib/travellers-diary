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
$site_name = $mysqli->real_escape_string(strip_tags($_POST['site_name']));
$site_type = $mysqli->real_escape_string(strip_tags($_POST['site_type']));
$location = $mysqli->real_escape_string(strip_tags($_POST['location']));
$tablename = "site";
$return=false;
if ($stmt = $mysqli->prepare("INSERT INTO " .$tablename. "  (site_name, site_type,location) VALUES ( ? , ? , ? )")) {

	$stmt->bind_param("sss", $site_name, $site_type, $location);
	$return = $stmt->execute();
	$stmt->close();
}             
$mysqli->close();        

echo $return ? "ok" : "error";

      

