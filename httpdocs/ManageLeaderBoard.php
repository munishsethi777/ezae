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
          { text: 'Name' , datafield: 'name'},
          { text: 'Based on', datafield: 'basedOn' },
          { text: 'Modified On', datafield: 'leaderboard.lastmodifiedon' ,cellsformat: 'MM-dd-yyyy hh:mm:ss tt'},
          { text: 'Action', datafield: 'action'}
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
                { name: 'basedOn', type: 'string' },
                { name: 'leaderboard.lastmodifiedon', type: 'date' },
                { name: 'action', type: 'string' }
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
            height: '75%',
            source: dataAdapter,
            sortable: true,
            //showfilterrow: true,
            filterable: true,
            autoshowfiltericon: true,
            columns: columns,
            pageable: true,
            altrows: true,
            columnsresize: true,
            columnsreorder: true,
            showstatusbar: true,
            pageable: true,
            virtualmode: true,
            rendergridrows: function()
            {
                  return dataAdapter.records;
            }
        });
    }

    function showLeaderboard(leaderBoardSeq,type){
        $.getJSON( "Actions/LeaderBoardAction.php?call=getLeaderBoardDataForAdminGridPopup&seq="+ leaderBoardSeq +"&type="+type, function( data ){
            $str = "<h4>Top 3 Scorers</h4>";
            $i = 1;
            $.each(data, function(key,val){
                $(".leaderBoardName").html(val.leaderboardName);
                if($i < 4){
                    $str += "<p>"+ $i++ +". "+ val.username +" (Score: "+ val.score +")</p>";
                }
            });
            loadLeaderBoardActivityGrid(data);
            $(".subDiv").html($str);
            $("#leaderBoardDetailsModal").modal('show')
        });
    }
    function loadLeaderBoardActivityGrid(data){
        var source =
            {
                localdata: data,
                datatype: "array",
                datafields:
                [
                    { name: 'username', type: 'string' },
                    { name: 'progress', type: 'numeric' },
                    { name: 'score', type: 'string' },
                    { name: 'dateofplay', type: 'string' }
                ]
            };
            var dataAdapter = new $.jqx.dataAdapter(source);

            $("#jqxgridLB").jqxGrid(
            {
                width: 500,
                height:100,
                source: dataAdapter,
                sortable: true,
                columns: [
                  { text: 'UserName', datafield: 'username', width: '20%' },
                  { text: 'Progress', datafield: 'progress', width: '20%', cellsalign: 'right'},
                  { text: 'Score', datafield: 'score', width: '20%', cellsalign: 'right' },
                  { text: 'Date Of Play', datafield: 'dateofplay', width: '40%' }
                ]
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

    <div id="leaderBoardDetailsModal" style="width:1000px;" class="modal fade" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">LeaderBoard - <label class="leaderBoardName"></label></h4>
                </div>
                <div class="modal-body mainDiv">
                      <div class="subDiv"></div>
                     <div id="jqxgridLB"></div>
                </div>
                <div class="modal-footer">
                     <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



</body>
</html>

