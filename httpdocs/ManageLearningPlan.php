<?include("sessioncheck.php");?>

<html>
<head>
<?include "ScriptsInclude.php";?>
</head>
<body>
    <div id="wrapper">
        <?include("adminMenu.php");?>
        <div class="adminSingup animated fadeInRight">
            <div class="row">
                <div class="col-lg-12" >
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Manage Learnering Plans</h5>
                        </div>
                        <div class="ibox-content">
                            <div  id="learningPlanGrid"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="form1" name="form1" method="post" action="createLearningPlan.php">
        <input type="hidden" id="id" name="id"/>
        <input type="hidden" id="lpName" name="lpName"/>
        <input type="hidden" id="isActive" name="isActive"/>   
        <input type="hidden" id="lpDes" name="lpDes"/> 
        <input type="hidden" id="activation" name="activation"/>
        <input type="hidden" id="activateDate" name="activateDate"/> 
        <input type="hidden" id="isDeactivate" name="isDeactivate"/> 
        <input type="hidden" id="deactivateDate" name="deactivateDate"/>
        <input type="hidden" id="moduleIds" name="moduleIds"/> 
        <input type="hidden" id="isEnabledLeaderboard" name="isEnabledLeaderboard"/>
        <input type="hidden" id="lockSequence" name="lockSequence"/>        
    </form>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){ 
        loadGrid();
    });
    
    function loadGrid(){
        var columns = [
          { text: 'id', datafield: 'id' , hidden:true},
          { text: 'Title' , datafield: 'title', width: 250 },
          { text: 'Description', datafield: 'description' },
          { text: 'Active', datafield: 'isactive'}, 
          { text: 'Activate on', datafield: 'activateon',cellsformat: 'MM-dd-yyyy hh:mm:ss tt'  }, 
          { text: 'Deactivate on', datafield: 'deactivateon',cellsformat: 'MM-dd-yyyy hh:mm:ss tt'  },
          { text: 'Modified On', datafield: 'lastmodifiedon' ,cellsformat: 'MM-dd-yyyy hh:mm:ss tt' }
        ]
        var source =
        {
            datatype: "json",
            id: 'id',
            pagesize: 20,
            datafields: [
                { name: 'id', type: 'integer' },
                { name: 'title', type: 'string' },
                { name: 'description', type: 'string' },
                { name: 'activateon', type: 'date' },
                { name: 'isactive', type: 'boolean' },
                { name: 'moduleIds', type: 'string' },
                { name: 'isdeactivate', type: 'boolean' },
                { name: 'isenableleaderboard', type: 'boolean' },
                { name: 'lockSequence', type: 'boolean' },
                { name: 'deactivateon', type: 'date' },
                { name: 'lastmodifiedon', type: 'date' }
            ],
            url: 'Actions/LearningPlanAction.php?call=getLearnerPlansForGrid',
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
        $("#learningPlanGrid").jqxGrid(
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
            renderstatusbar: function (statusbar) {
                var container = $("<div style='overflow: hidden; position: relative; margin: 5px;height:30px'></div>");
                var addButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-plus-square'></i><span style='margin-left: 4px; position: relative;'>    Add</span></div>");
                var deleteButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-times-circle'></i><span style='margin-left: 4px; position: relative;'>Delete</span></div>");
                var editButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-edit'></i><span style='margin-left: 4px; position: relative;'>Edit</span></div>");
                

                container.append(addButton);
                container.append(editButton);
                container.append(deleteButton);
              
                statusbar.append(container);
                addButton.jqxButton({  width: 65, height: 18 });
                deleteButton.jqxButton({  width: 70, height: 18 });
                editButton.jqxButton({  width: 65, height: 18 });
               
                // create new row.
                addButton.click(function (event) {
                    location.href = ("createLearningPlan.php");
                });
                // update row.
                editButton.click(function (event){
                    var selectedrowindex = $("#learningPlanGrid").jqxGrid('selectedrowindexes');
                    if(selectedrowindex.length != 1){
                        bootbox.alert("Please Select single row for edit.", function() {});
                        return;    
                    }
                    var row = $('#learningPlanGrid').jqxGrid('getrowdata', selectedrowindex);
                    $("#id").val(row.id);
                    $("#lpName").val(row.title);
                    $("#lpDes").val(row.description);
                    $("#isActive").val(row.isactive);
                    $("#lockSequence").val(row.lockSequence);
                    
                    activateon = row.activateon;
                    if(activateon != "" && activateon != null){
                        activateon = $.date(activateon);
                    }
                    $("#activateDate").val(activateon);
                    deactivateon = row.deactivateon;   
                    if(deactivateon != "" && deactivateon != null){
                        deactivateon = $.date(deactivateon);
                    }
                    $("#deactivateDate").val(deactivateon);
                    $("#isDeactivate").val(row.isdeactivate);
                    $("#isEnabledLeaderboard").val(row.isenableleaderboard);
                    $("#moduleIds").val(row.moduleIds); 
                    
                    $("#form1").submit();                   
                });
                // delete row.
                deleteButton.click(function (event) {
                    gridId = "learningPlanGrid";
                    deleteUrl = "Actions/LearningProfileAction.php?call=deleteLearningProfile";
                    deleteRows(gridId,deleteUrl);
                });
               
                
            }
        });
        
    }
</script>
