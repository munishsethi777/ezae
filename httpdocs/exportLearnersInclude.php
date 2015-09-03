<?php
  
?>
    <div id="exportLearnerModalForm" class="modal fade" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Export Learners</h4>
                </div>
                <div class="modal-body exportMainDiv">
                    <div class="row" >
                        <div class="col-sm-12">
                            <form role="form" method="post" action="Actions/LearnerAction.php" id="exportLearnerForm" class="form-horizontal">
                                <input type="hidden" value="exportLearners" name="call">
                                <input type="hidden" value="exportLearners" name="learnerseqs" id="learnerseqs">
                                <h4 class="modal-title">Select a option for export learnerns :- </h4><br/>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <input type="radio" value="selectedRows" checked="checked" name="exportOption" id="selected"> Selected Rows
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="radio" value="allRows" name="exportOption" id="all"> All Rows
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary ladda-button" data-style="expand-right" id="exportBtn" type="button">
                                        <span class="ladda-label">Export</span>
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