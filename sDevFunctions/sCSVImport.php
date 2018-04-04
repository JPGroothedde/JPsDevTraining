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
class sCSVImport{
    protected $FileToImport,$MaxRows,$Delimiter;
    protected $ArrayToReturn;
    public function __construct($FileName = '',$MaxRows = 1000,$Delimiter = ','){
        $this->FileToImport = $FileName;
        if (!file_exists($this->FileToImport)) {
            if (file_exists(__DOCROOT__.$FileName)) {
                $this->FileToImport = __DOCROOT__.$FileName;
            }
            else
                $this->FileToImport = null;
        } else
            $this->FileToImport = null;
        $this->MaxRows = $MaxRows;
        $this->Delimiter = $Delimiter;
    }
    public function DoImport() {
        if (!$this->FileToImport)
            return null;
        $handle = fopen($this->FileToImport, "r");
        $this->ArrayToReturn = array();
        while(($row = fgetcsv($handle, $this->MaxRows, $this->Delimiter)) !== false) {
            $newRow = [];
            for ($i = 0;$i<sizeof($row);$i++) {
                $newRow[$i] = $row[$i];
            }
            array_push($this->ArrayToReturn,$newRow);
        }
        return $this->ArrayToReturn;
    }
}