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
$id = $mysqli->real_escape_string(strip_tags($_POST['id']));
$tablename = $mysqli->real_escape_string(strip_tags($_POST['tablename']));

// $receive=$mysqli->query("SELECT request_detail,agency FROM request where req_id = ".$id."");
//  $row = $receive->fetch_row();
//  $res=$row[0];
//  $agn=$row[1];


// This very generic. So this script can be used to update several tables.
// $return=false;
	if ( $stmt = $mysqli->prepare("DELETE FROM ".$tablename."  WHERE req_id = ?")) {
		$stmt->bind_param("i", $id);
		$return = $stmt->execute();
		$stmt->close();
	}

$msg='Your request ( '.$res.' )has been denied.';
  	$table='message';
 	$return=false;   
    if ( $stmt1 = $mysqli->prepare("INSERT INTO ".$table." (msg_detail,agency) VALUES ( ?, ? )")) {
	$stmt1->bind_param("si", $msg, $agn);
	$return = $stmt1->execute();
	$stmt1->close();
	} 


$mysqli->close();        

echo $stmt;
echo $return ? "ok" : "error";

      

