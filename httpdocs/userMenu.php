
<!-- Mainly scripts -->

<script src="scripts/bootstrap.min.js"></script>
<script src="scripts/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="scripts/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<!-- Toastr style -->
<link href="styles/plugins/toastr/toastr.min.css" rel="stylesheet">
<!--Bootstrap-->
<link href="styles/bootstrap.min.css" rel="stylesheet">
<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="styles/animate.css" rel="stylesheet">
<link href="styles/style.css" rel="stylesheet">

<!-- Toastr style -->
<link href="styles/plugins/toastr/toastr.min.css" rel="stylesheet">

<!-- Gritter -->
<link href="scripts/plugins/gritter/jquery.gritter.css" rel="stylesheet">

<!-- Flot -->
<script src="scripts/plugins/flot/jquery.flot.js"></script>
<script src="scripts/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="scripts/plugins/flot/jquery.flot.spline.js"></script>
<script src="scripts/plugins/flot/jquery.flot.resize.js"></script>
<script src="scripts/plugins/flot/jquery.flot.pie.js"></script>

<!-- Peity -->
<script src="scripts/plugins/peity/jquery.peity.min.js"></script>
<script src="scripts/demo/peity-demo.js"></script>

<!-- Custom and plugin javascript -->
<script src="scripts/inspinia.js"></script>
<script src="scripts/plugins/pace/pace.min.js"></script>

<!-- jQuery UI -->
<script src="scripts/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- GITTER -->
<script src="scripts/plugins/gritter/jquery.gritter.min.js"></script>

<!-- Sparkline -->
<script src="scripts/plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- Sparkline demo data  -->
<script src="scripts/demo/sparkline-demo.js"></script>

<!-- ChartJS-->
<script src="scripts/plugins/chartJs/Chart.min.js"></script>

<!-- Toastr -->
<script src="scripts/plugins/toastr/toastr.min.js"></script>
<?php
$action = "UserAction.php";  
$sessionUtil = SessionUtil::getInstance();
$userSeq =  $sessionUtil->getUserLoggedInSeq();
$userName =  $sessionUtil->getUserLoggedInName();
$path = "images/UserImages/" . $userSeq . ".png";
if(!file_exists ($path)){
    $path = "images/dummy.jpg";    
}?>
<?include "UpdateProfilePicture.php"?> 

<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> 
                            <div id="profilePicDiv">
                                <img alt="image" id="profilePicImg" class="img-circle" width="50px;" src="<?echo($path)?>"/>
                            </div>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?echo $userName?></strong>
                             </span> <span class="text-muted text-xs block">Administrator - JCB <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="#openUploader" onclick="openUploader()">Update Profile Picture</a></li>
                                <li><a href="UserSettings.php">Profile</a></li>
                                <li><a href="UserChangePassword.php">Change Password</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            EZAE
                        </div>
                    </li>
                    <li>
                        <a href="UserDashboard.php"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
                    </li>
                     
                    <li>
                        <a href="layouts.html"><i class="fa fa-archive"></i> <span class="nav-label">Modules Management</span></a>
                    </li>
                    <li>
                        <a href="layouts.html"><i class="fa fa-gift"></i> <span class="nav-label">Learning Plans</span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="createLearningPlan.php">Create Learning Plan</a></li>
                            <li><a href="ManageLearningPlan.php">View Learning Plans</a></li>
                        </ul>
                    </li>
                    
                    
                   
                </ul>

            </div>
        </nav>

<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                <form role="search" class="navbar-form-custom" method="post" action="search_results.html">
                    <div class="form-group">
                        <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                    </div>
                </form>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                        </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="profile.html" class="pull-left">
                                        <img alt="image" class="img-circle" src="img/a7.jpg">
                                    </a>
                                    <div class="media-body">
                                        <small class="pull-right">46h ago</small>
                                        <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                        <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="profile.html" class="pull-left">
                                        <img alt="image" class="img-circle" src="img/a4.jpg">
                                    </a>
                                    <div class="media-body ">
                                        <small class="pull-right text-navy">5h ago</small>
                                        <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                        <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="profile.html" class="pull-left">
                                        <img alt="image" class="img-circle" src="img/profile.jpg">
                                    </a>
                                    <div class="media-body ">
                                        <small class="pull-right">23h ago</small>
                                        <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                        <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="text-center link-block">
                                    <a href="mailbox.html">
                                        <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="mailbox.html">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="profile.html">
                                    <div>
                                        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                        <span class="pull-right text-muted small">12 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="grid_options.html">
                                    <div>
                                        <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="text-center link-block">
                                    <a href="notifications.html">
                                        <strong>See All Alerts</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>


                    <li>
                        <a href="logout.php">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>
        </nav>
    </div>