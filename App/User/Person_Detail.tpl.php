<?php $strPageTitle = 'Person Detail';?>
<?php require(__CONFIGURATION__ . '/header.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="well" style="margin-top: 20px;">
	                <?php $this->ProfilePicture->Render();?>
                    <!--Click to upload image-->
                    <?php $this->btnAddProfilePic->Render();?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="padding: 10px;">
		            <?php $this->PersonInstance->renderControl('PhoneVerified',false);?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="padding: 10px;">
		            <?php $this->PersonInstance->renderControl('IdentityVerified',false);?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="padding: 10px;">
		            <?php $this->PersonInstance->renderControl('DriversLicenseVerified',false);?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
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
                            <li role="presentation"><a href="#pdfCreation" aria-controls="pdfCreation" role="tab" data-toggle="tab"></a></li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content mrg-top10">
                        <div role="tabpanel" class="tab-pane fade in active" id="Person_Person-Details--Verification">
                            <div class="row">
                                <div class="col-md-11">
	                                <?php require(__SDEV_ORM__.'/Implementations/Person/PersonFrontEnd.php');?>
                                </div>
                                <div class="col-md-1">
	                                <?php $this->btnSavePerson->Render();?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Attachments</h4>
                                </div>
                            </div>
                            <div class="row">
	                            <?php $this->PersonAttachmentList->RenderList();?>
                            </div>
                            <!--div class="row">
                                <div class="col-md-6">ID / Passport</div>
                                <div class="col-md-2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">Drivers License</div>
                                <div class="col-md-2">
                                </div>
                            </div-->
                            <div class="row">
                                <?php  $this->btnAddAttachment->Render();?>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="Person_Employment-History">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php $this->btnAddExperience->Render();?>
                                </div>
                                <div class="col-md-4">
                                    <?php $this->btnAddReference->Render();?>
                                </div>
                                <div class="col-md-2">
                                    <?php $this->btnEmploymentHistoryNext->Render();?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php $this->EmploymentHistoryDisplay->Render();?>
                                </div>
                                <div class="col-md-6">
		                            <?php $this->ReferenceDisplay->Render();?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <?php $this->EmploymentHistorySkillsTagsInput->RenderWithName();?>
                                </div>
                                <div class="col-md-2"><?php $this->btnAddNewEmploymentHistorySkillsTag->Render();?></div>
                            </div>
                            <div class="row">
                                <?php $this->EmploymentHistorySkillsTagDisplay->Render();?>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="Person_Education">
                            <?php $this->btnAddEducation->Render();?>
                            <div class="col-md-6">
                                <?php $this->EducationDisplay->Render()?>
                            </div>
                            <?php $this->btnCreatePdf->Render();?>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="pdfCreation">
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--------------------Add Profile Picture Modal ----------------------------------------->
<div class="modal fade" id="profilePictureModal" tabindex="-1" role="dialog" aria-labelledby="profilePictureModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="profilePictureModalLabel">Add Profile Picture</h4>
            </div>
            <div class="modal-body">
                <?php $this->fileUploader->renderUploader();?>
                <?php $this->sh_Feedback->Render();?>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-4">

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
<!--------------------Add ID Passport or Drivers License Modal--------------------------->
<div class="modal fade" id="AddIDPassportDriversLicenseModal" tabindex="-1" role="dialog" aria-labelledby="AddIDPassportDriversLicenseModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="AddIDPassportDriversLicenseModalLabel">Add ID / Passport or Drivers License</h4>
            </div>
            <div class="modal-body">
				<?php $this->attachmentUploadName->Render();?>
				<?php $this->attachmentUploader->renderUploader();?>
				<?php $this->attachmentUploadFeedback->Render();?>
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
<!--------------------Add Employment Experience Modal ----------------------------------->
<?php require(__SDEV_ORM__.'/Implementations/EmploymentHistory/EmploymentHistoryModal.php');?>
<!--------------------Add Reference Modal ----------------------------------------------->
<?php require(__SDEV_ORM__.'/Implementations/Reference/ReferenceModal.php');?>
<!--------------------Add Education Modal ----------------------------------------------->
<?php require (__SDEV_ORM__.'/Implementations/Education/EducationModal.php');?>
<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>
<script>addSideBar('LEFT','250','transparent','','','transparent','','','','','VIPSYSmain','Person_Overview',<?php echo AppSpecificFunctions::GetDeviceType() == 'phone' ? 'true':'false';?>)</script>
