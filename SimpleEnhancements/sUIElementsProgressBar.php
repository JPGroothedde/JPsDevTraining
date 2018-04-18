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

/*
 * Implementation of https://github.com/kimmobrunfeldt/progressbar.js
 * */
class sUIElementsProgressBar extends sUIElementsBase  {
    public function __construct($objParentObject, $strControlId = null) {
        parent::__construct($objParentObject, $strControlId);
        $this->AddJavascriptFile(__APP_JS_ASSETS__.'/ProgressBar/progressbar.min.js');
        $this->AddJavascriptFile(__APP_JS_ASSETS__.'/ProgressBar/progressbar_init.js');
    }
    public function drawProgress($value = 1.0) {
        $this->doUpdateJs($value);
    }
    public function updateUI($FromColor = '#aaa',$ToColor = '#333',$FromWidth = 1,$ToWidth = 4,$Duration = 1400,$height = 200,$showPercentageSign = true) {
        // To be implemented by inheriting classes
        $fontSize = $height/5;
        $html = '<div id="'.$this->getJqControlId().'_PBC" style="margin: auto;width: '.$height.'px;height: '.$height.'px;position: relative;"></div>';
        $this->updateControl($html);
        $this->doInitJs($FromColor,$ToColor,$FromWidth,$ToWidth,$Duration,$fontSize,$showPercentageSign);
    }
    protected function doInitJs($FromColor = '#aaa',$ToColor = '#333',$FromWidth = 1,$ToWidth = 4,$Duration = 1400,$fontSize = 20,$showPercentageSign = true) {
        $js = 'progressBars['.$this->getJqControlId().'] = new ProgressBar.Circle('.$this->getJqControlId().'_PBC, {
                  color: \'#aaa\',
                  // This has to be the same size as the maximum width to
                  // prevent clipping
                  strokeWidth: '.$ToWidth.',
                  trailWidth: '.$FromWidth.',
                  easing: \'easeInOut\',
                  duration: '.$Duration.',
                  text: {
                    autoStyleContainer: false
                  },
                  from: { color: \''.$FromColor.'\', width: '.$FromWidth.' },
                  to: { color: \''.$ToColor.'\', width: '.$ToWidth.' },
                  // Set default step function for all animate calls
                  step: function(state, circle) {
                    circle.path.setAttribute(\'stroke\', state.color);
                    circle.path.setAttribute(\'stroke-width\', state.width);
                
                    var value = Math.round(circle.value() * 100);
                    if (value === 0) {
                      circle.setText(\'\');
                    } else {';
        if ($showPercentageSign) {
            $js .= 'circle.setText(value+\'%\');';
        } else {
            $js .= 'circle.setText(value);';
        }
        $js .= '
                    }
                
                  }
                });
                progressBars['.$this->getJqControlId().'].text.style.fontFamily = \'"Raleway", Helvetica, sans-serif\';
                progressBars['.$this->getJqControlId().'].text.style.fontSize = \''.$fontSize.'px\';';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
    protected function doUpdateJs($value = 1.0) {
        $js = 'progressBars['.$this->getJqControlId().'].animate('.$value.');';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
}
?>
