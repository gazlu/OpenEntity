<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'tntdev/newsite/content/database/dbaccess.php');
	
	class HtmlUtils{
		public static function DataTableRows($spKey, $columnsList){
			$array = DBAccess::ReadDataTable($spKey, 0);
			$columns = explode(',', $columnsList);
			$tableRows = "<script>var _recordKey = '".$spKey."'; _recordColumns = '".$columnsList."';</script>";
			foreach($array as $row){
				$tableRows .= '<tr>';
				foreach($columns as $col){
					$tableRows .= '<td>'.$row[$col].'</td>';
				}
				$tableRows .= '<td>
							  	<img onclick="javascript:EditRecord('.$row['id'].')" src="../images/manage.png" alt="Edit" />
								 &nbsp;&nbsp; 
								<img onclick="javascript:Archive('.$row['id'].')" src="../images/remove.png" alt="Edit" />
							  </td>';
				$tableRows .= '</tr>';
			}
			return $tableRows;
		}
	}
?>