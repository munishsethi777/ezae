<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/RoleType.php");
$action = "CompanyAction.php";
$sessionUtil = SessionUtil::getInstance();
$adminSeq = $sessionUtil->getAdminLoggedInSeq();
$path = "images/AdminImages/" . $adminSeq . ".png";
$role = $sessionUtil->getLoggedInRole();
$userName = null;
$userRole = strtoupper($role) ." : ";
if($role == RoleType::ADMIN || $role == RoleType::MANAGER){
    $userName = $sessionUtil->getAdminLoggedInName();
    $userRole .= $sessionUtil->getAdminLoggedInCompanyName();
}elseif($role == RoleType::USER){
    $userName = $sessionUtil->getUserLoggedInName();
    $userRole .= $sessionUtil->getUserLoggedInCompanyName();
}
if(!file_exists ($path)){
    $path = "images/dummy.jpg";
}?>
<?include "UpdateProfilePicture.php"?>
<?
    $page = basename($_SERVER['PHP_SELF']);
    $dashboard = null;
    $customFields = null;
    $manageLeaderBoard = null;
    $adminModulesManagement = null;
    $myModules = null;
    $learningPlans = null;
    $createLearningPlan = null;
    $manageLearningPlan = null;
    $reporting = null;
    $adminCompletionMetrics = null;
    $adminComparativeMetrics = null;
    $analytics = null;
    $importLearners = null;
    $manageLearners = null;
    $manageRegistrationForm = null;
    $manageLearnerProfiles = null;
    $manageMessages = null;
    $createMessage = null;
    $messageLogs = null;
    $notificaitons = null;
    $company = null;
    $adminManagers = null;

    if($page == "dashboard.php"){
        $dashboard = "active";
    }elseif($page == "CustomFields.php"){
        $customFields = "active";
    }elseif($page == "ManageLeaderBoard.php"){
        $manageLeaderBoard = "active";
    }elseif($page == "adminModulesManagement.php"){
        $adminModulesManagement = "active";
        $myModules = "active";
    }elseif($page == "adminCreateModule.php"){
        $adminModulesManagement = "active";
        $adminCreateModule = "active";
    }elseif($page == "createLearningPlan.php"){
        $learningPlans = "active";
        $createLearningPlan = "active";
    }elseif($page == "ManageLearningPlan.php"){
        $learningPlans = "active";
        $manageLearningPlan = "active";
    }elseif($page == "adminCompletionMetrics.php"){
        $reporting = "active";
        $adminCompletionMetrics = "active";
    }elseif($page == "adminPerformanceMetrics.php"){
        $reporting = "active";
        $adminPerformanceMetrics = "active";
    }elseif($page == "adminComparativeMetrics.php"){
        $reporting = "active";
        $adminComparativeMetrics = "active";
    }elseif($page == "analytics.php"){
        $reporting = "active";
        $analytics = "active";
    }elseif($page == "importLearners.php"){
        $learners = "active";
        $importLearners = "active";
    }elseif($page == "manageLearners.php"){
        $learners = "active";
        $manageLearners = "active";
    }elseif($page == "manageRegistrationForm.php"){
        $learners = "active";
        $manageRegistrationForm = "active";
    }elseif($page == "manageLearnerProfiles.php"){
        $learners = "active";
        $manageLearnerProfiles = "active";
    }elseif($page == "manageMessages.php"){
        $communications = "active";
        $manageMessages = "active";
    }elseif($page == "createMessage.php"){
        $communications = "active";
        $createMessage = "active";
    }elseif($page == "showMessageLogs.php"){
        $communications = "active";
        $messageLogs = "active";
    }
    elseif($page == "notifications.php"){
        $notificaitons = "active";
    }elseif($page == "adminManagers.php"){
        $company = "active";
        $adminManagers = "active";
    }

