<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/RoleType.php");
$action = "UserAction.php";
$sessionUtil = SessionUtil::getInstance();
$userSeq =  $sessionUtil->getUserLoggedInSeq();
$userName =  $sessionUtil->getUserLoggedInName();
$path = "images/UserImages/" . $userSeq . ".png";
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
                                <!--li><a href="UserSettings.php">Profile</a></li-->
                                <li><a href="UserChangePassword.php">Change Password</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            EZAE
                        </div>
                    </li>
                    <!--<li>
                        <a href="UserDashboard.php"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
                    </li>-->
                    <li>
                        <a href="userTrainings.php"><i class="fa fa-gift"></i> <span class="nav-label">Trainings</span></a>
                    </li>



                </ul>

            </div>
        </nav>

<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="logout.php">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>
        </nav>
    </div>