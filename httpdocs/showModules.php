<?
    //require_once('IConstants.inc');
    //require_once($ConstantsArray['dbServerUrl'] ."Managers\\UserMgr.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    
<link rel="stylesheet" href="jqwidgets/styles/jqx.base.css" type="text/css" />
<link rel="stylesheet" href="jqwidgets/styles/jqx.office.css" type="text/css" />
<script type="text/javascript" src="scripts/jquery-1.10.2.min.js"></script>  
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
            var url = 'ajaxModuleMgr.php5?call=getModulesForGrid';
            $.getJSON(url, function(data){
                loadGrid(data);
            });
        });
        function loadGrid(data){   
            var columns = $.parseJSON(data.columns);
            var rows = $.parseJSON(data.data);
            var source =
            {
                datatype: "json",
                id: 'id',
                 localData: rows
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#jqxgrid").jqxGrid(
            {
                theme:'office',
                width: 1200,
                height:600,
                source: dataAdapter,
                filterable: true,
                sortable: true,
                autoshowfiltericon: true,
                columns: columns
            }); 
        }
    </script>
</head>
<body class='default'>
    <div id='jqxWidget' style="font-size: 13px; font-family: Verdana; float: left;">
        <div id="jqxgrid">
        </div>
     </div>
</body>
</html>
