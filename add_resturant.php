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
$rest_name = $mysqli->real_escape_string(strip_tags($_POST['rest_name']));
$rest_type = $mysqli->real_escape_string(strip_tags($_POST['rest_type']));
$contact_no = $mysqli->real_escape_string(strip_tags($_POST['contact_no']));
$tablename = "resturant";
$return=false;
if ($stmt = $mysqli->prepare("INSERT INTO " .$tablename. "  (rest_name, rest_type,contact_no,site_id,min_price,max_price) VALUES ( ? , ? , ?, 1,0,0)")) {

	$stmt->bind_param("sss", $rest_name, $rest_type, $contact_no);
	$return = $stmt->execute();
	$stmt->close();
}             
$mysqli->close();        

echo $return ? "ok" : "error";

      

