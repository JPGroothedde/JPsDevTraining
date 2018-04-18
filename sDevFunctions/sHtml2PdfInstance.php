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
require_once('html2pdf/html2pdf.class.php');
class sHtml2PdfInstance {
    protected $filename,$templateFilename;
    protected $content;
    protected $autoIndex;
    protected $password;
    public function __construct($filename = 'generated.pdf',$templateFilename = 'infopage.php',$autoCreateIndex = false,$password = null) {

        $this->filename = $filename;
        $this->templateFilename = $templateFilename;
        $this->autoIndex = $autoCreateIndex;
        $this->password = $password;
        $this->getContent();
    }
    protected function getContent() {
        // get the HTML
        ob_start();
        include(__SDEV_FUNCTIONS__.'/PDFTemplates/'.$this->templateFilename);
        $this->content = ob_get_clean();
    }
    public function writePDF($orientation = 'P') {
        try
        {
            // init HTML2PDF
            $html2pdf = new HTML2PDF($orientation, 'A4', 'fr', true, 'UTF-8', array(0, 0, 0, 0));

            // display the full page
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->setDefaultFont('DejaVuSansCondensed');
            // convert
            $html2pdf->writeHTML($this->content, false);

            if ($this->password)
                $html2pdf->pdf->SetProtection(array('print'), $this->password);

            // add the automatic index
            if ($this->autoIndex)
                $html2pdf->createIndex('Summary', 30, 12, false, true, 2);

            // send the PDF
            $html2pdf->Output(__SDEV_FUNCTIONS__.'/GeneratedPDFs/'.$this->filename,'F');
            return true;
        }
        catch(HTML2PDF_exception $e) {
            echo $e;
            return false;
        }
    }
}
?>