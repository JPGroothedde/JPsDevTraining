<?php $strPageTitle = 'User Home';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');?>

<?php $this->RenderBegin();?>
<h1>Chart Examples</h1>

<?php $this->btnSayHi->Render();?>
<div class="row">
    <div class="col-md-6">
        <?php $this->chartInstance_1->RenderChart();?>
    </div>
    <div class="col-md-6">
        <?php $this->chartInstance_2->RenderChart();?>
        <?php $this->sh_CustomLegend_Chart2->Render();?>
    </div>
    <div class="col-md-6">
        <?php $this->chartInstance_4->RenderChart();?>
    </div>
    <div class="col-md-12">
        <?php $this->chartInstance_5->RenderChart();?>
    </div>
    <div class="col-md-12">
        <?php $this->chartInstance_6->RenderChart();?>
    </div>
    <div class="col-md-12">
        <?php $this->chartInstance_3->RenderChart();?>
    </div>
</div>


<?php $this->RenderEnd();?>

<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>