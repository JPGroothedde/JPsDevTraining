<?php require(__CONFIGURATION__ . '/HeaderComponents/standard_header_init.inc.php');
/**
 * Created by Stratusolve (Pty) Ltd in South Africa.
 * @author     johangriesel <info@stratusolve.com>
 *
 * Copyright (C) 2017 Stratusolve (Pty) Ltd - All Rights Reserved
 * Modification or removal of this script is not allowed. In order
 * to include this script within your solution you require express
 * permission from Stratusolve (Pty) Ltd.
 * Please reference the sDev SaaS Subscription license agreement. A
 * copy of this agreement can be obtained by sending an email to
 * info@stratusolve.co
 *
 *
 * THIS FILE SHOULD NOT BE EDITED. sDev assumes the integrity of this file. If you edit this file, it could be overridden by a future sDev update
 */
?>
<style>
    body {
        padding-top:0px;
    }
</style>
<div class="container-fluid">
    <?php $this->RenderBegin();?>
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">sDev ORM and Form Generation</h1>
                <div class="row">
                    <div class="col-md-2"><?php $this->btnDoGenerate->Render();?></div>
                    <div class="col-md-2"><?php $this->btnDoAPIGenerate->Render();?></div>
                    <div class="col-md-2"><?php $this->btnDone->Render();?></div>
                </div>
                <?php $this->sh_Overview->Render();?>
            </div>
        </div>
    <?php $this->RenderEnd();?>
</div>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>