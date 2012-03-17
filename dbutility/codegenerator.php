<?php
	include_once('connect.php');
	
	$exclude = array('id', 'isArchived', 'isActive', 'createdOn', 'createdBy', 'modifiedOn', 'modifiedBy');
	
	$tableName = $_GET['table'];
	
	$form = '<body>
			<h2>
				{You Module Size}
			</h2>
			<div id="stylized" class="myform">
			<div id="container">
				<h1>
					Manage {title}
				</h1>
					<div id="genMsg" style="color:#FF0000; font-weight:bold;padding:8px; text-align:center"></div>'
			."<form class=\"basic\" action=\"repo/".$tableName."repo.php\" method=\"post\" onSubmit=\"return subCommonForm(0, 'main')\" name=\"dataform\" id=\"dataform\" enctype=\"multipart/form-data\">"
                        //Control Fieldset
						."<div class=\"inner-form\">"
                        ."\n<dl>"
                        ."\n<table width=\"100%\">"
                        ."{0}"
                        ."\n</table>"
                        ."\n</dl>"
                        ."\n</div>"
                        //Control Buttons
                        ."<dd style=\"width:90%; text-align:right;\">"
						."<input class=\"button\" type=\"submit\" value=\"Save\" />"
						."<input class=\"button altbutton\" type=\"reset\" onClick=\"refreshParent();\" value=\"Cancel\" />"
						."</dd>"
                        ."\n</form>"
						.'</div>
						</div>
						</body>';

        $dlddCode = "\n<dt>"
                           ."\n<label for=\"{field}\">"
                           ."\n{field}"
                           ."\n</label>"
                           ."\n</dt>"
                           ."\n<dd>"
                           ."\n{control}" //Control
                           ."\n<small>{field}</small>"
                           ."\n</dd>";

        $textInput = "<input type=\"text\" id=\"{0}\" req=\"true\" valsection=\"main\" valdata=\"{1}\" name=\"{0}\" class=\"medium\" />";
        $hiddenInput = "<input type=\"hidden\" id=\"{0}\" name=\"{0}\" />";
        $hiddenIDInput = "<input type=\"hidden\" value=\"0\" id=\"ID\" name=\"ID\" />";
        $hiddenTrashInput = "<input type=\"hidden\" value=\"0\" id=\"trasht\" name=\"trasht\" />";
	
	$result = mysql_query('select * from `'.$tableName.'`');
	
	$code = '';
	
	$rowCount = 0;
	for($i=0;$i< mysql_num_fields($result);$i++){
		$fieldName = mysql_field_name($result, $i);
		if (!array_search($fieldName, $exclude)){
			$input = str_replace("{0}", $fieldName, $textInput);
			$fields = str_replace("{field}", $fieldName, $dlddCode);
			$fields = str_replace("{control}", $input, $fields);
			
			$code .= $fields;
			
			/*if ($rowCount % 2 == 0){
				$code .= "<tr>" . $fields;
			}else{
				$code .= $fields . "</tr>";
			}*/
			
			$rowCount++;
		}
	}
	$form = str_replace('{0}', $code, $form);
	$form = str_replace('{title}', $tableName, $form);
	echo $form;
?>