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

 $receive=$mysqli->query("SELECT request_detail,agency FROM request where req_id = ".$id."");
 $row = $receive->fetch_row();
 $res=$row[0];
 $agn=$row[1];

  

if(substr($res,0,4) === 'site'){
$table='site';
	$flag=0;
	$name='';
	$type='';
	$place=0;
	$location='';
	for( $i = 0; $i <= strlen($res); $i++ ) {
	    $char = substr( $res, $i, 1 );
	    if($char==='~'){
	    	$flag=$flag+1;
	    }
	    else if($flag==1){
	    	$name.=$char;
	    }
	    else if($flag==2){
	    	$place=$place+(int)$char;
	    }
	    else if($flag==4){
	    	$type=$type.$char;
	    }
	    else if($flag==3){
	    	$location=$location.$char;
	    }
	}
	$return=false;
	if ($stmt = $mysqli->prepare("INSERT INTO " .$table. "  (site_name,site_type,location) VALUES ( ? , ? , ? )")) {

		$stmt->bind_param("sss", $name, $type, $location);
		$return = $stmt->execute();
		$stmt->close();
	} 

}



else if(substr($res,0,9) === 'transport'){
	$table='transport';
	$flag=0;
	$name='';
	$type='';
	$start=0;
	$end=0;
	for( $i = 0; $i <= strlen($res); $i++ ) {
	    $char = substr( $res, $i, 1 );
	    if($char==='~'){
	    	$flag=$flag+1;
	    }
	    else if($flag==1){
	    	$name.=$char;
	    }
	    else if($flag==3){
	    	$start=$start+(int)$char;
	    }
	    else if($flag==2){
	    	$type=$type.$char;
	    }
	    else if($flag==4){
	    	$end=$end+(int)$char;
	    }
	    

	}
	$return=false;
	if ($stmt = $mysqli->prepare("INSERT INTO " .$table. "  (transport_name,transport_type,from_site,to_site) VALUES ( ? , ? , ? , ? )")) {

		$stmt->bind_param("ssss", $name, $type, $start, $end);
		$return = $stmt->execute();
		$stmt->close();
	} 
}


 else if(substr($res,0,9) === 'resturant'){
	$table='resturant';
	$flag=0;
	$name='';
	$type='';
	$site=0;
	$contact='';
	for( $i = 0; $i <= strlen($res); $i++ ) {
	    $char = substr( $res, $i, 1 );
	    if($char==='~'){
	    	$flag=$flag+1;
	    }
	    else if($flag==1){
	    	$name.=$char;
	    }
	    else if($flag==2){
	    	$site=$site+(int)$char;
	    }
	    else if($flag==3){
	    	$type=$type.$char;
	    }
	    else if($flag==4){
	    	$contact=$contact.$char;
	    }
	}
	$return=false;
	if ($stmt = $mysqli->prepare("INSERT INTO " .$table. "  (rest_name,rest_type,contact_no) VALUES ( ? , ? , ? )")) {

		$stmt->bind_param("sss", $name, $type, $contact);
		$return = $stmt->execute();
		$stmt->close();
	}
 }


else if(substr($res,0,12) === 'accomodation'){
	$table='accomodation';
	$flag=0;
	$name='';
	$type='';
	$site=0;
	$contact='';
	for( $i = 0; $i <= strlen($res); $i++ ) {
	    $char = substr( $res, $i, 1 );
	    if($char==='~'){
	    	$flag=$flag+1;
	    }
	    else if($flag==1){
	    	$name.=$char;
	    }
	    else if($flag==2){
	    	$site=$site+(int)$char;
	    }
	    else if($flag==3){
	    	$type=$type.$char;
	    }
	    else if($flag==4){
	    	$contact=$contact.$char;
	    }
	}
	$return=false;
	if ($stmt = $mysqli->prepare("INSERT INTO " .$table. "  (accom_name,site_id,accom_type,contact_no) VALUES ( ? , ?, ? , ? )")) {

		$stmt->bind_param("siss", $name,$site,$type, $contact);
		$return = $stmt->execute();
		$stmt->close();
	}
 }



 	$msg='Your request ( '.$res.' )has been approved.';
  	$table='message';
 	$return=false;   
    if ( $stmt1 = $mysqli->prepare("INSERT INTO ".$table." (msg_detail,agency) VALUES ( ?, ? )")) {
	$stmt1->bind_param("si", $msg, $agn);
	$return = $stmt1->execute();
	$stmt1->close();
	} 

    $return=false;   
    if ( $stmt = $mysqli->prepare("DELETE FROM ".$tablename."  WHERE req_id = ?")) {
	$stmt->bind_param("i", $id);
	$return = $stmt->execute();
	$stmt->close();
	}      
$mysqli->close();        



//echo $stmt;
echo $return ? "ok" : "error";

      

