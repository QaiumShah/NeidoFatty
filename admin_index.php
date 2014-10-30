<?php 
	/***Begin the session***/


	require_once('resources/nfsite_config.php');

	


	include('admin_header.php');

	$id = $_REQUEST['page']; 
	switch($id) { 
	default: include('main.php'); 
	break; 
	case "POPULAR": include('popular.php'); 
	break; 
	case "LATEST": include('latest.php');
	break; 
	} 

	

?>



<?php include('footer.php');?>