?>
<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <div id="profilePicDiv">


                                <img alt="image" id="profilePicImg" class="img-circle" width="80px;" src="<?echo($path)?>"/>
                            </div>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                                    <span class="block m-t-xs"> <strong class="font-bold"><? echo $userName;?></strong></span>
                                    <span class="text-muted text-xs block"><?echo $userRole;?> <b class="caret"></b></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="#openUploader" onclick="openUploader()">Update Profile Picture</a></li>
                                <li><a href="AdminSettings.php">Profile</a></li>
                                <li><a href="ChangePasswordForm.php">Change Password</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            EZAE
                        </div>
                    </li>
                    <?if($role == RoleType::ADMIN){?>
                        <li class="<?=$dashboard?>">
                            <a href="dashboard.php"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
                        </li>
                        <li class="<?=$manageLeaderBoard?>">
                            <a href="ManageLeaderBoard.php"><i class="fa fa-angellist"></i> <span class="nav-label">LeaderBoards</span></a>
                        </li>
                        <li class="<?=$adminModulesManagement?>">
                            <a href="#"><i class="fa fa-group"></i> <span class="nav-label">Learning Modules</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li class="<?=$adminCreateModule?>"><a href="adminCreateModule.php">Create New Module</a></li>
                                <li class="<?=$myModules?>"><a href="adminModulesManagement.php">My Modules</a></li>
                            </ul>
                        </li>
                        <li class="<?=$learningPlans?>">
                            <a href="layouts.html"><i class="fa fa-gift"></i> <span class="nav-label">Learning Plans</span></a>
                            <ul class="nav nav-second-level">
                                <li class="<?=$createLearningPlan?>"><a href="createLearningPlan.php">Create Learning Plan</a></li>
                                <li class="<?=$manageLearningPlan?>"><a href="ManageLearningPlan.php">View Learning Plans</a></li>
                            </ul>
                        </li>
                    <?}?>
                    <li class="<?=$reporting?>">
                        <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Reporting</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="<?=$adminCompletionMetrics?>"><a href="adminCompletionMetrics.php">Completion Metrics</a></li>
                            <li class="<?=$adminPerformanceMetrics?>"><a href="adminPerformanceMetrics.php">Performance Metrics</a></li>
                            <li class="<?=$adminComparativeMetrics?>"><a href="adminComparativeMetrics.php">Comparative Metrics</a></li>
                            <li class="<?=$analytics?>"><a href="analytics.php">Progress Analytics</a></li>
                        </ul>
                    </li>
                    <?if($role == RoleType::ADMIN){?>
                        <li class="<?=$learners?>">
                            <a href="#"><i class="fa fa-group"></i> <span class="nav-label">Learners</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li class="<?=$importLearners?>"><a href="importLearners.php">Import</a></li>
                                <li class="<?=$manageLearners?>"><a href="manageLearners.php">Manage learners</a></li>
                                <li class="<?=$manageRegistrationForm?>"><a href="manageRegistrationForm.php">Registration Form</a></li>
                                <li class="<?=$manageLearnerProfiles?>"><a href="manageLearnerProfiles.php">Learner's Profiles</a></li>
                                <li class="<?=$customFields?>"><a href="CustomFields.php">Manage Custom Fields</a></li>
                            </ul>
                        </li>
                        <li class="<?=$communications?>">
                            <a href="manageMessages.php"><i class="fa fa-send"></i> <span class="nav-label">Communications</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li class="<?=$manageMessages?>"><a href="manageMessages.php">Manage Messages</a></li>
                                <li class="<?=$createMessage?>"><a href="createMessage.php">Create Message</a></li>
                                 <li class="<?=$messageLogs?>"><a href="showMessageLogs.php">Message Logs</a></li>
                            </ul>
                        </li>
                        <li class="<?=$company?>">
                            <a href="#"><i class="fa fa-life-ring"></i> <span class="nav-label">Company</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="form_basic.html">Company Profile</a></li>
                                <!--<li><a href="form_advanced.html">Administrators</a></li>-->
                                <li class="<?=$adminManagers?>"><a href="adminManagers.php">Managers</a></li>
                            </ul>
                        </li>
                    <?}?>
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