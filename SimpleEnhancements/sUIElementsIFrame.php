<?php
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
class sUIElementsIFrame extends sUIElementsBase {
    protected $childControls = array();
    protected $src;
    public function __construct($objParentObject, $strControlId = null,$src = '') {
        parent::__construct($objParentObject, $strControlId);
        $this->src = $src;
    }

    public function updateUI() {
        // To be implemented by inheriting classes
        $html = '<p>Invalid IFrame URL</p>';
        if (AppSpecificFunctions::isValidUrl($this->src)) {
	        $html = '<div style="width:100%;border:none;" class="ExternalEmbedFrame">
                    <iframe src="'.$this->src.'"
					style="width: 100%;height:100%;border: none;"></iframe>
				</div>';
        }
        $this->updateControl($html);
	    $js = '
		var EmbedPosition = $(\'.ExternalEmbedFrame\').position();
		var EmbedTotalHeight = $( window ).height();
		var EmbedElHeight = EmbedTotalHeight - EmbedPosition.top;
		$(\'.ExternalEmbedFrame\').height(EmbedElHeight);';
	    AppSpecificFunctions::ExecuteJavaScript($js);
    }


}
?>
