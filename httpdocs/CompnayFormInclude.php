<?php ?>
<div class="adminSingup animated fadeInRight">
        <div class="row">
            <div class="col-md-6">
                <span>
                     <?php if(isset($_GET['msg']))
                        echo $_GET['msg'];
                      ?>
                </span>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Company</h5>
                    </div>
                    <div class="ibox-content mainDiv"> 
                        <form id="createCompanyForm" class="form-horizontal">
                            <input type="hidden" name="call" id="call" value="saveCompany">
                                                       
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Name</label>  
                                <div class="col-lg-10">
                                    <input type="text" name="name" id="name" placeholder="Company Name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Description</label>
                                <div class="col-lg-10">
                                    <input type="text" name="description" id="description" placeholder="Description" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Email</label>

                                <div class="col-lg-10">
                                    <input type="text" name="email" id="email" placeholder="Email" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Mobile No</label>

                                <div class="col-lg-10">
                                    <input type="text" name="mobileno" id="mobileno"  placeholder="Mobile" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Contact Person</label>

                                <div class="col-lg-10">
                                    <input type="text" name="contactperson" id="contactperson" placeholder="Contact Person" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Address</label>

                                <div class="col-lg-10">
                                    <input type="text" name="address" id="address" placeholder="Full Address" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Phone</label>
                                <div class="col-lg-10">
                                    <input type="text" name="phone" id="phone" placeholder="Phone" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <p>Administrator</p>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Name</label>

                                <div class="col-lg-10">
                                    <input type="text" name="adminName"  id="adminName" placeholder="Name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">User Name</label>

                                <div class="col-lg-10">
                                    <input type="text" readonly="readonly" name="adminUserName"  id="adminUserName" placeholder="User Name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Password</label>

                                <div class="col-lg-10">
                                    <input type="password" readonly="readonly" name="adminPassword" id="adminPassword" placeholder="Password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Email</label>
                                <div class="col-lg-10">
                                    <input type="text" name="adminEmail" id="adminEmail" placeholder="Email" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Mobile</label>
                                <div class="col-lg-10">
                                    <input type="text" name="adminMobile" id="adminMobile"  placeholder="Mobile" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button class="btn btn-primary full-width ladda-button" data-style="expand-right" id="createButton" type="button">
                                    <span class="ladda-label">Save</span></button>  
                                </div>
                            </div>
                        </form> 
                    </div>
                    
                </div>
            </div>     
        </div>        
    </div>
