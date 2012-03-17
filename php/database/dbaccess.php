<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'tntdev/newsite/content/database/connect.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'tntdev/newsite/content/utils/constants.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'tntdev/newsite/content/utils/commonfunctions.php');
	//include_once('../utils/constants.php');
	//require_once('../utils/commonfunctions.php');
	
	class DBAccess{
		public static function ManageRecord($spKey, $object){
			//$qryResult = mysql_query();
			
			$paramList = CommonFunctions::ObjectAsParams($object);
			if($object->id==0){
				$storedProc = 'INSERT INTO '.Constants::$tableArray[$spKey].$paramList;
				//echo $storedProc;
				Connection()->query($storedProc);
			}else{
				echo 'Updating...';
			}
		}
		
		public static function ManageSPRecord($spKey, $array){
			//$qryResult = mysql_query();
			try{
				$paramList = CommonFunctions::PDOParams($array);
				$storedProc = 'CALL '.Constants::$spArray[$spKey].$paramList;
				$stmt = Connection()->prepare($storedProc);
				foreach(array_keys($array) as $field){
					//echo '<br/>'.':'.$field.'=>'.$array[$field].'<br/>';
					$stmt->bindParam(':'.$field, $array[$field]);
				}
				$stmt->execute();
			} catch (PDOException $e) {
				echo 'Connection failed: ' . $e->getMessage();
			}
		}
		
		public static function ReadRecords($object){
			foreach($object as $key => $value) {
				print "$key => $value\n";
			}
		}
		
		public static function ReadTable($tableKey,$id){
			$recordArray = 0;
			if($id == 0){
				$recordArray = mysql_fetch_array(mysql_query('SELECT * FROM '.$tableKey));
			}else{
				$recordArray = mysql_fetch_array(mysql_query('SELECT * FROM '.$tableKey.' WHERE ID = '.$id));
			}
			
			return $recordArray;
		}
		
		public static function ReadDataTable($spKey, $id=0){
			$recordArray = array();
			$stmt = Connection()->prepare('CALL '.Constants::$spArray[$spKey].'(:id)');
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			
			while ($row = $stmt->fetch()) {
				array_push($recordArray, $row);
			}
			return $recordArray;
		}
	}
?>