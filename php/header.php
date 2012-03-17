<link rel="stylesheet" type="text/css" href="../css/cmforms.css">
<link rel="stylesheet" type="text/css" href="../css/redmond/jquery-ui.custom.css">
<link rel="stylesheet" type="text/css" href="../css/datatable.css">
<script type="text/javascript" src="../js/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="../js/formvalidation.js"></script>
<script type="text/javascript" src="../js/jquery-ui.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.form.js"></script>
<script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
<title><?php echo $pageTitle; ?></title>
<script>
	$(document).ready(function () {
        $('#genMsg').click(function () {
            $('#genMsg').fadeOut();
        });

        $('#dataform').ajaxForm({
            beforeSubmit: validate,
            success: function (data) {
                $('#genMsg').html(data);
				var _response = data.split("~");
                if (_response[0] == "1") {
                    $('#genMsg').attr('class', 'success msg');
                } else {
                    $('#genMsg').attr('class', 'error msg');
                }
                //$('#genMsg').html(_response[1]);
                $('#genMsg').fadeIn();
                $('#ID').val(0);
                RefreshDataTable(_recordKey, _recordColumns);
            }
        });
		
		$('#datatable').dataTable({
            "sPaginationType": "full_numbers",
            "bStateSave": false,
            "bScrollCollapse": false,
			"bJQueryUI": true,
        });
    });

    function validate(formData, jqForm, options) {
        return subCommonForm(0, 'main');
    }
	
    function RefreshDataTable(key, columns) {
        var _intTableSection = 0;
        var oTable = $('#datatable').dataTable();
        var _url = 'utils/datarecords.php';
        $.ajax({
            "type":"POST",
            "url":_url,
            "data":"key="+key+"&columns="+columns,
            "dataType":"html",
            "success":function(data){
                //oTable.fnClearTable();
                oTable.fnDestroy();
                document.getElementById('datatable').tBodies[0].innerHTML = data;
                $('#datatable').dataTable({
                    "sPaginationType": "full_numbers",
					"bStateSave": false,
					"bScrollCollapse": false,
					"bJQueryUI": true,
                });
            }
        });
    }

    function EditRecord(ID){
        var _url = 'utils/readrecord.php';
        $.ajax({
            "type":"POST",
            "url":_url,
            "data":"ID="+ID+"&key="+_recordKey,
            "dataType":"xml",
            "success":function(data){
				$(data)
                    .find('Table')
                    .children()
                    .each(function() {
                        var _element = this.nodeName;
                        var node = $(this);
                        if(document.getElementById(_element)!=null){
                            if(document.getElementById(_element).type == "checkbox"){
                                if(node.text()=='true')
                                    document.getElementById(_element).checked = true; 
                            }
                            document.getElementById(_element).value = node.text();
                        }
                    });
                    //RefreshDataTable(_recordKey, _recordColumns);
                }

        });
    }
</script>