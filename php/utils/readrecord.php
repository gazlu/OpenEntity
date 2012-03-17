<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'tntdev/newsite/content/database/dbaccess.php');
	
	header('Content-type: text/xml');
	$spKey = $_REQUEST['key'];
	$id = $_REQUEST['ID'];
	$array = DBAccess::ReadDataTable($spKey, $id);
	$tableRows = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	$tableRows .= "<Tables>";
	
	foreach($array as $row){
		$cols = array_keys($row);
		for($i=0;$i<count($cols);$i++){
			if($i%2 != 0){
				unset($cols[$i]);
			}
		}
		
		$tableRows .= '<Table>';
		foreach($cols as $col){
			if(!is_numeric($col)){
				$columnName = $col;
				$tableRows .= '<'.$columnName.'>';
				$tableRows .= $row[$col];
				$tableRows .= '</'.$columnName.'>';
			}
		}
		$tableRows .= '</Table>';
	}
	$tableRows .= "</Tables>";
	echo $tableRows;
?>