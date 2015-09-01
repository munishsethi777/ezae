<?include("sessioncheck.php");?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administration - Easy Assessment Engine</title>
 <?include "ScriptsInclude.php"?>

<script type="text/javascript">
        var mathingRule = "";
        isSelectAll = false;
        var gridId = "#messageLogsGrid"
        $(document).ready(function (){
            var url = 'Actions/MailMessageAction.php?call=getMailMessageLogsForGrid';
            $.get(url, function(data){
                loadGrid();
            })
        });


        function loadGrid(data){
            var columns = [
              { text: 'id', datafield: 'id' , hidden:true},
              { text: 'Message Name' , datafield: 'name'},
              { text: 'Message Subject' , datafield: 'subject'},              
              { text: 'UserName', datafield: 'username'},
              { text: 'Detail', datafield: 'detail', width:250},
              { text: 'Status', datafield: 'status'},
              { text: 'Sent On', datafield: 'dated'}
            ]
           
            var source =
            {
                datatype: "json",
                id: 'id',
                pagesize: 20,
                datafields: [
                            { name: 'id', type: 'integer' },
                            { name: 'name', type: 'string' },
                            { name: 'subject', type: 'string' },
                            { name: 'username', type: 'string' },
                            { name: 'status', type: 'string' },
                            { name: 'dated', type: 'date' },
                            { name: 'detail', type: 'string' },
                            ],
                url: 'Actions/MailMessageAction.php?call=getMailMessageLogsForGrid',
                root: 'Rows',
                cache: false,
                beforeprocessing: function(data)
                {        
                    source.totalrecords = data.TotalRows;
                },
                filter: function()
                {
                    // update the grid and send a request to the server.
                    $(gridId).jqxGrid('updatebounddata', 'filter');
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
            $(gridId).jqxGrid(
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
            selectionmode: 'none',
            showstatusbar: true,
            pageable: true,
            virtualmode: true,
            rendergridrows: function()
            {
                  return dataAdapter.records;     
            },
                renderstatusbar: function (statusbar) {
                    // appends buttons to the status bar.
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
            <h2>Mail Message Logs </h2>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div id="messageLogsGrid"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
