<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>
<?php $this->RenderBegin() ?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="alert alert-danger">
              <?php $this->sh_TheError->Render();?>
              
            </div>
        </div>
        <div class="col-md-4"></div>

    </div>
        

	<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>