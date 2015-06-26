<?include("sessioncheck.php");?>
<html>
<head>
<?include "ScriptsInclude.php"?>
<script type="text/javascript">
    $(document).ready(function(){
      //  var url = 'Actions/LearningProfileAction.php?call=getLearnerProfilesForGrid';
//                $.getJSON(url, function(data){
                loadGrid();
        //});
        $('#learningProfileForm').jqxValidator({
            hintType: 'label',
            animationDuration: 0,
            rules: [
               { input: '#name', message: 'Profile Name is required!', action: 'keyup, blur', rule: 'required' }
               ]
        });

         $("#saveBtn").click(function(e){
                ValidateAndSave(e,this);
            });

            $("#saveNewBtn").click(function(e){
                ValidateAndSave(e,this);
         });

        $("#customFieldForm").on('validationSuccess', function () {
            $("#createCompanyForm-iframe").fadeIn('fast');
        });
    })

    function ValidateAndSave(e,btn){
        var validationResult = function (isValid) {
            if (isValid) {
                saveLearningProfile(e,btn);
            }
        }
        $('#learningProfileForm').jqxValidator('validate', validationResult);
    }

    function saveLearningProfile(e,btn){
            e.preventDefault();
            var l = Ladda.create(btn);
            l.start();
             $('#learningProfileForm').ajaxSubmit(function( data ){
                   l.stop();
                   var obj = $.parseJSON(data);
                   var dataRow = "";
                   if(obj.success == 1){
                        var dataRow = $.parseJSON(obj.row);
                        var id = $("#id").val();
                       if(id != "0"){
                           var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                           $("#jqxgrid").jqxGrid('updaterow', id, dataRow);
                       }else{
                         $("#jqxgrid").jqxGrid('addrow', null, dataRow);
                       }
                   }
                   if(btn.id == "saveBtn"){
                     showResponseToastr(data,"createNewModalForm","learningProfileForm","mainDiv");
                  }else{
                     showResponseNotification(data,"mainDiv","learningProfileForm");
                  }
             })
     }

    function loadGrid(){
        var columns = [
          { text: 'id', datafield: 'id' , hidden:true},
          { text: 'Profile Name' , datafield: 'tag', width: 250 },
          { text: 'Description', datafield: 'description' },
          { text: 'Icon', datafield: 'awesomefontid' },
          { text: 'Modified On', datafield: 'lastmodifiedon' ,cellsformat: 'MM-dd-yyyy hh:mm:ss tt' }
        ]
       // var rows = Array();
//        var dataFields = Array();
//        if(data != null){
//            rows = $.parseJSON(data.data);
//        }
        var source =
        {
            datatype: "json",
            id: 'id',
            pagesize: 20,
            //localData: rows,
            datafields: [
                { name: 'id', type: 'integer' },
                { name: 'tag', type: 'string' },
                { name: 'description', type: 'string' },
                { name: 'awesomefontid', type: 'string' },
                { name: 'lastmodifiedon', type: 'date' }
            ],
            url: 'Actions/LearningProfileAction.php?call=getLearnerProfilesForGrid',
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
                    $("#saveNewBtnDiv").show();
                    $("#msgDiv").remove();
                    $("#errorDiv").remove();
                    $("#id").val("0");
                    $("#learningProfileForm")[0].reset();
                    $('#createNewModalForm').modal('show');
                });
                // update row.
                editButton.click(function (event){
                    $("#saveNewBtnDiv").hide();
                    $("#msgDiv").remove();
                    $("#errorDiv").remove();
                    $("#learningProfileForm")[0].reset();
                    var selectedrowindex = $("#jqxgrid").jqxGrid('selectedrowindexes');
                    if(selectedrowindex.length != 1){
                        bootbox.alert("Please Select single row for edit.", function() {});
                        return;
                    }
                    var row = $('#jqxgrid').jqxGrid('getrowdata', selectedrowindex);
                    $("#id").val(row.id);
                    $("#name").val(row.tag);
                    $("#description").val(row.description);
                    $('#createNewModalForm').modal('show');
                    var selectedAwFont = $('#icon' + row.id).attr('class').replace("fa ","");
                    if(selectedAwFont != ""){
                        $("#awesomeFontId").val(selectedAwFont);
                    }
                });
                // delete row.
                deleteButton.click(function (event) {
                    gridId = "jqxgrid"
                    deleteUrl = "Actions/LearningProfileAction.php?call=deleteLearningProfile";
                    deleteRows(gridId,deleteUrl);
                });

            }
        });
    }

</script>
</head>
<body class='default'>
    <div id="wrapper">
        <?include("adminMenu.php");?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Manage Learner's Profiles</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a>Learners</a>
                    </li>
                    <li class="active">
                        <strong>Manage Learner's Profile</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="adminSingup animated fadeInRight">
        <div class="row">
            <div class="col-lg-12" >
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Manage Learner's Profiles</h5>
                    </div>
                    <div class="ibox-content">
                        <div  id="jqxgrid"></div>
                        <div id="createNewModalForm" class="modal fade" aria-hidden="true">
                            <div class="modal-dialog" >
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Create/Edit Custom Fields</h4>
                                    </div>
                                    <div class="modal-body mainDiv">
                                        <div class="row" >
                                            <div class="col-sm-12">
                                                <form  role="form" method="post" action="Actions/LearningProfileAction.php" id="learningProfileForm" class="form-horizontal">
                                                    <input type="hidden" id="call" name="call" value="saveLearningProfile">
                                                    <input type="hidden" id="id" name="id" value="0">
                                                    <div class="form-group">
                                                        <label>Profile Name</label>
                                                        <input type="text" id="name" name="name" placeholder="Profile Name" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <input type="text" id="description" name="description" placeholder="Description" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Icons</label>
                                                         <select class="form-control" id="awesomeFontId" name="awesomeFontId" style="font-family: 'FontAwesome', Helvetica;">
                                                            <option value="fa-medium">&#xf23a; Medium</option>
                                                            <option value="fa-sellsy">&#xf213; Sellsy</option>
                                                            <option value="fa-diamond">&#xf219; Diamond</option>
                                                            <option value="fa-user-secret">&#xf21b; Secret</option>
                                                            <option value="fa-venus">&#xf221; Venus</option>
<                                                        </select>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary ladda-button" data-style="expand-right" id="saveBtn" type="button">
                                                            <span class="ladda-label">Save</span>
                                                        </button>
                                                        <span id="saveNewBtnDiv"><button class="btn btn-primary ladda-button" data-style="expand-right" id="saveNewBtn" type="button">
                                                            <span class="ladda-label">Save & New</span>
                                                        </button></span>
                                                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
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
            </div>
        </div>
    </div>
</body>
</html>
