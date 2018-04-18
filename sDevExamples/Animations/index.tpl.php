<?php $strPageTitle = 'User Home';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');?>

<?php $this->RenderBegin();?>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Animations</h1>
        <p>To enable animations on an object, simply run the following javascript:
        <pre>$('#IdOfElement').addClass('animated [effect]');</pre></p>
        <p>To enable the ripple click effect on elements, simply add the class "rippleclick" to your element</p>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <?php $this->btnTest->Render(); ?>
        <?php $this->html_Result->Render();?>
        <div class="list-group mrg-top25">
            <a href="#" class="list-group-item rippleclick">Cras justo odio</a>
            <a href="#" class="list-group-item rippleclick">Dapibus ac facilisis in</a>
            <a href="#" class="list-group-item rippleclick">Morbi leo risus</a>
            <a href="#" class="list-group-item rippleclick">Porta ac consectetur ac</a>
            <a href="#" class="list-group-item rippleclick">Vestibulum at eros</a>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>


<?php $this->RenderEnd();?>

<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>