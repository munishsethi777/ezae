        <link href="styles/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="styles/animate.css" rel="stylesheet">
        <link href="styles/style.css" rel="stylesheet">
        <link href="styles/custom.css" rel="stylesheet">
        <link href="styles/toastr.min.css" rel="stylesheet">
        <link href="styles/plugins/steps/jquery.steps.css" rel="stylesheet">
        <link href="styles/toastr.min.css" rel="stylesheet">
        <link href="styles/plugins/chosen/chosen.css" rel="stylesheet">  
        <link href="styles/plugins/summernote/summernote.css" rel="stylesheet">
        <link href="styles/plugins/summernote/summernote-bs3.css" rel="stylesheet"> 
         <link href="styles/plugins/cropper/cropper.min.css" rel="stylesheet"> 
        <link href="styles/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">
         <link href="styles/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">
          <link href="styles/jquery.datetimepicker.css" rel="stylesheet">
         
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
        <!-- Chosen -->
        <script src="scripts/plugins/chosen/chosen.jquery.js"></script>
        <script src="scripts/jquery.datetimepicker.js"></script> 
       
        <!-- SUMMERNOTE -->
        <script src="scripts/plugins/summernote/summernote.min.js"></script>
        <script src="scripts/plugins/cropper/cropper.min.js"></script>
        
        <script src="scripts/plugins/ckeditor/ckeditor.js"></script>
        <!--Common Scripts-->
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
                      "timeOut": "0",
                      "extendedTimeOut": "1000",
                      "showEasing": "swing",
                      "hideEasing": "linear",
                      "showMethod": "fadeIn",
                      "hideMethod": "fadeOut"
                      }
                      
                      $.date = function(dateObject) {
                        var d = new Date(dateObject);
                        var day = d.getDate();
                        var month = d.getMonth() + 1;
                        var year = d.getFullYear();
                        if (day < 10) {
                            day = "0" + day;
                        }
                        if (month < 10) {
                            month = "0" + month;
                        }
                        var date = day + "/" + month + "/" + year;
                       
                        
                        var time = formatAMPM(d);
                        return date + " " + time;
                      };
                      
                      
            });
            
            function formatAMPM(date) {
              var hours = date.getHours();
              var minutes = date.getMinutes();
              var ampm = hours >= 12 ? 'pm' : 'am';
              hours = hours % 12;
              hours = hours ? hours : 12; // the hour '0' should be '12'
              minutes = minutes < 10 ? '0'+minutes : minutes;
              var strTime = hours + ':' + minutes + ' ' + ampm;
              return strTime;
            }
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
            
            function showResponseNotification(data,divClassName,formId){
                var obj = $.parseJSON(data);
                var message = obj.message;              
                $("#msgDiv").remove(); 
                $("#errorDiv").remove(); 
                if(obj.success == 1){
                    var statusDiv = getStatusDiv(message)
                    $("." + divClassName).append(statusDiv);
                    $("#" + formId)[0].reset();
                }else{
                    var errorDiv = getErrorDiv(message);
                    $("." + divClassName).append(errorDiv);
                }                                  
            }
            
            
            function getErrorDiv(message){
                var errorDiv = '<div id="errorDiv" class="alert alert-danger alert-dismissable">';
                    errorDiv += '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>';
                    errorDiv += message;
                    errorDiv += '</div>';
                    return errorDiv;    
            }
            function getStatusDiv(message){
                 var statusDiv = '<div id="msgDiv" class="alert alert-success alert-dismissable">';
                    statusDiv += '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>';
                    statusDiv += message;
                    statusDiv += '</div>';
                    return statusDiv;    
            }
            function showResponseToastr(data,modelId,formId,divClassName){
                var obj = $.parseJSON(data);
                $("#msgDiv").remove(); 
                $("#errorDiv").remove(); 
                var message = obj.message;                
                if(obj.success == 1){
                    if(modelId != null){
                        $("#" + modelId).modal('hide');    
                    }
                    if(formId != null){
                        $("#" + formId)[0].reset();    
                    }
                    toastr.success(message); 
                }else{
                   var errorDiv = getErrorDiv(message);
                   $("." + divClassName).append(errorDiv);
                }                                   
            }
            function isInArray(value, array) {
                return array.indexOf(value) > -1;
            }
            
            function deleteRows(gridId,deleteURL){
                var selectedRowIndexes = $("#" + gridId).jqxGrid('selectedrowindexes');
                if(selectedRowIndexes.length > 0){
                    bootbox.confirm("Are you sure you want to delete selected row(s)?", function(result) {
                        if(result){
                            var ids = [];
                            $.each(selectedRowIndexes, function(index , value){
                                var dataRow = $("#" + gridId).jqxGrid('getrowdata', value);
                                ids.push(dataRow.id);
                            });
                            $.get( deleteURL + "&ids=" + ids,function( data ){
                                if(data != ""){
                                    var obj = $.parseJSON(data);
                                    var message = obj.message;
                                    if(obj.success == 1){
                                       
                                        toastr.success(message,'Success');
                                       //$.each(selectedRowIndexes, function(index , value){
                                          //  var id = $("#"  + gridId).jqxGrid('getrowid', value);
                                            var commit = $("#"  + gridId).jqxGrid('deleterow', ids);
                                            $("#"+gridId).jqxGrid('clearselection');                                           
                                        //});
                                    }else{
                                        toastr.error(message,'Failed');
                                    }
                                }
                                 
                            });
                           
                        }
                    });
                }else{
                     bootbox.alert("No row selected.Please select row to delete!", function() {});
                }

        }
       </script>
