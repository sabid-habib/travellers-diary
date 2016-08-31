<?php     


/*
 * examples/mysql/loaddata.php
 * 
 * This file is part of EditableGrid.
 * http://editablegrid.net
 *
 * Copyright (c) 2011 Webismymind SPRL
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://editablegrid.net/license
 */
                              


/**
 * This script loads data from the database and returns it to the js
 *
 */
       
require_once('config.php');      
require_once('EditableGrid.php');            

/**
 * fetch_pairs is a simple method that transforms a mysqli_result object in an array.
 * It will be used to generate possible values for some columns.
*/
function fetch_pairs($mysqli,$query){
	if (!($res = $mysqli->query($query)))return FALSE;
	$rows = array();
	while ($row = $res->fetch_assoc()) {
		$first = true;
		$key = $value = null;
		foreach ($row as $val) {
			if ($first) { $key = $val; $first = false; }
			else { $value = $val; break; } 
		}
		$rows[$key] = $value;
	}
	return $rows;
}


// Database connection
$mysqli = mysqli_init();
$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5);
$mysqli->real_connect($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']); 
                    
// create a new EditableGrid object
$grid = new EditableGrid();

/* 
*  Add columns. The first argument of addColumn is the name of the field in the databse. 
*  The second argument is the label that will be displayed in the header
*/
$grid->addColumn('site_id', 'ID', 'integer', NULL, false); 
$grid->addColumn('site_name', 'Site Name', 'string');  
$grid->addColumn('site_type', 'Site Type', 'string');
$grid->addColumn('place_id', 'Place/District', 'string' , fetch_pairs($mysqli,'SELECT place_id, place_name FROM place'),true); 
$grid->addColumn('location', 'Location', 'string');  
$grid->addColumn('site_description', 'Description', 'string');
$grid->addColumn('festival', 'Festival', 'string');
$grid->addColumn('lattitude', 'Lattitude', 'string');
$grid->addColumn('longtitude', 'Longtitude', 'string');
$grid->addColumn('action', 'Action', 'html', NULL, false, 'site_id'); 
                                                                       
$result = $mysqli->query('SELECT * FROM site ');
$mysqli->close();

// send data to the browser
$grid->renderXML($result);

