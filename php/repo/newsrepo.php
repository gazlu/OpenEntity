<?php
	require_once('../entities/news.php');
	require_once('../database/dbaccess.php');
	require_once('../utils/commonfunctions.php');
	
	$newsObject = CommonFunctions::ProcessPostData('News');
	$array = CommonFunctions::ObjectAsArray($newsObject);
	
	//You can add your own Parameters to Stored Proc for any Business Logic
	//$array['CustomParam'] = 'Sample';
	
	DBAccess::ManageSPRecord('AddUpdateNews', $array);
	
	echo 'News Added Successfully!';
?>