<?php $strPageTitle = 'Person Template';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>
<style>
    body {
        padding: 0px;
        margin:0px;
    }
</style>
<?php $this->RenderBegin() ?>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <div class="row">
                <div class="well" style="margin-top: 20px;">
                    Click to upload image
	                <?php $this->btnUploadVIPPhoto->Render();?>
                </div>
            </div>
            <div class="row">
                <?php $this->checkboxIdVerified->Render(); ?>
            </div>
            <div class="row">
                <?php $this->checkboxPhoneNumberVerified->Render(); ?>
            </div>
            <div class="row">
                <?php $this->checkboxDriversLicense->Render(); ?>
            </div>
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs" id="captureNewPerson" role="tablist">
                        <li role="presentation" class="active"><a href="#Person_Person-Details--Verification" aria-controls="Person_Person-Details--Verification" role="tab" data-toggle="tab">Person Details & Verification</a></li>
                        <?php if (AppSpecificFunctions::GetDeviceType() == 'phone') { ?>
                            <li role="presentation" class="dropdown"> <a href="#" class="dropdown-toggle" id="Person_MoreOptions" data-toggle="dropdown" aria-controls="Person_MoreOptions-contents">More <span class="caret"></span></a>
                                <ul class="dropdown-menu" aria-labelledby="Person_MoreOptions" id="Person_MoreOptions-contents">
                                    <li role="presentation"><a href="#Person_Employment-History" aria-controls="Person_Employment-History" role="tab" data-toggle="tab">Employment History</a></li>
                                    <li role="presentation"><a href="#Person_Education" aria-controls="Person_Education" role="tab" data-toggle="tab">Education</a></li>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li role="presentation"><a href="#Person_Employment-History" aria-controls="Person_Employment-History" role="tab" data-toggle="tab">Employment History</a></li>
                            <li role="presentation"><a href="#Person_Education" aria-controls="Person_Education" role="tab" data-toggle="tab">Education</a></li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content mrg-top10">
                        <div role="tabpanel" class="tab-pane fade in active" id="Person_Person-Details--Verification">
                            <div class="row">
                                <div class="col-md-5">
                                    <?php $this->txtFirstName->RenderWithName();?>
                                </div>
                                <div class="col-md-5">
                                    <?php $this->txtNationality->RenderWithName();?>
                                </div>
                                <div class="col-md-2">
                                    <?php $this->btnPersonNextButton->Render()?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <?php $this->txtSurname->RenderWithName();?>
                                </div>
                                <div class="col-md-5">
                                    <?php $this->txtLanguage->RenderWithName();?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <?php $this->txtIDPassportNumber->RenderWithName();?>
                                </div>
                                <div class="col-md-5">
                                    <?php $this->txtEthnicGroup->RenderWithName();?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <?php $this->txtDateOfBirth->RenderWithName();?>
                                </div>
                                <div class="col-md-5">
                                    <?php $this->txtDriversLicense->RenderWithName();?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <?php $this->txtTelephoneNumber->RenderWithName();?>
                                </div>
                                <div class="col-md-5">
		                            <?php $this->txtAlternativeTelephoneNumber->RenderWithName();?>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-10">
		                            <?php $this->txtCurrentAddress->RenderWithName();?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Attachments</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">ID / Passport</div>
                                <div class="col-md-2">
                                    <?php $this->btnViewIdPassport->Render();?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">Drivers License</div>
                                <div class="col-md-2">
                                    <?php $this->btnViewDriversLicense->Render();?>
                                </div>
                            </div>
                            <div class="row">
                                <?php  $this->btnAddIdPassportDriversLicense->Render();?>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="Person_Employment-History">
                            <div class="row">
                                <div class="col-md-5">
                                    <?php $this->txtPeriodStartDate->RenderWithName();?>
                                </div>
                                <div class="col-md-5">
                                    <?php $this->txtPeriodEndDate->RenderWithName();?>
                                </div>
                                <div class="col-md-2">
                                    <?php $this->btnPersonEmploymentNextButton->Render(); ?>
                                </div>
                                <div class="col-md-5">
                                    <?php $this->txtEmployerName->RenderWithName();?>
                                </div>
                                <div class="col-md-5">
                                    <?php $this->txtTitle->RenderWithName();?>
                                </div>
                                <div class="col-md-5">
                                    <?php $this->txtDuties->RenderWithName();?>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="Person_Education">
                            <div class="row">
                                <div class="col-md-5">
                                    <?php $this->txtInstitution->RenderWithName();?>
                                </div>
                                <div class="col-md-5">
                                    <?php $this->txtStartDate->RenderWithName();?>
                                </div>
                                <div class="col-md-2">
                                    <?php $this->btnSaveNewPerson->Render(); ?>
                                </div>
                                <div class="col-md-5">
                                    <?php $this->txtEndDate->RenderWithName();?>
                                </div>
                                <div class="col-md-5">
                                    <?php $this->txtQualification->RenderWithName();?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--------------------Add ID Passport or Drivers License Modal--------------------------->
<div class="modal fade" id="AddIDPassportDriversLicenseModal" tabindex="-1" role="dialog" aria-labelledby="AddIDPassportDriversLicenseModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="AddIDPassportDriversLicenseModalLabel">Add ID / Passport or Drivers License</h4>
            </div>
            <div class="modal-body">
                <?php $this->listIdPassportDriversLicense->Render();?>
                <?php //$this->fileUploader->renderUploader();?>
                <?php //$this->sh_Feedback->Render();?>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-4">
	                    <?php //$this->btnSendToRemoteServer->Render();?>
                    </div>
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-default rippleclick mrg-top10 fullWidth" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>
<script>addSideBar('LEFT','250','','','','','','','','','VIPSYSmain','Person_Overview',<?php echo AppSpecificFunctions::GetDeviceType() == 'phone' ? 'true':'false';?>)</script>
