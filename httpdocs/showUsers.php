<?include("adminMenu.php");?>
<!DOCTYPE html>
<html lang="en">
<head>

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
<script type="text/javascript">
        $(document).ready(function (){
            var url = 'ajaxAdminMgr.php?call=getUsersForGrid';
            $.getJSON(url, function(data){
                loadGrid(data);
                loadColsList(data.columns);
            });
        });
        function loadGrid(data){
            var columns = $.parseJSON(data.columns);
            var rows = $.parseJSON(data.data);
            var source =
            {
                datatype: "json",
                id: 'id',
                pagesize: 20,
                localData: rows
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#jqxgrid").jqxGrid(
            {
                theme:'arctic',
                width: '1400',
                height: '600px',
                source: dataAdapter,
                filterable: true,
                sortable: true,
                autoshowfiltericon: true,
                columns: columns,
                pageable: true,
                autoheight: true,
                altrows: true,
                enabletooltips: true,
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
            $("#jqxlistbox").jqxListBox({theme:'arctic', source: listSource, width: '160px', height: 580,  checkboxes: true });
            $("#jqxlistbox").on('checkChange', function (event) {
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

    <div id='jqxWidget' style="font-size: 13px; font-family: Verdana; float: left;">

        <div style="float:left" id="jqxlistbox"></div>
        <div style="float:left;margin-left:20px" id="jqxgrid"></div>
     </div>
</body>
</html>
