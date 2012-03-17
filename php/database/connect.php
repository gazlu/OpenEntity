<?php
	function Connection(){
		$mysqli = $dbh = new PDO('mysql:host=localhost;dbname=tntcm', 'root', '');
		return $mysqli;
	}
?>