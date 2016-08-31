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

// This very generic. So this script can be used to update several tables.

 $receive=$mysqli->query("SELECT * FROM agency_requests where req_id = ".$id."");
 $row = $receive->fetch_row();
 $agn=$row[1];
 $owner=$row[2];
 $uname=$row[3];
 $pass=$row[4];
 $email=$row[5];
 $cont=$row[6];
 $trd=$row[7];
 $drft=$row[8];

		
	$return=false;   
    if ( $stmt1 = $mysqli->prepare("INSERT INTO agency (agency_name,agency_owner,trade_id,bank_draft_no,user_name,password,email,contact_no) VALUES ( ?, ?, ?, ?, ?, ?, ?, ? )")) {
	$stmt1->bind_param("ssssssss", $agn, $owner, $trd, $drft, $uname, $pass, $email, $cont );
	$return = $stmt1->execute();
	$stmt1->close();
	} 
	
		




 // 	$msg=$agn;
 //  	$table='message';
 // 	$return=false;   
 //    if ( $stmt1 = $mysqli->prepare("INSERT INTO ".$table." (msg_detail,agency) VALUES ( ?, ? )")) {
	// $stmt1->bind_param("si", $msg, 1);
	// $return = $stmt1->execute();
	// $stmt1->close();
	// } 

    $return=false;   
    if ( $stmt = $mysqli->prepare("DELETE FROM ".$tablename."  WHERE req_id = ?")) {
	$stmt->bind_param("i", $id);
	$return = $stmt->execute();
	$stmt->close();
	}      
$mysqli->close();        



//echo $stmt;
echo $return ? "ok" : "error";

      

