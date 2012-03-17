<?php
	class BaseEntity{
		function __construct(){
			$this->createdOn = date('Y-m-d');
			$this->modifiedOn = date('Y-m-d');
		}
		var $id = NULL;
		var $isArchived = 0;
		var $isActive = 1;
		var $createdOn;
		var $createdBy=2;
		var $modifiedOn;
		var $modifiedBy = 0;
	}
?>