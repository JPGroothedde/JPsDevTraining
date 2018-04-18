<?php
/*
 * Copyright (C) 2016 Stratusolve (Pty) Ltd - All Rights Reserved
 * Modification or removal of this script is not allowed. In order
 * to include this script within your solution you require express
 * permission from Stratusolve (Pty) Ltd.
 * Please reference the sDev SaaS Subscription license agreement. A
 * copy of this agreement can be obtained by sending an email to
 * info@stratusolve.co
 */
	require('../../sdev.inc.php');

	// Load in the sDev_CodeGenerator Class
	require('sDev_CodeGenerator.class.php');

	// Security check for ALLOW_REMOTE_ADMIN
	// To allow access REGARDLESS of ALLOW_REMOTE_ADMIN, simply remove the line below
	AppSpecificFunctions::CheckRemoteAdmin();

	/////////////////////////////////////////////////////
	// Run CodeGen, using the ./codegen_settings.xml file
	/////////////////////////////////////////////////////
	sDev_CodeGenerator::Run(__SDEV_ORM__ . '/sDev_CodeGenerator/codegen_settings.xml');

	function DisplayMonospacedText($strText) {
		$strText = QApplication::HtmlEntities($strText);
		$strText = str_replace('	', '    ', $strText);
		$strText = str_replace(' ', '&nbsp;', $strText);
		$strText = str_replace("\r", '', $strText);
		$strText = str_replace("\n", '<br/>', $strText);

		_p($strText, false);
	}
	
	$strPageTitle = "sDev Framework - Core ORM Code Generator";
?>

        <strong>Code Generated:</strong> <?php _p(date('l, F j Y, g:i:s A')); ?>
        <h3 class="page-header">Database ORM Generation</h3>
        <div>

            <?php if ($strErrors = sDev_CodeGenerator::$RootErrors) { ?>
                <p><strong>The following root errors were reported:</strong></p>
                <pre><code><?php DisplayMonospacedText($strErrors); ?></code></pre>
            <?php } else { ?>
                <!-- Do Nothing -->
            <?php } ?>

            <?php  foreach (sDev_CodeGenerator::$CodeGenArray as $objCodeGen) { ?>
                <p><strong><?php  _p($objCodeGen->GetTitle()); ?></strong></p>
                <p class="code_title"><?php _p($objCodeGen->GetReportLabel()); ?></p>
                <?php @DisplayMonospacedText($objCodeGen->GenerateAll());  ?>
                <?php if ($strErrors = $objCodeGen->Errors) { ?>
                    <p class="code_title">The following errors were reported:</p>
                    <?php DisplayMonospacedText($objCodeGen->Errors); ?>
                <?php }  ?>

            <?php } ?>

            <?php foreach (sDev_CodeGenerator::GenerateAggregate() as $strMessage) { ?>
                <p><strong><?php _p($strMessage); ?></strong></p>
            <?php } ?>

        </div>
