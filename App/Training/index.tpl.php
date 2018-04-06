<?php $strPageTitle = 'index'; ?>
<?php require(__CONFIGURATION__.'/header_with_nav.inc.php'); ?>

<?php $this->RenderBegin(); ?>

    <h1>Course Index page</h1>
<?php
$this->txtInputBox->RenderWithName();
$this->btnProcessInput->Render();
$this->Result->Render();
?>

<?php $this->RenderEnd(); ?>

<?php require(__CONFIGURATION__.'/footer.inc.php'); ?>