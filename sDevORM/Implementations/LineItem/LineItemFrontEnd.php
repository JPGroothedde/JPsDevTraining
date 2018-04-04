<?php
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->LineItemInstance->renderControl('Quantity');?>
    </div>
    <div class="col-md-6">
        <?php $this->LineItemInstance->renderControl('LineTotal');?>
    </div>
</div>