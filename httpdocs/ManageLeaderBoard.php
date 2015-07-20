  <?include("sessioncheck.php");?>
<html>
<head>
<?include "ScriptsInclude.php"?>
<script type="text/javascript">
    $(document).ready(function(){
        loadGrid();
    })

    function loadGrid(){
        var columns = [
          { text: 'id', datafield: 'id' , hidden:true},
          { text: 'Name' , datafield: 'name', width: 500 },
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
            height: '75%',
            source: dataAdapter,
            filterable: true,
            sortable: true,
            autoshowfiltericon: true,
            columns: columns,
            pageable: true,
            altrows: true,
            enabletooltips: true,
            columnsresize: true,
            columnsreorder: true,
            selectionmode: 'checkbox',
            showstatusbar: true,

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
                        <h5>Manage LeaderBoards</h5>
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

