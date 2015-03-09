<?include("sessioncheck.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administration - Easy Assessment Engine</title>
<script src="scripts/jquery-2.1.1.js"></script>
<link rel="stylesheet" href="jqwidgets/styles/jqx.base.css" type="text/css" />
<link rel="stylesheet" href="jqwidgets/styles/jqx.arctic.css" type="text/css" />
<script type="text/javascript" src="jqwidgets/jqxcore.js"></script>
<script type="text/javascript" src="jqwidgets/jqxbuttons.js"></script>
<script type="text/javascript" src="jqwidgets/jqxscrollbar.js"></script>
<script type="text/javascript" src="jqwidgets/jqxlistbox.js"></script>
<script type="text/javascript" src="jqwidgets/jqxdropdownlist.js"></script>
<script type="text/javascript" src="jqwidgets/jqxmenu.js"></script>
<script type="text/javascript" src="jqwidgets/jqxdata.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.edit.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.sort.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.selection.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.pager.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.filter.js"></script>
<script type="text/javascript" src="jqwidgets/jqxlistbox.js"></script>
<script type="text/javascript" src="jqwidgets/jqxcombobox.js"></script>
<script type="text/javascript" src="jqwidgets/jqxdraw.js"></script>
<script type="text/javascript" src="jqwidgets/jqxchart.core.js"></script>
<script type="text/javascript" src="jqwidgets/jqxnumberinput.js"></script>
<script type="text/javascript" src="jqwidgets/jqxinput.js"></script>


<link href="styles/plugins/iCheck/custom.css" rel="stylesheet">
<link href="styles/plugins/steps/jquery.steps.css" rel="stylesheet">
<!-- Steps -->
<script src="scripts/plugins/staps/jquery.steps.min.js"></script>

<!-- Jquery Validate -->
<script src="scripts/plugins/validate/jquery.validate.min.js"></script>
<!-- iCheck -->
<script src="scripts/plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript">
        $(document).ready(function (){
            $("#wizard").steps();
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

            createFieldsGrid();
            createDataGrid();

        });
        function createFieldsGrid(){
            // prepare the data
            var data = {};
            var row = {};
            row["field1"] = "1";
            row["field2"] = "2";
            row["field3"] = "3";
            row["field4"] = "4";
            row["field5"] = "5";
            data[0] = row;

            var row = {};
            row["field1"] = "Text";
            row["field2"] = "Text";
            row["field3"] = "Text";
            row["field4"] = "Text";
            row["field5"] = "Text";
            data[1] = row;

            var source =
            {
                localdata: data,
                datatype: "local",
                datafields:
                [
                    { name: 'field1', type: 'string' },
                    { name: 'field2', type: 'string' },
                    { name: 'field3', type: 'string' },
                    { name: 'field4', type: 'string' },
                    { name: 'field5', type: 'string' }
                ],
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
                columns: [
                  { text: 'Field 1', datafield: 'field1', width: 250, columntype: 'template', createeditor: createGridEditor,  initeditor: initGridEditor,geteditorvalue: gridEditorValue },
                  { text: 'Field 2', datafield: 'field2', width: 250, columntype: 'template', createeditor: createGridEditor,  initeditor: initGridEditor,geteditorvalue: gridEditorValue },
                  { text: 'Field 3', datafield: 'field3', width: 250, columntype: 'template', createeditor: createGridEditor,  initeditor: initGridEditor,geteditorvalue: gridEditorValue },
                  { text: 'Field 4', datafield: 'field4', width: 250, columntype: 'template', createeditor: createGridEditor,  initeditor: initGridEditor,geteditorvalue: gridEditorValue},
                  { text: 'Field 5', datafield: 'field5', width: 250, columntype: 'template', createeditor: createGridEditor,  initeditor: initGridEditor,geteditorvalue: gridEditorValue}
                ],ready: function () {
                    $("body").mousemove(function () {
                        var scrolling = $("#learnersFieldsGrid").jqxGrid("scrolling");
                        if (scrolling.horizontal == true) {
                            $("#log").append("scrolling <br />");
                            var position = $('#learnersFieldsGrid').jqxGrid('scrollposition');
                            $('#learnersDataGrid').jqxGrid('scrollposition');
                            $('#learnersDataGrid').jqxGrid('scrolloffset', position.top,position.left);
                        };
                    });
                }
            });
        }
        function createDataGrid(){
            // prepare the data
            var data = {};
            var firstNames =
            [
                "Andrew", "Nancy", "Shelley", "Regina", "Yoshi", "Antoni", "Mayumi", "Ian", "Peter", "Lars", "Petra", "Martin", "Sven", "Elio", "Beate", "Cheryl", "Michael", "Guylene"
            ];
            var lastNames =
            [
                "Fuller", "Davolio", "Burke", "Murphy", "Nagase", "Saavedra", "Ohno", "Devling", "Wilson", "Peterson", "Winkler", "Bein", "Petersen", "Rossi", "Vileid", "Saylor", "Bjorn", "Nodier"
            ];
            var productNames =
            [
                "Black Tea", "Green Tea", "Caffe Espresso", "Doubleshot Espresso", "Caffe Latte", "White Chocolate Mocha", "Cramel Latte", "Caffe Americano", "Cappuccino", "Espresso Truffle", "Espresso con Panna", "Peppermint Mocha Twist"
            ];
            var priceValues =
            [
                "2.25", "1.5", "3.0", "3.3", "4.5", "3.6", "3.8", "2.5", "5.0", "1.75", "3.25", "4.0"
            ];
            var generaterow = function (i) {
                var row = {};
                var productindex = Math.floor(Math.random() * productNames.length);
                var price = parseFloat(priceValues[productindex]);
                var quantity = 1 + Math.round(Math.random() * 10);
                row["firstname"] = firstNames[Math.floor(Math.random() * firstNames.length)];
                row["lastname"] = lastNames[Math.floor(Math.random() * lastNames.length)];
                row["productname"] = productNames[productindex];
                row["price"] = price;
                row["quantity"] = quantity;
                row["total"] = price * quantity;
                return row;
            }
            for (var i = 0; i < 10; i++) {
                var row = generaterow(i);
                data[i] = row;
            }
            var source =
            {
                localdata: data,
                datatype: "local",
                datafields:
                [
                    { name: 'firstname', type: 'string' },
                    { name: 'lastname', type: 'string' },
                    { name: 'productname', type: 'string' },
                    { name: 'quantity', type: 'number' },
                    { name: 'price', type: 'number' }
                ],
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
                columns: [
                  { text: 'First Name', datafield: 'firstname', width: 250 },
                  { text: 'Last Name', datafield: 'lastname', width: 250 },
                  { text: 'Product', datafield: 'productname', width: 250 },
                  { text: 'Quantity', datafield: 'quantity', width: 250, cellsalign: 'right' },
                  { text: 'Price', datafield: 'price', width: 250, cellsalign: 'right' }
                ],ready: function () {
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
</script>
<style type="text/css">
#wizard .content{
    height:500px;
}
</style>
</head>


<body class='default'>
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
                    <div id="wizard">
                        <h1>First Step</h1>
                        <div class="step-content">

                            <h2>Select and Import File</h2>
                            <div class="row">
                                <form method="get" class="form-horizontal wizard-big">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Select File Type</label>
                                    <div class="col-sm-8">
                                        <div class="radio radio-inline i-checks"><label style="padding-left:0px"> <input type="radio" checked="" value="option1" name="a"> <i></i> Comma Separated File (csv) </label></div>
                                        <div class="radio radio-inline i-checks"><label style="padding-left:0px"> <input type="radio" value="option2" name="a"> <i></i> Excel File (xls/xlxs) </label></div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Field Labels</label>
                                    <div class="col-sm-8">
                                        <div class="checkbox i-checks">
                                            <label style="padding-left:0px"><input type="checkbox" value=""><i></i> First row contains field names </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Select File</label>
                                    <div class="col-sm-8">
                                        <input type="file" name="file" id="inputImage" >
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>

                        <h1>Second Step</h1>
                        <div class="step-content">
                            <h2>Manage Imported Data</h2>
                            <p>Please set Field names, Type and if is required. Also have a look at imported data from file.</p>
                            <div class="row">
                                <div id="learnersFieldsGrid"></div>
                                <div id="learnersDataGrid"></div>
                            </div>
                        </div>

                        <h1>Third Step</h1>
                        <div class="step-content">
                            <h2>Match Basic fields</h2>
                            <p>From the imported data, what fields would you like to treat as username, password and email ids of learners.</p>
                            <div class="row">
                                <form method="get" class="form-horizontal wizard-big">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Username</label>
                                        <div class="col-sm-4">
                                            <select class="form-control m-b" name="account">
                                                <option value="">Select Field</option>
                                                <option value="fullName">Full Name</option>
                                                <option value="employeeCode">Employee Code</option>
                                            </select>
                                        </div>

                                        <label class="col-sm-2 control-label">Prefixed with</label>
                                        <div class="col-sm-4">
                                            <input id="userName" name="userName" type="text" class="form-control required">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-4">
                                            <select class="form-control m-b" name="account">
                                                <option value="">Select Field</option>
                                                <option value="fullName">Full Name</option>
                                                <option value="employeeCode">Employee Code</option>
                                            </select>
                                        </div>

                                        <label class="col-sm-2 control-label">OR</label>
                                        <div class="col-sm-4">
                                            <div class="checkbox i-checks">
                                                <label style="padding-left:0px"><input type="checkbox" value=""><i></i> Generate random passwords</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Email Id</label>
                                        <div class="col-sm-4">
                                            <div class="checkbox i-checks">
                                                 <select class="form-control m-b" name="account">
                                                    <option value="">Select Field</option>
                                                    <option value="fullName">Full Name</option>
                                                    <option value="employeeCode">Employee Code</option>
                                                </select>
                                            </div>
                                        </div>
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
