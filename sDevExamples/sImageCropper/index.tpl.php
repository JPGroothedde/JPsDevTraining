<?php $strPageTitle = 'User Home';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');?>

<?php $this->RenderBegin();?>
<h1 class="page-header">sImageCropper Example</h1>
<div class="row">
    <div class="col-md-12" style="text-align: center;">
        <?php $this->txtImgUrl->Render();?>
        <?php $this->btnSetNewImage->Render();?>
        <?php $this->btnRemoveCropper->Render();?>
        <?php $this->testCropper->RenderCropper();?>
        <?php $this->btnGetImage->Render();?>
    </div>
</div>


<?php $this->RenderEnd();?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>