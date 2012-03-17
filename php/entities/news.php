<?php
	require_once('baseentity.php');
	
	class News extends BaseEntity{
		var $newstitle;
		var $newsHtml;
		var $newsDate;
		var $newsTillDate;
	}
?>