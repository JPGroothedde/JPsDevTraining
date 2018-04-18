<?php $strPageTitle = 'Sortable Accordion Example';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');?>

<?php $this->RenderBegin();?>
<h3 class="page-header">Sortable Accordion Example</h3>
<?php $this->SortableAccordion->Render();?>
<?php $this->btnUpdatePanel->Render();?>
<?php $this->btnAddPanel->Render();?>
<?php $this->btnRemovePanel->Render();?>
<?php $this->btnCollapseAll->Render();?>
<?php $this->btnExpandAll->Render();?>
<?php $this->RenderEnd();?>

<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>