<?include("sessioncheck.php");?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administration - Easy Assessment Engine</title>
 <?include "ScriptsInclude.php"?>

<script type="text/javascript">
        var mathingRule = "";

        $(document).ready(function (){
            //var url = 'Actions/MailMessageAction.php?call=getMailMessageForGrid';
           // $.get(url, function(data){
                loadGrid();
            //})
        });


        function loadGrid(data){
            var columns = [
              { text: 'id', datafield: 'id' , hidden:true},
              { text: 'Name', datafield: 'name' },
              { text: 'User Name' , datafield: 'username', width: 250 },              
              { text: 'Password', datafield: 'password'},
              { text: 'Email', datafield: 'emailid'}
            ]
           
            var source =
            {
                datatype: "json",
                id: 'id',
                pagesize: 20,
                datafields: [{ name: 'id', type: 'integer' },
                            { name: 'username', type: 'string' },
                            { name: 'name', type: 'string' },
                            { name: 'password', type: 'string' },
                            { name: 'mobile', type: 'string' },
                            { name: 'emailid', type: 'string' }],
                url: 'Actions/ManagerAction.php?call=getManagersForGrid',
                root: 'Rows',
                cache: false,
                beforeprocessing: function(data)
                {        
                    source.totalrecords = data.TotalRows;
                },
                filter: function()
                {
                    // update the grid and send a request to the server.
                    $("#managersGrid").jqxGrid('updatebounddata', 'filter');
                },
                sort: function()
                {
                    // update the grid and send a request to the server.
                    $("#managersGrid").jqxGrid('updatebounddata', 'sort');
                },
                addrow: function (rowid, rowdata, position, commit) {
                    commit(true);
                },
                deleterow: function (rowid, commit) {
                    commit(true);
                },
                updaterow: function (rowid, newdata, commit) {
                    commit(true);
                }
            };
            
            var dataAdapter = new $.jqx.dataAdapter(source);
            // initialize jqxGrid
            $("#managersGrid").jqxGrid(
            {
            width: '100%',
            height: 400,
            source: dataAdapter,
            sortable: true,
            //showfilterrow: true,
            filterable: true,
            autoshowfiltericon: true,
            columns: columns,
            pageable: true,
            altrows: true,
            enabletooltips: true,
            columnsresize: true,
            columnsreorder: true,
            selectionmode: 'checkbox',
            showstatusbar: true,
            pageable: true,
            virtualmode: true,
            rendergridrows: function()
            {
                  return dataAdapter.records;     
            },
                renderstatusbar: function (statusbar) {
                    // appends buttons to the status bar.
                    var container = $("<div style='overflow: hidden; position: relative; margin: 5px;height:30px'></div>");
                    var addButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-plus-square'></i><span style='margin-left: 4px; position: relative;'>Add</span></div>");
                    var deleteButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-times-circle'></i><span style='margin-left: 4px; position: relative;'>Delete</span></div>");
                    var editButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-edit'></i><span style='margin-left: 4px; position: relative;'>Edit</span></div>");
                    var reloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");

                    container.append(addButton);
                    container.append(editButton);
                    container.append(deleteButton);
                    container.append(reloadButton);
                    statusbar.append(container);
                    addButton.jqxButton({  width: 65, height: 18 });
                    deleteButton.jqxButton({  width: 65, height: 18 });
                    editButton.jqxButton({  width: 65, height: 18 });
                    reloadButton.jqxButton({  width: 70, height: 18 });
                    // create new row.
                    addButton.click(function (event) {
                        location.href = ("adminManagers.php");
                    });
                    editButton.click(function (event){
                        var selectedrowindex = $("#managersGrid").jqxGrid('selectedrowindexes');
                        if(selectedrowindex.length != 1){
                            bootbox.alert("Please Select single row for edit.", function() {});
                            return;    
                        }
                        var row = $('#managersGrid').jqxGrid('getrowdata', selectedrowindex);
                        $("#id").val(row.id);
                        $("#username").val(row.username);  
                        $("#fullname").val(row.name);
                        $("#password").val(row.password);
                        $("#email").val(row.emailid);
                        $("#mobile").val(row.mobile);
                        $("#form1").submit();                   
                        });
                     deleteButton.click(function (event) {
                        deleteRows("managersGrid","Actions/ManagerAction.php?call=deleteManager");
                     });
                    // reload grid data.
                    reloadButton.click(function (event) {
                        $("#managersGrid").jqxGrid({ source: dataAdapter });
                    });
                }
            });
        }


</script>

</head>
<body class='default'>
<div class="wrapper wrapper-content animated fadeInRight">
    <?include("adminMenu.php");?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Manage Admin Managers </h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>
                    <a>Managers</a>
                </li>
                <li class="active">
                    <strong>Managers</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div id="managersGrid"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="form1" name="form1" method="post" action="adminManagers.php">
        <input type="hidden" id="id" name="id"/>
        <input type="hidden" id="username" name="username"/>
        <input type="hidden" id="fullname" name="fullname"/>   
        <input type="hidden" id="password" name="password"/> 
        <input type="hidden" id="email" name="email"/>
        <input type="hidden" id="mobile" name="mobile"/> 
        <input type="hidden" id="criteriaType" name="criteriaType"/>
        <input type="hidden" id="seqs[]" name="seqs[]"/>
        <input type="hidden" id="cFNames[]" name="cFNames[]"/>
        <input type="hidden" id="cFValues[]" name="cFValues[]"/>
    </form>
</body>
</html>