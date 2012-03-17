<?php
	class CommonFunctions{
		public static function ObjectAsQueryParams($object){
			$params = '(';
			$values = '(';
			foreach($object as $key => $value) {
				$params .= $key.',';
				$values .= "'".$value."',";
			}
			$params = rtrim($params,',');
			$params .= ')';
			
			$values = rtrim($values,',');
			$values .= ')';
			
			return $params.' VALUES '.$values;
		}
		
		public static function ObjectAsArray($object){
			$array = array();
			foreach($object as $key => $value) {
				$array['_'.$key]= $value;
			}
			return $array;
		}
		
		public static function ObjectValues($object){
			$params = '(';
			foreach($object as $key => $value) {
				//$params .= $key.',';
				$params .= '?,';
			}
			$params = rtrim($params,',');
			$params .= ')';
			
			return $params;
		}
		
		public static function ParamCounter($count){
			$params = '(';
			for($i=0;$i<$count;$i++) {
				$params .= '?,';
			}
			$params = rtrim($params,',');
			$params .= ')';
			
			return $params;
		}
		
		public static function PDOParams($array){
			$keys = array_keys($array);
			$params = '(';
			for($i=0;$i<count($keys);$i++) {
				$params .= ':'.$keys[$i].',';
			}
			$params = rtrim($params,',');
			$params .= ')';
			
			return $params;
		}

		/*  ProcessPostData($objectName)
		/*  
		/*/ 
		public static function ProcessPostData($objectName){
			$obj = new $objectName();
			foreach($_POST as $key => $value) {
				$obj->$key = $value;
			}
			return $obj;
		}
	}
?>