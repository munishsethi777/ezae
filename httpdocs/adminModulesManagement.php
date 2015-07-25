  <?include("sessioncheck.php");?>
<html>
<head>
<?include "ScriptsInclude.php"?>
<script type="text/javascript">
    $(document).ready(function(){
        $(".moduleDetailsButton").click(function(e){
            $("#moduleDetailsModal").modal('show')
        });
    })




</script>
</head>
<body class='default'>
    <div id="wrapper">
        <?include("adminMenu.php");?>
       <div class="adminSingup animated fadeInRight">
        <div class="row">
            <div class="col-lg-12" >
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Manage Learning Modules</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="ibox">
                                    <div class="ibox-content product-box">
                                        <div class="product-imitation">
                                            <img src="images/modules/1.jpg" alt="" style="">
                                        </div>
                                        <div class="product-desc">
                                            <span class="product-price">$10</span>
                                            <a href="#" class="product-name"> CHEEZE CHALLENGE</a>
                                            <small class="text-muted">
                                                Added on <b>2nd July 2015</b> used in <b>4</b> Learning Plans
                                            </small>
                                            <div class="small m-t-xs">
                                                Many desktop publishing packages and web page editors now.
                                            </div>
                                            <div class="m-t text-righ">
                                                <a href="#" class="btn btn-xs btn-outline btn-primary moduleDetailsButton">
                                                    Info <i class="fa fa-long-arrow-right"></i>
                                                </a>
                                                <button class="btn btn-danger btn-circle" type="button" style="float: right;">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="moduleDetailsModal" style="width: auto;" class="modal fade" aria-hidden="true">
                                <div class="modal-dialog" >
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Modules Details</h4>
                                        </div>
                                        <div class="modal-body mainDiv">
                                            <h4>CHEEZE CHALLENGE</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat.</p>
                                            <p>Added on <b>2nd July 2015</b></p>
                                            <p>Included in 4 Learning Plans</p>
                                            <table class="table" style="font-size:12px">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Learning Plan</th>
                                                    <th>Started On</th>
                                                    <th>Ending On</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>New Joining Training Plan</td>
                                                    <td>1st January 2015</td>
                                                    <td>1st February 2015</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>New Year Training</td>
                                                    <td>1st July 2015</td>
                                                    <td>30th January 2015</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Sales Promotions</td>
                                                    <td>1st January 2015</td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Marketing with Internet Technology</td>
                                                    <td>1st January 2015</td>
                                                    <td>-</td>
                                                </tr>
                                                </tbody>
                                            </table>



                                        </div>
                                        <div class="modal-footer">
                                             <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                           </div>




                            <div class="col-md-3">
                                <div class="ibox">
                                    <div class="ibox-content product-box">

                                        <div class="product-imitation">
                                            <img src="images/modules/2.jpg" alt="" style="">
                                        </div>
                                        <div class="product-desc">
                                            <span class="product-price">
                                                $10
                                            </span>
                                            <small class="text-muted">Category</small>
                                            <a href="#" class="product-name"> Product</a>



                                            <div class="small m-t-xs">
                                                Many desktop publishing packages and web page editors now.
                                            </div>
                                            <div class="m-t text-righ">

                                                <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                                                <button class="btn btn-danger btn-circle" type="button" style="float: right;">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="ibox">
                                    <div class="ibox-content product-box active">

                                        <div class="product-imitation">
                                            <img src="images/modules/3.jpg" alt="" style="">
                                        </div>
                                        <div class="product-desc">
                                            <span class="product-price">
                                                $10
                                            </span>
                                            <small class="text-muted">Category</small>
                                            <a href="#" class="product-name"> Product</a>



                                            <div class="small m-t-xs">
                                                Many desktop publishing packages and web page editors now.
                                            </div>
                                            <div class="m-t text-righ">

                                                <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                                                <button class="btn btn-danger btn-circle" type="button" style="float: right;">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="ibox">
                                    <div class="ibox-content product-box">

                                        <div class="product-imitation">
                                            <img src="images/modules/4.jpg" alt="" style="">
                                        </div>
                                        <div class="product-desc">
                                            <span class="product-price">
                                                $10
                                            </span>
                                            <small class="text-muted">Category</small>
                                            <a href="#" class="product-name"> Product</a>



                                            <div class="small m-t-xs">
                                                Many desktop publishing packages and web page editors now.
                                            </div>
                                            <div class="m-t text-righ">

                                                <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                                                <button class="btn btn-danger btn-circle" type="button" style="float: right;">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

