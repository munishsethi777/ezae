<?include("sessioncheck.php");?>
<html>
<head>
<?include "ScriptsInclude.php"?>

<script type="text/javascript">
    $(document).ready(function (){
        theme = "arctic";
        loadLearningPlansCombo(); 
       // loadModulesCombo();
        //var value = $("#trainingsCombo").val();
        //var url = 'Actions/ActivityAction.php?call=getActivityHeadersForGrid&moduleSeq='+ value;
        //$.getJSON(url, function(data){
            //loadGrid(data,value);
            //loadColsList(data.columns);
        //});
        
        var exportInfo;
        $("#excelExport").jqxButton({ theme: theme, width:200 });
        $("#csvExport").jqxButton({ theme: theme , width:200});
        $("#htmlExport").jqxButton({ theme: theme , width:200});
        $("#excelExport").click(function () {
             $("#jqxgrid").jqxGrid('exportdata', 'xls',jqxgrid,true,null,true,'save-file.php');
        });
        $("#csvExport").click(function () {
            $("#jqxgrid").jqxGrid('exportdata', 'csv',jqxgrid,true,null,true,'save-file.php');
        });
        $("#htmlExport").click(function () {
            $("#jqxgrid").jqxGrid('exportdata', 'html',jqxgrid,true,null,true,'save-file.php');
        });

    });
    function loadGrid(data,value,learningPlanSeq){
        var columns = Array();
        var rows = Array();
        var dataFields = Array();
        if(data != null){
            columns = $.parseJSON(data.columns);
            dataFields = $.parseJSON(data.datafields);
        }
        var source =
        {
            datatype: "json",
            id: 'id',
            pagesize: 20,
            datafields: dataFields,
            url : 'Actions/ActivityAction.php?call=getActivityDataForGrid&moduleSeq='+ value +'&lpSeq='+learningPlanSeq,
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
            columnsreorder: true ,
            virtualmode: true,
            rendergridrows: function()
            {
                  return dataAdapter.records;
            }
        });
    }

    function loadColsList(columns){
        var listSource = new Array;
        var columnsJson = $.parseJSON(columns);
        if(columnsJson != null){
            $.each(columnsJson ,function(index,value){
                listSource.push($.parseJSON('{"label":"'+ this.text +'", "value": "'+ this.datafield +'", "checked":true}'));
            });
        }
        $("#jqxUserCustomFieldslistbox").jqxListBox({theme:'arctic', source: listSource, width: '100%', height: '300',  checkboxes: true });
        $("#jqxUserCustomFieldslistbox").on('checkChange', function (event) {
            $("#jqxgrid").jqxGrid('beginupdate');
            if (event.args.checked) {
                $("#jqxgrid").jqxGrid('showcolumn', event.args.value);
            }else {
                $("#jqxgrid").jqxGrid('hidecolumn', event.args.value);
            }
            $("#jqxgrid").jqxGrid('endupdate');
        });
    }
    function loadLearningPlansCombo(){
            var source =
            {
                datatype: "json",
                datafields: [
                { name: 'id'},
                { name: 'title'}
                ],
                url: 'Actions/LearningPlanAction.php?call=getLearnerPlansForReporting',
                async: true
            };

            var dataAdapter = new $.jqx.dataAdapter(source);

            $("#learningPlanComboBox").jqxComboBox({
                source: dataAdapter,
                width: '300',
                height: 25,
                selectedIndex: 0,
                displayMember: 'title',
                valueMember: 'id',
                theme: 'arctic'
            });
            $('#learningPlanComboBox').on('change', function (event){
                var args = event.args;
                if (args) {
                   var item = args.item;
                   loadModulesCombo(item.value);
                }
            });

        }
        function loadModulesCombo(learningPlanSeq){
            var source1 =
            {
                datatype: "json",
                datafields: [
                { name: 'id'},
                { name: 'title'}
                ],
                url: 'Actions/ModuleAction.php?call=getModulesByLearningPlanForReporting&learningPlanSeq='+learningPlanSeq,
                async: true
            };

            var dataAdapter1 = new $.jqx.dataAdapter(source1);

            $("#trainingsCombo").jqxComboBox({
                source: dataAdapter1,
                width: '300',
                height: 25,
                selectedIndex: 0,
                displayMember: 'title',
                valueMember: 'id',
                theme: 'arctic'
            });
            
             $('#trainingsCombo').on('change', function (event)
             {
            var args = event.args;
            if (args) {
                var value = args.item.value;
                var url = 'Actions/ActivityAction.php?call=getActivityHeadersForGrid&moduleSeq='+ value;
                $.getJSON(url, function(data){
                    learningPlanSeq = $("#learningPlanComboBox").jqxComboBox('getSelectedItem');
                    loadGrid(data,value,learningPlanSeq.value);
                    loadColsList(data.columns);
                });

            }
        });
        
        }
   // function loadModulesCombo(){
//        var source =
//        {
//            datatype: "json",
//            datafields: [
//            { name: 'id'},
//            { name: 'title'}
//            ],
//            url: 'Actions/ModuleAction.php?call=getModulesForGrid',
//            async: false
//        };

//        var dataAdapter = new $.jqx.dataAdapter(source);

//        $("#trainingsCombo").jqxComboBox(
//        {
//            source: dataAdapter,
//            width: '100%',
//            height: 25,
//            selectedIndex: 0,
//            displayMember: 'title',
//            valueMember: 'id',
//            theme: 'arctic'
//        });

//       
//    }

    //function not in use right now
    function loadModulesList(trainingsJson){
        var listSource = new Array;
        if(trainingsJson != null){
            $.each(trainingsJson ,function(index,value){
                listSource.push($.parseJSON('{"label":"'+ this.title +'", "value": "'+ this.id +'", "checked":true}'));
            });
        }
        $("#jqxModuleslistbox").jqxListBox({theme:'arctic', source: listSource, width: '160px', height: 300,  checkboxes: true });

        $("#jqxModuleslistbox").on('checkChange', function (event) {
            $("#jqxgrid").jqxGrid('beginupdate');
            if (event.args.checked) {
                $("#jqxgrid").jqxGrid('showcolumn', event.args.value);
            }else {
                $("#jqxgrid").jqxGrid('hidecolumn', event.args.value);
            }
            $("#jqxgrid").jqxGrid('endupdate');
        });
    }
</script>
</head>
<body class='default'>
<div id="wrapper">
    <?include("adminMenu.php");?>
    <div style="height:50px;"> 
            <div style="float:left;margin-top:5px;margin-right:6px;">Learning Plan : </div>
            <div style="float:left" id="learningPlanComboBox"></div>
            <div style="float:left;margin-top:5px;margin-right:6px;">Module : </div>
            <div style="float:left" id="trainingsCombo"></div>
    </div>
        <div class="col-sm-2">    
            <div id="jqxUserCustomFieldslistbox"></div>
        </div>
        <div class="col-sm-10">
            <div id="jqxgrid"></div>
        </div>
    </div>
    <div style="margin:12px;">
        <input type="button" class="col-sm-1" value="Export to Excel" id='excelExport' />
        <input style="margin-left:8px;" type="button" class="col-sm-1" value="Export to CSV" id='csvExport' />
        <input style="margin-left:8px;" type="button" class="col-sm-1" value="Export to HTML" id='htmlExport' />
    </div>
</div>
</body>
</html>
