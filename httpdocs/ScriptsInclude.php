        <link href="styles/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="styles/animate.css" rel="stylesheet">
        <link href="styles/style.css" rel="stylesheet">
        <link href="styles/custom.css" rel="stylesheet">
        <link href="styles/toastr.min.css" rel="stylesheet">
        <link href="styles/plugins/steps/jquery.steps.css" rel="stylesheet">
        <link href="styles/toastr.min.css" rel="stylesheet">
        
        <script type="text/javascript" src="scripts/jquery-1.10.2.min.js"></script>     
        <script src="scripts/bootstrap.min.js"></script>
        <script src="scripts/jquery.metisMenu.js"></script>
        <script src="scripts/bootbox.js"></script>       
        <script src="scripts/bootstrap.min.js"></script>
        <script src="scripts/jquery.metisMenu.js"></script>          
         <script src="scripts/example.js"></script> 
         <script src="scripts/bootbox.js"></script>
         <!-- Custom and plugin javascript -->
        <script src="scripts/inspinia.js"></script>
        <script src="scripts/toastr.min.js"></script>
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
        <script type="text/javascript" src="jqwidgets/jqxgrid.edit.js"></script>
        <script type="text/javascript" src="jqwidgets/jqxgrid.sort.js"></script>
        <script type="text/javascript" src="jqwidgets/jqxgrid.selection.js"></script>
        <script type="text/javascript" src="jqwidgets/jqxgrid.pager.js"></script>
        <script type="text/javascript" src="jqwidgets/jqxgrid.filter.js"></script>
        <script type="text/javascript" src="jqwidgets/jqxgrid.columnsreorder.js"></script>
        <script type="text/javascript" src="jqwidgets/jqxgrid.columnsresize.js"></script>
        <script type="text/javascript" src="jqwidgets/jqxdata.export.js"></script>
        <script type="text/javascript" src="jqwidgets/jqxgrid.export.js"></script>
        <script type="text/javascript" src="jqwidgets/jqxvalidator.js"></script>   
        <script type="text/javascript" src="jqwidgets/jqxlistbox.js"></script>
        <script type="text/javascript" src="jqwidgets/jqxcombobox.js"></script>
        <script type="text/javascript" src="jqwidgets/jqxcheckbox.js"></script>
        <script type="text/javascript" src="jqwidgets/jqxdraw.js"></script>
        <script type="text/javascript" src="jqwidgets/jqxchart.core.js"></script>
        <script type="text/javascript" src="jqwidgets/jqxnumberinput.js"></script>
        <script type="text/javascript" src="jqwidgets/jqxinput.js"></script>
        <link rel="stylesheet" href="styles/ladda-themeless.min.css">
        <script src="scripts/jquery.form.min.js"></script>
        <script src="scripts/spin.min.js"></script>
        <script src="scripts/ladda.min.js"></script>
        <link href="styles/plugins/iCheck/custom.css" rel="stylesheet">
        <!-- Steps -->
        <script src="scripts/plugins/staps/jquery.steps.min.js"></script>
        <!-- Jquery Validate -->
        <script src="scripts/plugins/validate/jquery.validate.min.js"></script>
        <!-- iCheck -->
        <script src="scripts/plugins/iCheck/icheck.min.js"></script>

        <script>
            $(function() {
               toastr.options = {
                      "closeButton": true,
                      "debug": false,
                      "progressBar": true,
                      "positionClass": "toast-top-center",
                      "onclick": null,
                      "showDuration": "400",
                      "hideDuration": "1000",
                      "timeOut": "7000",
                      "extendedTimeOut": "1000",
                      "showEasing": "swing",
                      "hideEasing": "linear",
                      "showMethod": "fadeIn",
                      "hideMethod": "fadeOut"
                      }
            });
            function showResponseDiv(data,divClassName){
                var obj = $.parseJSON(data);
                var message = obj.message;              
                $("#msgDiv").remove(); 
                $("#errorDiv").remove(); 
                if(obj.success == 1){
                    var statusDiv = '<div id="msgDiv" class="alert alert-success alert-dismissable">';
                    statusDiv += '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>';
                    statusDiv += obj.message;
                    statusDiv += '</div>';                    
                    $("." + divClassName).append(statusDiv);
                }else{
                    var errorDiv = '<div id="errorDiv" class="alert alert-danger alert-dismissable">';
                    errorDiv += '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>';
                    errorDiv += obj.message;
                    errorDiv += '</div>';
                    $("." + divClassName).append(errorDiv);
                }                                  
            }
         </script>
