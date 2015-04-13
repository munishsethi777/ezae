<?include("sessioncheck.php");?>

<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administration - Easy Assessment Engine</title>
<?include "ScriptsInclude.php"?> 
<script type="text/javascript">
		 var FIELD_NAME_MESSAGE = "Invalid Field Name in "
		 var DUPLICATE_FIELD_NAME_MESSAGE = "Duplicate Field Name : - "
		 var FIELD_GRID_ID = "#learnersFieldsGrid";
		 var fieldNames = [];
        $(document).ready(function (){
           
            $("#wform").steps({
                bodyTag: "div",
                transitionEffect: "slide",
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // Always allow going backward even if the current step contains invalid fields!
                      
                    if(newIndex == 2){
                        alert(newIndex);
                        populatedFields();   
                     }
                    if (currentIndex < newIndex && currentIndex == 1)
					{
                        return validateFieldNames();
                    }else{
						return true;
					}
                     
                },
                
                onFinished: function (event, currentIndex)
                {
                     location.href= ("manageLearners.php")
                }
			}); 
	   
			$('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
            showFirstRowContainChk();
			
            //Start----Import Learner button-------   

             $("#importButton").click(function(e){
                var btn = this;
                var validationResult = function (isValid){
                   if (isValid) {
                        importLearners(e,btn); 
                    }
                }
                $('#importLearnerForm').jqxValidator('validate', validationResult);
                    
             });
             
             $('#importLearnerForm').jqxValidator({
                hintType: 'label',
                animationDuration: 0,
                rules: [
                 { input: '#fileUpload', message: 'Select file for import!', action: 'keyup, blur',rule: function (input, commit) {
                        return validateFile(input);               
                    } 
                 }
                ]
             });
             
             function validateFile(input){
                val = input[0].value;
                if(val != ""){
                    return true;
                }
                return false;
             }
             $('#matchingform').jqxValidator({
                hintType: 'label',
                animationDuration: 0,
                rules: [
                 { 
                 input: '#uSelect', message: 'User Name is required!', action: 'keyup, blur', 
                       rule: function (select){
                                return validate("uSelect");
                       }                  
                 },
                 { 
                 input: '#pSelect', message: 'Password is required!', action: 'keyup, blur', 
                       rule: function (select){
                                return validate("pSelect");
                       }                  
                 },
                 {
                 input: '#userNamePrefix', message: 'Prefix is required!', action: 'keyup, blur', rule:'required'
                 }
                
                ]
             });
             
             
             
             function validate(input){
                    index = document.getElementById(input).selectedIndex;
                    if(index > 0){
                        return true;
                    }
                   return false;
             }
            $("#saveButton").click(function(e){
                var btn = this;
                var validationResult = function (isValid){
                   if (isValid) {
                        saveImportedData(e,btn);
                    }
                }
               $('#matchingform').jqxValidator('validate', validationResult);
       
            });
            
            $("#matchingform").on('validationSuccess', function () {
                $("#createCompanyForm-iframe").fadeIn('fast');
            }); 
             
        });
        
        function showFirstRowContainChk(){
            url = "Actions/CustomFieldAction.php?call=isCustomFieldsExists"
            $.get(url,function(data){
                 var result = $.parseJSON(data);
                 if(result.isExist == 1){
                    $("#firstRowChk").hide();    
                 }else{
                     $("#firstRowChk").show();   
                 }                
            });                  
        } 
        
        function importLearners(e,btn){
            $("#errorDiv").hide();
            $("#msgDiv").hide();            
            e.preventDefault();
            var l = Ladda.create(btn);
            l.start();            
             $('#importLearnerForm').ajaxSubmit(function( data ){
                  l.stop();
                  var obj = $.parseJSON(data);
                  var message = obj.message;
                   if(obj.success == 1){
                       var fieldGridData = $.parseJSON(obj.fieldGridData);
                       createFieldsGrid(fieldGridData);
                       var data = $.parseJSON(obj.data);
                       createDataGrid(data);
                       //populatedFields();
                        //$("#wizard").steps("setStep", 2); 
                       toastr.success(message);
                   } else{
                       toastr.error(message,"Import Failed");  
                   }             
                 
             })             
        }
       
        function createFieldsGrid(fieldGridData){
            // prepare the data
            // fieldNamesRow = fieldGridData.rows;
			
			
             var data = {};           
             data = fieldGridData.rows;

            //fieldTypeRow = fieldGridData.fieldTypes;
            //var row = fieldTypeRow;
//            data[1] = fieldTypeRow;
            dataFields = fieldGridData.dataFields;   
            var source =
            {
                localdata: data,
                datatype: "json",                
                datafields:dataFields,
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            var createGridEditor = function(row, cellValue, editor, cellText, width, height)
            {
                if(row == 0){
                    var inputElement = $("<input/>").prependTo(editor);
                    inputElement.jqxInput({ width: width, height: height});
                }else if (row == 1) {
                    editor.jqxDropDownList({autoDropDownHeight: true,  width: width, height: height, source: ['Text', 'Numeric', 'Date', 'Yes/No']});
                }
            }
			
            var initGridEditor = function (row, cellvalue, editor, celltext, pressedkey) {
                if(row == 0){
                    var inputField = editor.find('input');
                    if (pressedkey) {
                        inputField.val(pressedkey);
                        inputField.jqxInput('selectLast');
                    }else {
                        inputField.val(cellvalue);
                        inputField.jqxInput('selectAll');
                    }
                }else if (row == 1) {
                    editor.jqxDropDownList('selectItem', cellvalue);
                }
            }
            var gridEditorValue = function (row, cellValue, editor) {
                if(row == 0){
                    return editor.find('input').val();
                }else{
                    return editor.val();
                }
            }
            // initialize jqxGrid
            $("#learnersFieldsGrid").jqxGrid(
            {
                width: '100%',
                height: 100,
                source: dataAdapter,
                showtoolbar: false,
                showheader:true,
                editable: true,
                selectionmode: 'singlecell',
                columns: fieldGridData.columns,
                ready: function () {
                    $("body").mousemove(function () {
                        var scrolling = $("#learnersFieldsGrid").jqxGrid("scrolling");
                        if (scrolling.horizontal == true) {
                            $("#log").append("scrolling <br />");
                            var position = $('#learnersFieldsGrid').jqxGrid('scrollposition');
                            $('#learnersDataGrid').jqxGrid('scrollposition');
                            $('#learnersDataGrid').jqxGrid('scrolloffset', position.top,position.left);
							
                        };
                    });	
					populateFieldDropDown();					
                 }
            });
        }
		
        function populateFieldDropDown(){
			var columns = $("#learnersFieldsGrid").jqxGrid("columns").records;			
			var createEditor = function(row, cellValue, editor, cellText, width, height)
            {
              	url = "Actions/CustomFieldAction.php?call=getCustomFieldNames";
				$.get(url,function(data){
					var obj = $.parseJSON(data);
					if(obj.names.length > 0){
                        fieldNames = obj.names;
						editor.jqxDropDownList({autoDropDownHeight: true,width: width, height: height, source: obj.names});
                        
                  
                        
					}else{
						editor.find('input').val("");
					}					
				});
            }
			$.each(columns, function(key, value){
				$('#learnersFieldsGrid').jqxGrid('setcolumnproperty', value.datafield, 'createeditor', createEditor);
			});
			
		}
		
        function createDataGrid(gridData){
            // prepare the data
            
            var data = {};
            data = gridData.rows
            var source =
            {
                localdata: data,
                datatype: "json",
                datafields: gridData.dataFields,
                pagesize: 6
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            // initialize jqxGrid
            $("#learnersDataGrid").jqxGrid(
            {
                width: '100%',
                height: 220,
                pageable: true,
                source: dataAdapter,
                showtoolbar: false,
                showheader:false,
                columns: gridData.columns 
                ,ready: function () {
                    $("body").mousemove(function () {
                        var scrolling = $("#learnersDataGrid").jqxGrid("scrolling");
                        if (scrolling.horizontal == true) {
                            var position = $('#learnersDataGrid').jqxGrid('scrollposition');
                            $('#learnersFieldsGrid').jqxGrid('scrollposition');
                            $('#learnersFieldsGrid').jqxGrid('scrolloffset', position.top,position.left);
                        };
                    });
                }
            });
            
        }
        function populatedFields(){
            var row = $('#learnersFieldsGrid').jqxGrid('getrowdata', 0);
            var options = "<option value=''>Select Field</option>"; 
            $.each(fieldNames, function(key, value) {
                if(value != 0){ 
                    options += "<option value='" + value + "'>" + value + "</option>";
                }
               $("#uSelect").html(options);
               $("#pSelect").html(options);
               $("#eSelect").html(options);    
           })            
        }
        function saveImportedData(e,btn){
            e.preventDefault();
            var l = Ladda.create(btn);
            l.start();          
           
            var fieldRows = $("#learnersFieldsGrid").jqxGrid('getrows');
            var fieldData = JSON.stringify(fieldRows);
            var dataRows = $("#learnersDataGrid").jqxGrid('getrows');   
            var data = JSON.stringify(dataRows);
            $("#fieldData").val(fieldData);
            $("#data").val(data);
            $matchingFormData = $("#matchingform").serializeArray();                
            var url = "Actions/CustomFieldAction.php?call=saveImportedFields";
            $.get(url,$matchingFormData,function( data ){
                showResponseDiv(data,"mainDiv");
                l.stop();                                  
            }); 
        }
        function validateFieldNames(){
            var row = $('#learnersFieldsGrid').jqxGrid('getrowdata', 0);
			var flag = true;
			var temp = [];
			var hasDup = [];
			delete row['uid'];
            var cellclass = function (row, columnfield, value) {
                return 'red';
            }
            $.each(row, function(key, value){
				if(value == "" || value == "{FieldName}" || value == "Select Field"){
					flag = false;
					toastr.error(FIELD_NAME_MESSAGE + key + ".","Field Name Error");
                    $('#learnersFieldsGrid').jqxGrid('setcolumnproperty', key, 'cellclassname', cellclass);
					return false;
				}else{
					if($.inArray(value, temp) === -1) {
				        temp.push(value);
				    }else{
						
						hasDup.push(value);
				    }
				}
			});
			if(hasDup.length > 0){
				flag = false;
				toastr.error(DUPLICATE_FIELD_NAME_MESSAGE + hasDup,"Field Name Error");
			}
			return flag;
        }
</script>
<style type="text/css">
#wForm .content{
    height:500px;
}
</style>
</head>


<body class='default'>
<style>
       .red:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected), .jqx-widget .red:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected) {
            color: black;
            background-color: #ED5565;
        }
        .red {
            color: black\9;
            background-color: #e83636\9;
        }
        .none:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected), .jqx-widget .none:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected) {
            color: black;
            background-color: none;
        }

