<div class="adminSingup animated fadeInRight">
    <div class="row">
        <div class="col-lg-12" >
            <div  id="moduleGrid"></div>                
        </div>
     </div>
</div>
 <script type="text/javascript">
    function loadGrid(){
        var columns = [
          { text: 'Name' , datafield: 'title', width: 200 },
          { text: 'Description', datafield: 'description',width:250},
          { text: 'Max Score', datafield: 'maxscore',width: 100},
          { text: 'Pass Percent', datafield: 'passpercent',width: 100 },
          { text: 'Paid', datafield: 'ispaid' ,width: 50},
          { text: 'Created On', datafield: 'createdon' ,cellsformat: 'MM-dd-yyyy hh:mm:ss tt' }
        ]
        var source =
        {
            datatype: "json",
            id: 'id',
            pagesize: 20,
            //localData: rows,
            datafields: [
                { name: 'id', type: 'integer' },
                { name: 'title', type: 'string' },
                { name: 'description', type: 'string' },
                { name: 'maxscore', type: 'integer' },
                { name: 'passpercent', type: 'integer' },
                { name: 'ispaid', type: 'boolean' } ,
                { name: 'createdon', type: 'date' } ,
            ],
            url: 'Actions/ModuleAction.php?call=getModulesForGrid',
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
        $("#moduleGrid").jqxGrid(
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
            selectionmode: 'checkbox',
            showstatusbar: true,
        });
         $('#moduleGrid').on('bindingcomplete', function (event) {
            $("#moduleIds").val("<?echo $moduleIds?>");
            if($("#moduleIds").val() != ""){
                var ids = $("#moduleIds").val().split(",");
                $.each(ids, function(index , value){
                   var index = $('#moduleGrid').jqxGrid('getrowboundindexbyid',value);
                   $('#moduleGrid').jqxGrid('selectrow', index);  
                });    
            }
            
         });
        
    }
    
</script>