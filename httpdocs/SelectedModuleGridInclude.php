<div class="adminSingup animated fadeInRight">
    <div class="row">
        <div class="col-lg-12" >
            <div  id="selectedModuleGrid"></div>                
        </div>
     </div>
</div>
 <script type="text/javascript">
    function removeRow(row){
        ids=[];
        var dataRow = $("#selectedModuleGrid").jqxGrid('getrowdata', row);
        ids.push(dataRow.id);
        var commit = $("#selectedModuleGrid").jqxGrid('deleterow', ids); 
    }
    function loadSelectedGrid(){
        var imagerenderer = function (row, column, value) {
                return '<a  href="#removeRow" onClick="removeRow('+ row + ')"><img style="margin-left: 25px;margin-top: 5px;" src="images/Remove-icon_sm.png"/>';
            }
        var columns = [           
          { text: 'Leaderboard', datafield: 'enableleaderboard',columntype: 'checkbox', editable:true,width: 100},
          { text: 'Name' , datafield: 'title',editable:false, width: 250 },
          { text: 'Description' , datafield: 'description',editable:false, width: 300 },
          { text: 'Max Score', datafield: 'maxscore', editable:false, width: 100},
          { text: 'Pass Percent', datafield: 'passpercent', editable:false, width: 100 },
          { text: 'Paid', datafield: 'ispaid', columntype: 'checkbox' , editable:false ,width: 50},          
          { text: 'Remove', datafield: 'remove',editable:false,cellsalign: 'center',cellsrenderer:imagerenderer} 
        ]
        var source =
        {
            datatype: "json",
            id: 'id',
            pagesize: 20,
            //localData: rows,
            datafields: [
                { name: 'id', type: 'integer' },
                { name: 'enableleaderboard', type: 'bool'} ,
                { name: 'title', type: 'string' },
                { name: 'description', type: 'string' },
                { name: 'maxscore', type: 'integer' },
                { name: 'passpercent', type: 'integer' },
                { name: 'ispaid', type: 'bool' },                
                { name: 'remove', type: 'string' }
            ],
            url: 'Actions/ModuleAction.php?call=getLearningPlanModulesForGrid&id=<?echo $id?>',
            addrow: function (rowid, rowdata, position, commit) {
                commit(true);
            },
            deleterow: function (rowid, commit){
                commit(true);
            },
            updaterow: function (rowid, newdata, commit) {
                commit(true);
            }
        };
       
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#selectedModuleGrid").jqxGrid(
        {
            width: '100%',
            source: dataAdapter,
            filterable: true,
            sortable: true,
            autoshowfiltericon: true,
            columns: columns,
            pageable: true,
            autoheight: true,
            altrows: true,
            enabletooltips: true,
            columnsresize: true,
            columnsreorder: true,
            editable: true,
            showstatusbar: false,
        });
         //$('#selectedModuleGrid').on('bindingcomplete', function (event) {
//            $("#moduleIds").val("<?echo $moduleIds?>");
//            if($("#moduleIds").val() != ""){
//                var ids = $("#moduleIds").val().split(",");
//                $.each(ids, function(index , value){
//                   var index = $('#moduleGrid').jqxGrid('getrowboundindexbyid',value);
//                   $('#selectedModuleGrid').jqxGrid('selectrow', index);  
//                });    
//            }
//            
//         });
        
    }
    
</script>