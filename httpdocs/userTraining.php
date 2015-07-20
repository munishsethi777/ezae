<?require("sessionCheckForUser.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administration - Easy Assessment Engine</title>
<?include "ScriptsInclude.php"?>

</head>


<body class='default'>

<div id="wrapper">
        <?include("userMenu.php");?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>Training Details</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="active">
                        <strong>Training Modules</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>All trainings assigned to munish</h5>

                        </div>
                        <div class="ibox-content">
                            <div class="row m-b-sm m-t-sm">
                                <div class="col-md-1">
                                    <button type="button" id="loading-example-btn" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i> Refresh</button>
                                </div>
                                <div class="col-md-11">
                                    <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                                </div>
                            </div>

                            <div class="project-list">

                                <table class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <td class="project-status">
                                            <span class="label label-primary">Active</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="project_detail.html">Contract with Zender Company</a>
                                            <br/>
                                            <small>Created 14.08.2014</small>
                                        </td>
                                        <td class="project-completion">
                                                <small>Completion with: 48%</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: 48%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                        <td class="project-people">
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/1.jpg"></a>
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/2.jpg"></a>
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/3.jpg"></a>
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/4.jpg"></a>
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/5.jpg"></a>
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/6.jpg"></a>
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/7.jpg"></a>
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/8.jpg"></a>
                                        </td>
                                        <td class="project-actions">
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="project-status">
                                            <span class="label label-primary">Active</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="project_detail.html">There are many variations of passages</a>
                                            <br/>
                                            <small>Created 11.08.2014</small>
                                        </td>
                                        <td class="project-completion">
                                            <small>Completion with: 28%</small>
                                            <div class="progress progress-mini">
                                                <div style="width: 28%;" class="progress-bar"></div>
                                            </div>
                                        </td>
                                        <td class="project-people">
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/7.jpg"></a>
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/6.jpg"></a>
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/9.jpg"></a>
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/1.jpg"></a>

                                        </td>
                                        <td class="project-actions">
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="project-status">
                                            <span class="label label-primary">Active</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="project_detail.html">Many desktop publishing packages and web</a>
                                            <br/>
                                            <small>Created 10.08.2014</small>
                                        </td>
                                        <td class="project-completion">
                                            <small>Completion with: 8%</small>
                                            <div class="progress progress-mini">
                                                <div style="width: 8%;" class="progress-bar"></div>
                                            </div>
                                        </td>
                                        <td class="project-people">
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/5.jpg"></a>
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/3.jpg"></a>

                                        </td>
                                        <td class="project-actions">
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="project-status">
                                            <span class="label label-primary">Active</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="project_detail.html">Letraset sheets containing</a>
                                            <br/>
                                            <small>Created 22.07.2014</small>
                                        </td>
                                        <td class="project-completion">
                                            <small>Completion with: 83%</small>
                                            <div class="progress progress-mini">
                                                <div style="width: 83%;" class="progress-bar"></div>
                                            </div>
                                        </td>
                                        <td class="project-people">
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/2.jpg"></a>
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/3.jpg"></a>
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/1.jpg"></a>
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/7.jpg"></a>

                                        </td>
                                        <td class="project-actions">
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="project-status">
                                            <span class="label label-default">Unactive</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="project_detail.html">Contrary to popular belief</a>
                                            <br/>
                                            <small>Created 14.07.2014</small>
                                        </td>
                                        <td class="project-completion">
                                            <small>Completion with: 97%</small>
                                            <div class="progress progress-mini">
                                                <div style="width: 97%;" class="progress-bar"></div>
                                            </div>
                                        </td>
                                        <td class="project-people">
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/5.jpg"></a>
                                        </td>
                                        <td class="project-actions">
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="project-status">
                                            <span class="label label-default">Unactive</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="project_detail.html">Contract with Zender Company</a>
                                            <br/>
                                            <small>Created 14.08.2014</small>
                                        </td>
                                        <td class="project-completion">
                                            <small>Completion with: 48%</small>
                                            <div class="progress progress-mini">
                                                <div style="width: 48%;" class="progress-bar"></div>
                                            </div>
                                        </td>
                                        <td class="project-people">
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/1.jpg"></a>
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/2.jpg"></a>
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/4.jpg"></a>
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/7.jpg"></a>

                                        </td>
                                        <td class="project-actions">
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="project-status">
                                            <span class="label label-primary">Active</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="project_detail.html">There are many variations of passages</a>
                                            <br/>
                                            <small>Created 11.08.2014</small>
                                        </td>
                                        <td class="project-completion">
                                            <small>Completion with: 28%</small>
                                            <div class="progress progress-mini">
                                                <div style="width: 28%;" class="progress-bar"></div>
                                            </div>
                                        </td>
                                        <td class="project-people">
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/7.jpg"></a>
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/6.jpg"></a>
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/3.jpg"></a>
                                            <a href=""><img alt="image" class="img-circle" src="images/modules/9.jpg"></a>

                                        </td>
                                        <td class="project-actions">
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>

                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</div>
</body>
</html>
