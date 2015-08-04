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
              { text: 'Message Subject' , datafield: 'subject', width: 250 },
              { text: 'Condition', datafield: 'condition' },
              { text: 'Status', datafield: 'status'},
              { text: 'Learning Plans', datafield: 'learningplans'}
            ]
           
            var source =
            {
                datatype: "json",
                id: 'id',
                pagesize: 20,
                datafields: [{ name: 'id', type: 'integer' },
                            { name: 'name', type: 'string' },
                            { name: 'subject', type: 'string' },
                            { name: 'messageText', type: 'string' },
                            { name: 'moduleNames', type: 'string' },
                            { name: 'lpSeqs', type: 'string' },
                            { name: 'moduleSeqs', type: 'string' },
                            { name: 'dated', type: 'date' },
                            { name: 'condition', type: 'string' },
                            { name: 'status', type: 'string' },
                            { name: 'percent', type: 'percent' },
                            { name: 'learningplans', type: 'string'}],
                url: 'Actions/MailMessageAction.php?call=getMailMessageForGrid',
                root: 'Rows',
                cache: false,
                beforeprocessing: function(data)
                {        
                    source.totalrecords = data.TotalRows;
                },
                filter: function()
                {
                    // update the grid and send a request to the server.
                    $("#messagesGrid").jqxGrid('updatebounddata', 'filter');
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
            $("#messagesGrid").jqxGrid(
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
                    var exportButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-file-excel-o'></i><span style='margin-left: 4px; position: relative;'>Export</span></div>");
                    var editButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-edit'></i><span style='margin-left: 4px; position: relative;'>Edit</span></div>");
                    var reloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");

                    container.append(addButton);
                    container.append(editButton);
                    container.append(deleteButton);
                    container.append(exportButton);
                    container.append(reloadButton);
                    statusbar.append(container);
                    addButton.jqxButton({  width: 65, height: 18 });
                    deleteButton.jqxButton({  width: 65, height: 18 });
                    editButton.jqxButton({  width: 65, height: 18 });
                    exportButton.jqxButton({  width: 65, height: 18 });
                    reloadButton.jqxButton({  width: 70, height: 18 });
                    // create new row.
                    addButton.click(function (event) {
                        $("#saveNewBtnDiv").show();
                        location.href = ("createMessage.php");
                    });
                    editButton.click(function (event){
                        var selectedrowindex = $("#messagesGrid").jqxGrid('selectedrowindexes');
                        if(selectedrowindex.length != 1){
                            bootbox.alert("Please Select single row for edit.", function() {});
                            return;    
                        }
                        var row = $('#messagesGrid').jqxGrid('getrowdata', selectedrowindex);
                        $("#id").val(row.id);
                        $("#name").val(row.name);
                        $("#subject").val(row.subject);
                        $("#messageText").val(row.messageText);
                        $("#lpSeqs").val(row.lpSeqs);
                        $("#messageCondition").val(row.condition);
                        $("#moduleSeqs").val(row.moduleSeqs);
                        $("#percent").val(row.percent);                       
                        sendOnDate = row.dated;
                        if(sendOnDate != "" && sendOnDate != null){
                            sendOnDate = $.date(sendOnDate);
                        }
                        $("#sendOnDate").val(sendOnDate);                        
                        $("#form1").submit();                   
                     });
                     deleteButton.click(function (event) {
                        deleteRows("messagesGrid","Actions/MailMessageAction.php?call=deleteMessages");
                    });
                    // reload grid data.
                    reloadButton.click(function (event) {
                        $("#messagesGrid").jqxGrid({ source: dataAdapter });
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
            <h2>Manage Communication Messages </h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>
                    <a>Messages</a>
                </li>
                <li class="active">
                    <strong>Manage Messages</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">

                    <div class="ibox-content">
                        <div id="messagesGrid"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="form1" name="form1" method="post" action="createMessage.php">
        <input type="hidden" id="id" name="id"/>
        <input type="hidden" id="name" name="name"/>
        <input type="hidden" id="subject" name="subject"/>   
        <input type="hidden" id="messageText" name="messageText"/> 
        <input type="hidden" id="lpSeqs" name="lpSeqs"/>
        <input type="hidden" id="messageCondition" name="messageCondition"/> 
        <input type="hidden" id="sendOnDate" name="sendOnDate"/> 
        <input type="hidden" id="moduleSeqs" name="moduleSeqs"/>
        <input type="hidden" id="percent" name="percent"/> 
    </form>
</body>
</html>
