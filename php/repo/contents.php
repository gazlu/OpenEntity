<?php
	require_once('../database/dbaccess.php');
	
	echo '<table width="100%">';
	function LoadContents($content){
		switch($content){
			case '1':
				{
					//News
					//$cl = new ContentLoader();
					//echo $cl->LoadNews(0);
					break;
				}
			case '2':
				{
					//customers
					break;
				}
			case '3':
				{
					//Testimonials
					break;
				}
			case '4':
				{
					//Case Studies
					break;
				}
		}
		echo '</table>';
	}
	
	class ContentLoader{
		function LoadNews($id = 0){
			$array = DBAccess::ReadTable('tblTnTNews', $id);
			$rows = '';
			foreach($array as $row){
				$rows .= '<tr>';
				$rows .= '<td>'.$row['newstitle'].'</td>';
				$rows .= '<td>'.$row['newsHtml'].'</td>';
				$rows .= '<td>'.$row['newsDate'].'</td>';
				$rows .= '<td>'.$row['newsTillDate'].'</td>';
				$rows .= '</tr>';
			}
			return $rows;
		}
	}
?>