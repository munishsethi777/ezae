<? include("sessioncheck.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administration - Easy Assessment Engine</title>
<script src="scripts/jquery-2.1.1.js"></script>
<link rel="stylesheet" href="jqwidgets/styles/jqx.base.css" type="text/css" />
<link rel="stylesheet" href="jqwidgets/styles/jqx.arctic.css" type="text/css" />
<script type="text/javascript" src="jqwidgets/jqxcore.js"></script>
<script type="text/javascript" src="jqwidgets/jqxbuttons.js"></script>
<script type="text/javascript" src="jqwidgets/jqxscrollbar.js"></script>
<script type="text/javascript" src="jqwidgets/jqxlistbox.js"></script>
<script type="text/javascript" src="jqwidgets/jqxdropdownlist.js"></script>
<script type="text/javascript" src="jqwidgets/jqxmenu.js"></script>
<script type="text/javascript" src="jqwidgets/jqxdata.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.sort.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.selection.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.pager.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.filter.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.columnsreorder.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.columnsresize.js"></script>
<script type="text/javascript" src="jqwidgets/jqxdata.export.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.export.js"></script>

<script type="text/javascript" src="jqwidgets/jqxcombobox.js"></script>
<link type="text/css" href="styles/bootstrap.css" rel="stylesheet" />

<script type="text/javascript">
        $(document).ready(function (){
            theme = "arctic";
            loadGrid(null);
            loadModulesCombo();
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
        function loadGrid(data){
            var columns = Array();
            var rows = Array();
            var dataFields = Array();
            if(data != null){
                columns = $.parseJSON(data.columns);
                rows = $.parseJSON(data.data);
                dataFields = $.parseJSON(data.datafields);
            }
            var source =
            {
                datatype: "json",
                id: 'id',
                pagesize: 20,
                localData: rows,
                datafields: dataFields
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#jqxgrid").jqxGrid(
            {
                theme:'arctic',
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
                columnsreorder: true
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

        function loadModulesCombo(){
            var source =
            {
                datatype: "json",
                datafields: [
                { name: 'id'},
                { name: 'title'}
                ],
                url: 'ajaxAdminMgr.php?call=getModulesJson',
                async: false
            };

            var dataAdapter = new $.jqx.dataAdapter(source);

            $("#trainingsCombo").jqxComboBox(
            {
                source: dataAdapter,
                width: '100%',
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
                    var url = 'ajaxAdminMgr.php?call=getActivityDataForGrid&moduleSeq='+ value;
                    $.getJSON(url, function(data){
                        loadGrid(data);
                        loadColsList(data.columns);
                    });

                }
            });
            $("#trainingsCombo").jqxComboBox('clearSelection');
            $("#trainingsCombo").jqxComboBox('selectIndex', 0 );
        }

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
    <div style="height:550px;">
        <div class="col-sm-2">
            <div style="margin-bottom:10px;" id="trainingsCombo"></div>
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
