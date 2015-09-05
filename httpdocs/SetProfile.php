 <div  id="setProfileModelForm" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Set Profile</h4>
                </div>
                <div class="modal-body profileMainDiv">
                    <div class="row" >
                        <div class="col-sm-12">
                            <form role="form"  method="post" action="Actions/LearnerAction.php" id="setProfileForm" class="form-horizontal">
                                <input type="hidden" value="setProfile" name="call">
                                <input type="hidden" id="ids" name="ids" value="0">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Selected Learners</label>
                                    <div class="col-sm-9">
                                        <div style="height:auto !important;" id="learnerNamesDiv" class="form-control"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                   <label class="col-sm-3 control-label">Profiles</label>
                                    <div class="col-sm-9">
                                        <select id="profileSelect"  name="profileSelect[]" multiple class="chosen-select">
                                        </select>
                                         <label class="jqx-validator-error-label" id="profileSelectError"></label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                     <button class="btn btn-primary ladda-button" data-style="expand-right" id="setProfileBtn" type="button">
                                        <span class="ladda-label">Save</span>
                                    </button>
                                     <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>