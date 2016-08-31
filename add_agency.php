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
$agency_name = $mysqli->real_escape_string(strip_tags($_POST['agency_name']));
$agency_owner = $mysqli->real_escape_string(strip_tags($_POST['agency_owner']));
$trd_id = $mysqli->real_escape_string(strip_tags($_POST['trd_id']));
$bnk_drf = $mysqli->real_escape_string(strip_tags($_POST['bnk_drf']));
$val_frm = $mysqli->real_escape_string(strip_tags($_POST['val_frm']));
$val_to = $mysqli->real_escape_string(strip_tags($_POST['val_to']));
$tablename = "agency";
$stmt="s";
$return=false;
if ( $stmt = $mysqli->prepare("INSERT INTO " .$tablename. "  (agency_name, agency_owner,trade_id,bank_draft_no,validity_from,validity_till) VALUES ( ? , ? , ? , ? , ? , ?  )")) {

	$stmt->bind_param("ssssss", $agency_name, $agency_owner,$trd_id,$bnk_drf,$val_frm,$val_to);
    $return = $stmt->execute();
	$stmt->close();
}             
$mysqli->close();        

echo $return ? "ok" : "error";

      

