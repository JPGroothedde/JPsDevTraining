<?php $strPageTitle = 'User Home';?>
<?php require(__CONFIGURATION__ . '/header.inc.php');?>

<?php $this->RenderBegin();?>
<h1 class="page-header"></h1>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <?php $this->DashBoardMenuButton->Render();?>
            </div>
            <div class="row">
                <?php $this->RegisteredCVsButton->Render();?>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row"><?php $this->SearchPersonInputBox->Render();?></div>
            <div class="row">-or-</div>
            <div class="row"><?php $this->AddNewVipButton->Render();?></div>
        </div>
    </div>
</div>

<?php $this->RenderEnd();?>

<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>
<script>addSideBar('LEFT','250','transparent','','','transparent','','','','','VIPSYSmain','Person_Overview',<?php echo AppSpecificFunctions::GetDeviceType() == 'phone' ? 'true':'false';?>)</script>