</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <?include("adminMenu.php");?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Import learners</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>
                    <a>Learners</a>
                </li>
                <li class="active">
                    <strong>Import Learners</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Create Learners Database</h5>
                </div>
                <div class="ibox-content">
                    <div id="wform" action="#" class="wizard-big">
                        <h1>Import Learners</h1>
                        <div class="step-content">

                            <h2>Select and Import File</h2>
                            <div class="row">
                                <form method="post" id="importLearnerForm" action="Actions/LearnerAction.php" enctype= "multipart/form-data" class="form-horizontal wizard-big">
                                <input type="hidden" value="importLearners" name="call">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Select File Type</label>
                                    <div class="col-sm-8">
                                        <div class="radio radio-inline i-checks"><label style="padding-left:0px"> <input type="radio" checked="" value="option1" name="a"> <i></i> Comma Separated File (csv) </label></div>
                                        <div class="radio radio-inline i-checks"><label style="padding-left:0px"> <input type="radio" value="option2" name="a"> <i></i> Excel File (xls/xlxs) </label></div>

                                    </div>
                                </div>
                                <div class="form-group" id="firstRowChk" style="display: none;">
                                    <label class="col-sm-2 control-label">Field Labels</label>
                                    <div class="col-sm-8">
                                        <div class="checkbox i-checks">
                                            <label style="padding-left:0px">
                                                <input type="checkbox" id="isfirstRowField" name="isfirstRowField"><i></i> First row contains field names 
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Select File</label>
                                    <div class="col-sm-8">
                                        <input type="file" name="fileUpload" id="fileUpload">
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <button class="btn btn-primary ladda-button" data-style="expand-right" id="importButton" type="button">
                                        <span class="ladda-label">Import</span>
                                    </button>
                                </div>
                                </form>
                            </div>
                        </div>

                        <h1>Identify header fields</h1>
                        <div class="step-content" >
                            <h2>Manage Imported Data</h2>
                            <p>Please set Field names, Type and if is required. Also have a look at imported data from file.</p>
                            <div class="row">
                             <form id="gridForm" action="#" class="wizard-big">
                                <fieldset>  
                                    <div id="learnersFieldsGrid"></div>
                                    <div id="learnersDataGrid"></div>
                                </fieldset>
                             </form>
                            </div>
                        </div>

                        <h1>Match login details</h1>
                        <div class="step-content maindiv">
                            <h2>Match Basic fields</h2>
                            <p>From the imported data, what fields would you like to treat as username, password and email ids of learners.</p>
                            <div class="row">
                                <form id="matchingform" class="form-horizontal wizard-big"> 
                                    <input id="fieldData" name="fieldData" type="hidden">  
                                    <input id="data" name="data" type="hidden">     
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Username</label>
                                        <div class="col-sm-4">
                                            <select class="form-control m-b" name="userName" id="uSelect">
                                            </select>
                                        </div>

                                        <label class="col-sm-2 control-label">Prefixed with</label>
                                        <div class="col-sm-4">
                                            <input id="userNamePrefix" name="userNamePrefix" type="text" class="form-control required">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-4">
                                            <select class="form-control m-b" name="password" id="pSelect">
                                               
                                            </select>
                                        </div>

                                        <label class="col-sm-2 control-label">OR</label>
                                        <div class="col-sm-4">
                                            <div class="checkbox i-checks">
                                                <label style="padding-left:0px"><input type="checkbox" id="randomPassword" name="randomPassword"><i></i> Generate random passwords</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Email Id</label>
                                        <div class="col-sm-4">
                                            <div class="checkbox i-checks">
                                                 <select class="form-control m-b" name="emailId" id="eSelect">
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                    <button class="btn btn-primary ladda-button" data-style="expand-right" id="saveButton" type="button">
                                        <span class="ladda-label">Save Imported Data</span>
                                    </button>
                                    </div>                                     
                                </form>
                            </div> 
                                                         
                        </div>
                       
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
