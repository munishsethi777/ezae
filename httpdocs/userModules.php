<?include("userMenu.php");?>
<!DOCTYPE html>
<html>
<head>
<script>
    $(document).ready(function (){
        loadModules();
    });

    function loadModules(){
        var url = "ajaxModuleMgr.php?call=getModulesForLoggedInUser";
        $.getJSON(url, function(data){
            $.each(data,function(){
                $(".userModules").append(moduleHTML(this));
            });
        });
    }
    function moduleHTML(module){
        $str = '<div class="col-md-3">';
        $str += '<h4>'+ module.title +'</h4>';
        $str += '<p class="grey">'+ module.description +'</p>';
            $str += '<div class="panel-body">';
                $str += '<ul class="list-group">';
                $str += '<li class="list-group-item"><span class="badge">'+ module.createdon +'</span>Created On</li>';
                $str += '<li class="list-group-item"><span class="badge">'+ module.dateofexpiry +'</span>Expiring On</li>';
                if(module.isCompleted == 1){
                    $str += '<li class="list-group-item"><span class="badge active">'+ module.status +'</span>Status</li>';
                }else{
                    $str += '<li class="list-group-item">';
                    $str += '<form action="userTraining.php" method="POST">'
                    $str += '<input type="hidden" name="moduleSeq" value="'+ module.id +'"/>';
                    $str += '<input type="hidden" name="companySeq" value="'+ module.companyseq +'"/>';
                    $str += '<button type="submit" class="btn btn-primary btn-block">Play</button>';
                    $str += '</form>';
                    $str += '</li>';
                }
                $str += '</ul>';
            $str += '</div>';
        $str += '</div>';
        return $str
    }

</script>
<head>
<body>
    <div class="row userModules"></div>
</body>
</html>