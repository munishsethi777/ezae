<?include("sessioncheck.php");?>
<html>
<head>
<?include "ScriptsInclude.php"?>

<!-- iCheck -->
<link href="styles/plugins/iCheck/custom.css" rel="stylesheet">

<script type="text/javascript">
    $(document).ready(function(){
        WinMove();
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green'
        })
        loadFieldBlocks();
    })
    function loadFieldBlocks(){
        var url = 'ajaxAdminMgr.php?call=getLearnersFieldsForFormManagement';
        $.get(url, function(data){
            $("#customFieldsBlock").append(data);
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green'
            })
        });
    }
</script>
</head>
<body class='default'>
    <div id="wrapper wrapper-content animated fadeInRight">
        <?include("adminMenu.php");?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Manage Learner's registration form settings</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a>Learners</a>
                    </li>
                    <li class="active">
                        <strong>Manage Registration Form</strong>
                    </li>
                </ol>
            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeIn">
            <p>You may drag and drop various field sections to maintain the sequance of registration form fields.</p>
            <div class="col-lg-12" id="customFieldsBlock">

            </div>
        </div>
</body>
</html>
