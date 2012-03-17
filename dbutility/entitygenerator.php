<?php
	include_once('connect.php');
	$tableName = $_GET['table'];
	
	$result = mysql_query('select * from `'.$tableName.'`');
	
	$entityResult = '&lt;?php';
	
	$entityResult .= '<br/> class '.$tableName.' extends BaseEntity{<br/>';
	
	for($i=0;$i< mysql_num_fields($result);$i++){
		$fieldName = mysql_field_name($result, $i);
		$entityResult .= '<br/>var $'.$fieldName.';';
	}
	
	$entityResult .= '<br/>}<br/>?>';
	echo $entityResult;
?>