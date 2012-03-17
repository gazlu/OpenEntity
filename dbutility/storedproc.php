<?php
	include_once('connect.php');
	
	$tableName = $_GET['table'];
	
	$result = mysql_query('select * from `'.$tableName.'`');
	
	$paramList = '(<br/>';
	
	$tableIdField = mysql_field_name($result, 0);
	$insertFields = "(";
	$insertValues = "(";
	$updateList = "";
	for($i=0;$i< mysql_num_fields($result);$i++){
	
	$fieldName = mysql_field_name($result, $i);
	$fieldType = mysql_field_type($result, $i);
	
	if($i>0){
	$insertFields = $insertFields.$fieldName.',';
	$insertValues = $insertValues.' _'.$fieldName.',';
	}
	$updateList = $updateList.' '.$fieldName.'='.' _'.$fieldName.',';
	
	$fieldFormat = '';
	$fieldFormat = $fieldFormat.' _'.$fieldName;
	$fieldFormat = $fieldFormat.' '.$fieldType;
	$fieldFormat = $fieldFormat.' '.',<br/>';
	
	$paramList = $paramList.' '.$fieldFormat;
	}
	
	$insertFields = $insertFields.')';
	$insertValues = $insertValues.')';
	$updateList = $updateList.')';
	$paramList = $paramList.')<br/>';
	
	$paramList = str_replace('int','int(11)',$paramList);
	$paramList = str_replace('string','text',$paramList);
	
	$paramList = str_replace(',)',')',$paramList);
	
	$insertFields = str_replace(',)',')',$insertFields);
	
	$insertValues = str_replace(',)',')',$insertValues);
	
	$updateList = str_replace(',)','',$updateList);
	
	$spText = '<br/><br/>DELIMITER $$<br/>';
	
	$spText = $spText.' <br/>DROP PROCEDURE IF EXISTS Manage'.$tableName.' $$<br/>';
	$spText = $spText.' <br/>CREATE PROCEDURE Manage'.$tableName.'<br/>';
	$spText = $spText.$paramList;
	$spText = $spText.' <br/>BEGIN<br/>';
	$spText = $spText.' <br/>IF _'.mysql_field_name($result, 0).' = 0 THEN<br/>';
	$spText = $spText.' INSERT INTO '.$tableName.' '.$insertFields.' VALUES '.$insertValues.';';
	$spText = $spText.'<br/> ELSE<br/>';
	$spText = $spText.'<br/> UPDATE '.$tableName.' SET '.$updateList.' WHERE '.$tableIdField.'=_'.$tableIdField.';';
	$spText = $spText.' <br/>END IF;<br/>';
	$spText = $spText.' <br/>END $$<br/>';
	
	$spText = $spText.' <br/>DELIMITER ;<br/>';
	echo '<br/><strong>Insert/Update stored Procedure: </strong><br/>';
	echo $spText;
	//mysql_num_rows($result);
	//echo mysql_num_fields($result);
	//echo mysql_field_name($result,0);
	$spText='';
	echo '<br/><br/><br/><br/>';
	$spText = '<br/><br/>DELIMITER $$<br/>';
	$spText = $spText.' <br/>DROP PROCEDURE IF EXISTS Read'.$tableName.' $$<br/>';
	$spText = $spText.' <br/>CREATE PROCEDURE Read'.$tableName.'<br/>';
	$spText = $spText.'(_id int(11))';
	$spText = $spText.' <br/>BEGIN<br/>';
	$spText = $spText.' <br/>IF _id = 0 THEN<br/>';
	$spText = $spText.' SELECT * FROM '.$tableName.';';
	$spText = $spText.'<br/> ELSE<br/>';
	$spText = $spText.' SELECT * FROM '.$tableName.' WHERE ID = _ID;';
	$spText = $spText.' <br/>END IF;<br/>';
	$spText = $spText.' <br/>END $$<br/>';
	$spText = $spText.' <br/>DELIMITER ;<br/>';
	
	echo '<br/><strong>Select All/specific record stored Procedure: </strong><br/>';
	echo $spText;
?>