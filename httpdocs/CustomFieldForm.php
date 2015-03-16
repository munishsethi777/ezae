<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create | Custom Fields</title>
     
     <script type="text/javascript">
      $(document).ready(function () {
        $('#customFieldForm').jqxValidator({
                hintType: 'label',
                animationDuration: 0,
                rules: [
                   { input: '#fieldName', message: 'Field Name is required!', action: 'keyup, blur', rule: 'required' }  
                   ]
            });
            
            $("#saveButton").click(function () {
                var validationResult = function (isValid) {
                    if (isValid) {
                        submitCreate();
                    }
                }
                $('#customFieldForm').jqxValidator('validate', validationResult);
            });
            $("#customFieldForm").on('validationSuccess', function () {
                $("#createCompanyForm-iframe").fadeIn('fast');
            });
        });

        function submitCreate(){
            $("form#customFieldForm").submit();
        }
        function addRow(){
           var fieldDiv = '<div id="fieldDiv" class="fieldDiv" style="margin-top: 10px;">' 
           fieldDiv += '<div class="form-group">'
           fieldDiv += '<label for="fieldName" >Field Name</label><br/>';
           fieldDiv += '<input type="text" placeholder="Field Name" id="exampleInputEmail2" class="form-control">';
           fieldDiv += '</div>'
           
           fieldDiv += '<div class="form-group">';
           fieldDiv += '<label for="fieldType">Field Type</label><br/>';
           fieldDiv += '<select class="form-control">';
           fieldDiv += '<option id="text">Text</option>';
           fieldDiv += '<option id="date">Date</option>';
           fieldDiv += '<option id="numeric">Numeric</option>';
           fieldDiv += '<option id="boolean">Yes/No</option>';
           fieldDiv += '</select>';
           fieldDiv += '</div>'; 
           
           fieldDiv += '<div class="checkbox m-l m-r-xs" >';
           fieldDiv += '<label for="exampleInputPassword2" style="font-weight: 700;">Required</label><br/>';
           fieldDiv += '<input type="checkbox" class="form-control">';
           fieldDiv += '</div>';
           
           fieldDiv += '<div class="form-group">';
           fieldDiv += '<label for="exampleInputPassword2">Remove</label><br/>';
           fieldDiv += '<a href"#" class="form-control removeButton">Remove</a>';
           fieldDiv += '</div>';
           
           fieldDiv += '</div>'
           $("#fieldDivMain").append(fieldDiv);
           $(".removeButton").click(function () {
                $(this).closest('.fieldDiv').remove();
            });
        }
     </script>
</head>
    <body class="gray-bg" >
        <div class="adminSingup animated fadeInRight" >
        <div class="row">
            <div class="col-lg-8" >
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Create CustomFields</h5>
                    </div>
                    <div class="ibox-content">
                          <form role="form" id="customFieldForm" class="form-inline">                            
                             <button class="btn btn-white" onclick="javascript:addRow()" type="button">
                                Add Row
                             </button>                             
                                <br><br>
                                <div id="fieldDivMain" >
                                    <div class="form-group">
                                        <label for="exampleInputEmail2" >Field Name</label> <br/>
                                        <input type="text" id="fieldName" placeholder="Field Name" id="exampleInputEmail2" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword2">Field Type</label><br/>
                                        <select class="form-control">
                                            <option id="text">Text</option>
                                            <option id="date">Date</option>
                                            <option id="numeric">Numeric</option>
                                            <option id="boolean">Yes/No</option> 
                                        </select>
                                    </div>
                                    <div class="checkbox m-l m-r-xs" >
                                        <label for="exampleInputPassword2" style="font-weight: 700;">Required</label><br/>
                                        <input type="checkbox" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword2">Remove</label><br/>
                                        <a href"#" class="form-control">Remove</a>
                                    </div>
                                </div> 
                                 <br><br>   <button class="btn btn-white" id="saveButton" type="button">Save</button></form>
                                
                    </div>
                </div>
            </div>
        </div>
        </div>
        
    </boby>
</html>    
