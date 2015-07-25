  <?include("sessioncheck.php");?>
<html>
<head>
<?include "ScriptsInclude.php"?>
<script type="text/javascript">
    $(document).ready(function(){
       // var url = 'Actions/LeaderBoardAction.php?call=getLeaderBoardsForGrid';
//        $.get(url, function(data){
//                loadGrid();
//        })
        loadGrid(); 
    })

    function loadGrid(){
        var columns = [
          { text: 'id', datafield: 'id' , hidden:true},
          { text: 'Name' , datafield: 'name', width: 250 },
          { text: 'Type', datafield: 'type' },
          { text: 'Modified On', datafield: 'lastmodifiedon' ,cellsformat: 'MM-dd-yyyy hh:mm:ss tt'}
        ]
        var source =
        {
            datatype: "json",
            id: 'id',
            pagesize: 20,
            //localData: rows,
            datafields: [
                { name: 'id', type: 'integer' },
                { name: 'name', type: 'string' },
                { name: 'type', type: 'string' },
                { name: 'lastmodifiedon', type: 'date' }
            ],
            url: 'Actions/LeaderBoardAction.php?call=getLeaderBoardsForGrid',
            root: 'Rows',
            cache: false,
            beforeprocessing: function(data)
            {        
                source.totalrecords = data.TotalRows;
            },
            filter: function()
            {
                // update the grid and send a request to the server.
                $("#jqxgrid").jqxGrid('updatebounddata', 'filter');
            },
            sort: function()
            {
                    // update the grid and send a request to the server.
                    $("#jqxgrid").jqxGrid('updatebounddata', 'sort');
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
        $("#jqxgrid").jqxGrid(
        {
            width: '100%',
            source: dataAdapter,
            sortable: true,
            //showfilterrow: true,
            filterable: true,
            autoshowfiltericon: true,
            columns: columns,
            pageable: true,
            autoheight: true,
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
            }
            
        });
        
    }
    
</script>
</head>
<body class='default'>
    <div id="wrapper">
        <?include("adminMenu.php");?>
       <div class="adminSingup animated fadeInRight">
        <div class="row">
            <div class="col-lg-12" >
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Manage Learner's Profiles</h5>
                    </div>
                    <div class="ibox-content">
                        <div  id="jqxgrid"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

