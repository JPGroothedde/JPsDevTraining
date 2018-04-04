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
set_time_limit(7200); // This script could take some time to run...
require('../sdev.inc.php');
require(__DOCROOT__.__SUBDIRECTORY__.'/Licensing/ChecksDevLicense.php');
abstract class SyncType {
	const none = 'none';
	const reset = 'reset';
	const syncWC = 'syncWC';
	const syncWOC = 'syncWOC';
	const restoreLastSync = 'restoreLastSync';
	const restoreLastReset = 'restoreLastReset';
}

class ManageDBForm extends QForm {
	protected $dbArray;
	protected $host,$username,$password,$db_name;
	protected $DataModel;
	protected $btnCleanResetDB,$btnSyncCaseSensitive,$btnSyncWithoutCase,$btnRestoreLastReset,$btnRestoreLastSync,$btnDone;
	protected $sh_Output;
	protected $currentSync = SyncType::none;
	protected $syncStatus = true,$showSyncStatus = false;
	protected $sqlStatementArray = array();
	
	protected $txtPassword,$btnConfirm,$ActionToConfirm = 'Reset';
	// Override Form Event Handlers as Needed
	public function Form_Create() {
		parent::Form_Create();
		AppSpecificFunctions::CheckRemoteAdmin();
		$this->dbArray = unserialize(DB_CONNECTION_1);
		$this->host = $this->dbArray['server'];
		$this->username = $this->dbArray['username'];
		$this->password = $this->dbArray['password'];
		$this->db_name = $this->dbArray['database'];
		
		$this->DataModel = new DataModel();
		$this->DataModel->objectAttributes;
		
		$this->btnCleanResetDB = new QButton($this);
		$this->btnCleanResetDB->Text = 'Clean & Reset';
		$this->btnCleanResetDB->CssClass = 'btn btn-danger fullWidth mrg-bottom5 rippleclick';
		$this->btnCleanResetDB->AddAction(new QClickEvent(), new QAjaxAction('btnCleanResetDB_Clicked',null,null,null,null,true));
		
		$this->btnSyncCaseSensitive = new QButton($this);
		$this->btnSyncCaseSensitive->Text = 'Synchronise';
		$this->btnSyncCaseSensitive->CssClass = 'btn btn-info fullWidth mrg-bottom5 rippleclick';
		$this->btnSyncCaseSensitive->AddAction(new QClickEvent(), new QAjaxAction('btnSyncCaseSensitive_Clicked',null,null,null,null,true));
		
		$this->btnRestoreLastReset = new QButton($this);
		$this->btnRestoreLastReset->Text = 'Restore Last Reset';
		$this->btnRestoreLastReset->CssClass = 'btn btn-warning fullWidth mrg-bottom5 rippleclick';
		$this->btnRestoreLastReset->AddAction(new QClickEvent(), new QAjaxAction('btnRestoreLastReset_Clicked',null,null,null,null,true));
		
		$this->btnRestoreLastSync = new QButton($this);
		$this->btnRestoreLastSync->Text = 'Restore Last Sync';
		$this->btnRestoreLastSync->CssClass = 'btn btn-warning fullWidth mrg-bottom5 rippleclick';
		$this->btnRestoreLastSync->AddAction(new QClickEvent(), new QAjaxAction('btnRestoreLastSync_Clicked',null,null,null,null,true));
		
		$this->btnDone = new QButton($this);
		$this->btnDone->Text = 'Done';
		$this->btnDone->CssClass = 'btn btn-success fullWidth mrg-bottom5 rippleclick';
		$this->btnDone->AddAction(new QClickEvent(), new QAjaxAction('btnDone_Clicked'));
		
		$this->txtPassword = new QTextBox($this);
		$this->txtPassword->Name = 'Maintenance Password';
		$this->txtPassword->TextMode = QTextMode::Password;
		
		$this->btnConfirm = new QButton($this);
		$this->btnConfirm->Text = 'Confirm';
		$this->btnConfirm->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
		$this->btnConfirm->AddAction(new QClickEvent(), new QConfirmAction('Are you sure??'));
		$this->btnConfirm->AddAction(new QClickEvent(), new QAjaxAction('btnConfirm_Clicked',null,null,null,null,true));
		//$this->SetDefaultEnterPressedJs(AppSpecificFunctions::getPostBackJs($this->FormId,$this->btnConfirm->getJqControlId()));
		
		$this->sh_Output = new sUIElementsBase($this);
		$this->UpdateOutput();
	}
	protected function btnConfirm_Clicked() {
		if ($this->txtPassword->Text == __MAINTENANCEPWD__) {
			if ($this->currentSync == SyncType::reset) {
				$this->UpdateOutput();
				$this->ResetButtons();
			}
			if ($this->currentSync == SyncType::restoreLastReset) {
				$result = $this->restoreDB(true);
				if (!($result === false)) {
					if ($result == 'Success') {
						$message = 'Database has been restored!';
						AppSpecificFunctions::ShowNotedFeedback($message);
					} else {
						$message = 'Database could not be restored! '.$result;
						AppSpecificFunctions::ShowNotedFeedback($message,false);
					}
				} else {
					$message = 'Database could not be restored! Restore script could not be loaded';
					AppSpecificFunctions::ShowNotedFeedback($message,false);
				}
			}
			if ($this->currentSync == SyncType::restoreLastSync) {
				$result = $this->restoreDB(false);
				if (!($result === false)) {
					if ($result == 'Success') {
						$message = 'Database has been restored!';
						AppSpecificFunctions::ShowNotedFeedback($message);
					} else {
						if (is_string($result))
							$message = 'Database could not be restored! '.$result;
						else
							$message = 'Database could not be restored! Reason unknown.';
						AppSpecificFunctions::ShowNotedFeedback($message,false);
					}
				} else {
					$message = 'Database could not be restored! Restore script could not be loaded';
					AppSpecificFunctions::ShowNotedFeedback($message,false);
				}
			}
			AppSpecificFunctions::ToggleModal('ConfirmPassword');
		} else
			AppSpecificFunctions::ShowNotedFeedback('Incorrect Password!',false);
	}
	protected function btnCleanResetDB_Clicked() {
		if (!$this->checkTableNamesCase()) {
			AppSpecificFunctions::ShowNotedFeedback('There is a problem with your database configuration. Please ensure "lower_case_table_names" is set to "2"',false);
			return;
		}
		$this->currentSync = SyncType::reset;
		
		AppSpecificFunctions::ToggleModal('ConfirmPassword');
	}
	protected function btnSyncCaseSensitive_Clicked() {
		if (!$this->checkTableNamesCase()) {
			AppSpecificFunctions::ShowNotedFeedback('There is a problem with your database configuration. Please ensure "lower_case_table_names" is set to "2"',false);
			return;
		}
		$this->currentSync = SyncType::syncWC;
		$this->UpdateOutput();
		$this->ResetButtons();
	}
	protected function btnRestoreLastReset_Clicked() {
		
		$this->currentSync = SyncType::restoreLastReset;
		AppSpecificFunctions::ToggleModal('ConfirmPassword');
	}
	protected function btnRestoreLastSync_Clicked() {
		
		$this->currentSync = SyncType::restoreLastSync;
		AppSpecificFunctions::ToggleModal('ConfirmPassword');
	}
	protected function btnDone_Clicked() {
		AppSpecificFunctions::Redirect(__VIRTUAL_DIRECTORY__ . __DEVTOOLS__.'/start_page.php');
	}
	protected function ResetButtons() {
		$this->btnCleanResetDB->Text = 'Clean & Reset';
		$this->btnCleanResetDB->Enabled = true;
		$this->btnCleanResetDB->Refresh();
		$this->btnSyncCaseSensitive->Text = 'Synchronise';
		$this->btnSyncCaseSensitive->Enabled = true;
		$this->btnSyncCaseSensitive->Refresh();
	}
	protected function UpdateOutput() {
		$this->sh_Output->updateControl($this->getOutput());
	}
	protected function getOutput() {
		$syncOutput = '';
		if ($this->currentSync == SyncType::none)
			$syncOutput .= '';
		elseif ($this->currentSync == SyncType::reset) {
			$syncOutput .= $this->ResetDB();
			$syncOutput .= $this->UserRoleSync();
		}
		else {
			$syncOutput .= $this->SyncDB();
			$syncOutput .= $this->UserRoleSync();
		}
		
		$html = '<div class="col-md-12">';
		$html .= $this->getCurrentDBStatus();
		$html .= '</div>';
		$html .= '<div class="col-md-12">';
		$html .= $syncOutput;
		$html .= '</div>';
		return $html;
	}
	
	protected function connectDB() {
		// Connect to server and select databse.
		$Link = mysqli_connect("$this->host","$this->username","$this->password","$this->db_name")
		or die("Error " . mysqli_error($Link));
		return $Link;
	}
	
	protected function closeDB($Link) {
		mysqli_close($Link);
	}
	// Helpers
	protected function in_arrayi($needle, $haystack) {
		if ($this->currentSync == SyncType::syncWC)
			return in_array($needle,$haystack);
		else
			return in_array(($needle), array_map('strtolower', $haystack));
	}
	protected function TableExists($Table,$Link) {
		$sql="SHOW TABLES LIKE '".$Table."'";
		array_push($this->sqlStatementArray,$sql);
		$result = $Link->query($sql);
		if (!$result)
			return false;
		return mysqli_num_rows($result) > 0;
	}
	protected function FieldExists($Table,$Field,$Link) {
		$sql="SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '$this->db_name' AND TABLE_NAME = '$Table' AND COLUMN_NAME = '$Field'";
		array_push($this->sqlStatementArray,$sql);
		$result = $Link->query($sql);
		if (!$result) {
			echo 'Error: '.mysqli_error($Link).'<br>';
			return false;
		}
		return mysqli_num_rows($result) > 0;
	}
	protected function SyncFieldType($Table,$Field,$Index,$Link) {
		$htmlToReturn = '';
		$sql = "SELECT * FROM $Table LIMIT 1";
		array_push($this->sqlStatementArray,$sql);
		$result = $Link->query($sql);
		$fields = mysqli_num_fields($result);
		
		$mysqli_type = array();
		$mysqli_type[0] = "DECIMAL";
		$mysqli_type[1] = "TINYINT";
		$mysqli_type[2] = "SMALLINT";
		$mysqli_type[3] = "INTEGER";
		$mysqli_type[4] = "FLOAT";
		$mysqli_type[5] = "DOUBLE";
		
		$mysqli_type[7] = "TIMESTAMP";
		$mysqli_type[8] = "INT";
		$mysqli_type[9] = "MEDIUMINT";
		$mysqli_type[10] = "DATE";
		$mysqli_type[11] = "TIME";
		$mysqli_type[12] = "DATETIME";
		$mysqli_type[13] = "YEAR";
		$mysqli_type[14] = "DATE";
		
		$mysqli_type[16] = "BIT";
		
		$mysqli_type[246] = "DECIMAL";
		$mysqli_type[247] = "ENUM";
		$mysqli_type[248] = "SET";
		$mysqli_type[249] = "TINYBLOB";
		$mysqli_type[250] = "MEDIUMBLOB";
		$mysqli_type[251] = "LONGBLOB";
		$mysqli_type[252] = "TEXT";
		$mysqli_type[253] = "VARCHAR";
		$mysqli_type[254] = "CHAR";
		$mysqli_type[255] = "GEOMETRY";
		
		
		for ($i=0; $i < $fields; $i++) {
			$finfo = $result->fetch_field_direct($i);
			$type  = $finfo->type;
			$name  = $finfo->name;
			$len   = $finfo->length;
			$flags = $finfo->flags;
			$compareType = $mysqli_type[$type];
			if (($type == 253) or ($type == 254))
				$compareType = $mysqli_type[$type]."(".$len.")";
			if (($name != "Id")&&($name == $Field)) {
				$dataModelCompareType = str_ireplace(' UNIQUE','',$this->DataModel->objectAttributeTypes[$Table][$Index]);
				if ($dataModelCompareType == 'INT')
					$dataModelCompareType = 'INTEGER';
				if ($dataModelCompareType == 'BIGINT')
					$dataModelCompareType = 'INT';
				if (strtoupper($compareType) == strtoupper($dataModelCompareType)) {
					// Nothing changed
				} else {
					$newType = $this->DataModel->objectAttributeTypes[$Table][$Index];
					$sql = "alter table $Table modify column $Field $newType";
					array_push($this->sqlStatementArray,$sql);
					$result1 = $Link->query($sql);
					if ($result1) {
						$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                            Field type updated for '.$Field.' type was '.$type.
							' compareType was '.$compareType.' datamodel comparetype was '.$dataModelCompareType.'
                                          </div>';
					} else {
						$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                            Field type for '.$Field.' could not be updated!<br>
                                            MySQLi Error: ' . mysqli_error($Link).'
                                          </div>';
						$this->syncStatus = false;
					}
				}
			}
			if (($name != "Id") && ($name != "SearchMetaInfo") && ($name != "LastUpdated")
				&& !in_array($name,$this->DataModel->objectAttributes[$Table])) {
				$bMustDrop = true;
				if (array_key_exists($Table, $this->DataModel->objectSingleRelations)) {
					for ($k=0;$k<sizeof($this->DataModel->objectSingleRelations[$Table]);$k++)
					{
						if (($this->DataModel->objectSingleRelations[$Table][$k]) == ($name))
							$bMustDrop = false;
					}
				}
				if ($bMustDrop) {
					// First check here if this field has a foreign key constraint
					$sql = "SELECT * FROM information_schema.TABLE_CONSTRAINTS
							WHERE information_schema.TABLE_CONSTRAINTS.CONSTRAINT_TYPE = 'FOREIGN KEY'
							AND information_schema.TABLE_CONSTRAINTS.TABLE_SCHEMA = '$this->db_name'
							AND information_schema.TABLE_CONSTRAINTS.TABLE_NAME = '$Table';";
					array_push($this->sqlStatementArray,$sql);
					$resultFK = $Link->query($sql);
					if ($resultFK) {
						while ($rowFK = mysqli_fetch_row($resultFK)) {
							if ($Table."_".$name == $rowFK[2]) {
								$FKToDrop = $Table."_".$name;
								$sqlFKDrop = "ALTER TABLE $Table DROP FOREIGN KEY $FKToDrop";
								array_push($this->sqlStatementArray,$sqlFKDrop);
								$resultFKDrop = $Link->query($sqlFKDrop);
								if ($resultFKDrop){
									$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                            Removed 1-to-many relationship '.$FKToDrop.'
                                          </div>';
								}
								else {
									$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                            Could not remove 1-to-many relationship '.$FKToDrop.'
                                          </div>';
									$this->syncStatus = false;
								}
							}
						}
					}
					// If no foreign key contraint, go ahead and drop the field
					$sql = "alter table $Table drop column $name";
					array_push($this->sqlStatementArray,$sql);
					$result2 = $Link->query($sql);
					if ($result2) {
						$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                            Field type '.$name.' dropped from table '.$Table.'
                                          </div>';
					}
					else {
						$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                            Field type '.$name.' could not be dropped from table '.$Table.'
                                          </div>';
						$this->syncStatus = false;
					}
				}
				// FK not modified...
			}
		}
		return $htmlToReturn;
	}
	protected function checkDropTables($Link) {
		$htmlToReturn = '';
		// Check for tables to drop
		$sql = "SHOW TABLES FROM $this->db_name";
		array_push($this->sqlStatementArray,$sql);
		$resultTablesToDrop = $Link->query($sql);
		if ($resultTablesToDrop) {
			while ($row = mysqli_fetch_row($resultTablesToDrop)) {
				if (!$this->in_arrayi($row[0], $this->DataModel->objects)) {
					// Check if this is a relationship table
					if (strpos($row[0],'_assn') !== false) {
						// This is a relationship table, so before dropping it, we need to check if there is a relationship defined for it
						$theObject = strstr($row[0], '_', true);
						$theRelatedObject = substr(strstr($row[0], '_'),1,-5);
						
						// Make sure we compare without case
						$keys=array_keys($this->DataModel->objectManyRelations);
						$map=array();
						foreach($keys as $key) {
							$map[($key)]=array_map('', $this->DataModel->objectManyRelations[$key]);
						}
						if (array_key_exists($theObject,$map)) {
							if (!$this->in_arrayi(($theRelatedObject),$map[($theObject)])) {
								$htmlToReturn .= '<div class="alert alert-info" role="alert">
                                                    Dropping relation table '.$row[0].'
                                                    </div>';
								$sql = "DROP TABLE {$row[0]}";
								array_push($this->sqlStatementArray,$sql);
								$resultDropRelTable1 = $Link->query($sql);
								if ($resultDropRelTable1) {
									$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                                        Table '.$row[0].' dropped
                                                        </div>';
								} else {
									$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                                        Table '.$row[0].' could not be dropped<br>
                                                MySQLi Error: '.mysqli_error($Link).'
                                                        </div>';
									$this->syncStatus = false;
								}
							}
						} else {
							$htmlToReturn .= '<div class="alert alert-info" role="alert">
                                                    Dropping relation table '.$row[0].' because it has no relationships
                                                    </div>';
							$sql = "DROP TABLE {$row[0]}";
							array_push($this->sqlStatementArray,$sql);
							$resultDropRelNOTable1 = $Link->query($sql);
							if ($resultDropRelNOTable1) {
								$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                                        Table '.$row[0].' dropped
                                                        </div>';
							} else {
								$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                                        Table '.$row[0].' could not be dropped<br>
                                                MySQLi Error: '.mysqli_error($Link).'
                                                        </div>';
								$this->syncStatus = false;
							}
						}
					} else {
						$sql = "DROP TABLE {$row[0]}";
						array_push($this->sqlStatementArray,$sql);
						$resultDropTable = $Link->query($sql);
						if ($resultDropTable) {
							$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                                        Table '.$row[0].' dropped
                                                        </div>';
						} else {
							$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                                        Table '.$row[0].' could not be dropped<br>
                                                MySQLi Error: '.mysqli_error($Link).'
                                                        </div>';
							$this->syncStatus = false;
						}
					}
				}
				// Nothing changes
			}
		} else {
			$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                            <strong>DB Error!</strong> could not list tables<br>
                                            MySQL Error: ' . mysqli_error($Link).'
                                          </div>';
		}
		return $htmlToReturn;
	}
	protected function checkCreateTables($Link) {
		$htmlToReturn = '';
		for ($i=0;$i<sizeof($this->DataModel->objects);$i++) {
			if ($this->TableExists($this->DataModel->objects[$i],$Link)) {
				//Check for field changes
				for ($j=0;$j<sizeof($this->DataModel->objectAttributes[$this->DataModel->objects[$i]]);$j++) {
					if ($this->FieldExists($this->DataModel->objects[$i],$this->DataModel->objectAttributes[$this->DataModel->objects[$i]][$j],$Link)) {
						$htmlToReturn .= $this->SyncFieldType($this->DataModel->objects[$i],$this->DataModel->objectAttributes[$this->DataModel->objects[$i]][$j],$j,$Link);
					} else {
						$sql = "ALTER TABLE ".$this->DataModel->objects[$i]." ADD ".$this->DataModel->objectAttributes[$this->DataModel->objects[$i]][$j].
							" ".$this->DataModel->objectAttributeTypes[$this->DataModel->objects[$i]][$j]."";
						array_push($this->sqlStatementArray,$sql);
						$result = $Link->query($sql);
						if ($result) {
							$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                                Table '.$this->DataModel->objects[$i].' altered to add field '.$this->DataModel->objectAttributes[$this->DataModel->objects[$i]][$j].
								' '.$this->DataModel->objectAttributeTypes[$this->DataModel->objects[$i]][$j].'
                                                </div>';
						} else {
							$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                                Table '.$this->DataModel->objects[$i].' could not be altered to add field '.$this->DataModel->objectAttributes[$this->DataModel->objects[$i]][$j].
								' '.$this->DataModel->objectAttributeTypes[$this->DataModel->objects[$i]][$j].'<br>
                                                MySQLi Error: '.mysqli_error($Link).'
                                                </div>';
							$this->syncStatus = false;
						}
					}
				}
			}
			else
			{
				$sql="CREATE TABLE ".$this->DataModel->objects[$i]."(";
				for ($j=0;$j<sizeof($this->DataModel->objectAttributes[$this->DataModel->objects[$i]]);$j++)
				{
					if ($j == 0) {
						$sql .= "Id INT UNIQUE AUTO_INCREMENT, ";
					} else {
						$sql .= ", ";
					}
					$sql .= $this->DataModel->objectAttributes[$this->DataModel->objects[$i]][$j]." ".$this->DataModel->objectAttributeTypes[$this->DataModel->objects[$i]][$j];
				}
				$sql .= ", LastUpdated TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
				$sql .= ")";
				array_push($this->sqlStatementArray,$sql);
				$result = $Link->query($sql);
				if ($result) {
					$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                        Table '.$this->DataModel->objects[$i].' created successfully...
                                        </div>';
				} else {
					$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                        Table '.$this->DataModel->objects[$i].' could not be created...<br>
                                                MySQLi Error: '.mysqli_error($Link).'
                                        </div>';
					$this->syncStatus = false;
				}
			}
		}
		return $htmlToReturn;
	}
	protected function checkCreateSingleRelations($Link) {
		$htmlToReturn = '';
		for ($i=0;$i<sizeof($this->DataModel->objects);$i++) {
			if (array_key_exists($this->DataModel->objects[$i], $this->DataModel->objectSingleRelations))
			{
				// Handle 1-to-many relations here...
				for ($k=0;$k<sizeof($this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]]);$k++)
				{
					if (!$this->FieldExists($this->DataModel->objects[$i],$this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k],$Link))
					{
						// The relationship does not yet exist, let's create it
						$htmlToReturn .= '<div class="alert alert-info" role="alert">
                                        Creating 1-to-many relationship '.$this->DataModel->objects[$i].'_'.$this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k].'
                                        </div>';
						$sql = "ALTER TABLE ".$this->DataModel->objects[$i]." ADD ".$this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k]." INT";
						array_push($this->sqlStatementArray,$sql);
						$result = $Link->query($sql);
						$sql = "ALTER TABLE ".$this->DataModel->objects[$i]." ADD SearchMetaInfo TEXT";
						if (!$this->FieldExists($this->DataModel->objects[$i],"SearchMetaInfo",$Link)) {
							array_push($this->sqlStatementArray,$sql);
							$resultSearchMeta = $Link->query($sql);
						}
						if ($result/* && $resultSearchMeta*/) {
							$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                        Relationship '.$this->DataModel->objects[$i].'_Single_'.
								$this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k].' reference Id added
                                        </div>';
							$sql = "ALTER TABLE ".$this->DataModel->objects[$i]." ADD INDEX (".$this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k].")";
							array_push($this->sqlStatementArray,$sql);
							$result1 = $Link->query($sql);
							if ($result1) {
								$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                        Relationship '.$this->DataModel->objects[$i].'_Single_'.
									$this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k].' reference Id Index added
                                        </div>';
								$sql = "ALTER TABLE " .$this->DataModel->objects[$i]." ADD CONSTRAINT ".$this->DataModel->objects[$i].
									"_".$this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k].
									" FOREIGN KEY ( ".$this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k].") REFERENCES ".
									($this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k])."
                             (`Id`) ON DELETE SET NULL ON UPDATE CASCADE" ;
								array_push($this->sqlStatementArray,$sql);
								$result2 = $Link->query($sql);
								if ($result2) {
									$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                        Relationship '.$this->DataModel->objects[$i].'_Single_'.$this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k].' created successfully...
                                        </div>';
								} else {
									$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                        Relationship '.$this->DataModel->objects[$i].'_Single_'.$this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k].' could not be created...<br>
                                        MySQL Error: ' . mysqli_error($Link).'
                                        </div>';
									$this->syncStatus = false;
								}
							} else {
								$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                        Relationship '.$this->DataModel->objects[$i].'_Single_'.$this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k].' could not be created...<br>
                                        MySQL Error: ' . mysqli_error($Link).'
                                        </div>';
								$this->syncStatus = false;
							}
						} else {
							$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                        Relationship '.$this->DataModel->objects[$i].'_Single_'.$this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k].' could not be created...<br>
                                        MySQL Error: ' . mysqli_error($Link).'
                                        </div>';
							$this->syncStatus = false;
						}
					} else {
						// The relationship exists, but let's check the Search Meta field
						if (!$this->FieldExists($this->DataModel->objects[$i],'SearchMetaInfo',$Link)) {
							$sql = "ALTER TABLE ".$this->DataModel->objects[$i]." ADD SearchMetaInfo TEXT";
							array_push($this->sqlStatementArray,$sql);
							$resultSearchMeta = $Link->query($sql);
							if (!$resultSearchMeta) {
								$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                        Search Meta Info for Relationship '.$this->DataModel->objects[$i].'_Single_'.$this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k].' could not be created...<br>
                                        MySQL Error: ' . mysqli_error($Link).'
                                        </div>';
								$this->syncStatus = false;
							}
						}
					}
				}
			}
		}
		return $htmlToReturn;
	}
	protected function checkLockingConstraintColumns($Link) {
		$htmlToReturn = '';
		for ($i=0;$i<sizeof($this->DataModel->objects);$i++) {
			$sql = "SHOW columns from ".$this->DataModel->objects[$i]." where field='LastUpdated'";
			$Result = $Link->query($sql);
			if ($Result) {
				if (mysqli_num_rows($Result) == 0) {
					// This table does not have the LastUpdated column. We need to add it
					$sql = "ALTER table ".$this->DataModel->objects[$i]." ADD LastUpdated TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP";
					$Result = $Link->query($sql);
					if ($Result) {
						$htmlToReturn .= '<div class="alert alert-success" role="alert">
								            <strong>Locking Constraint Fields:</strong> Add for table: '.$this->DataModel->objects[$i].'<br>
                                          </div>';
					} else {
						$htmlToReturn .= '<div class="alert alert-danger" role="alert">
								            <strong>Locking Constraint Fields:</strong> COULD NOT Add for table: '.$this->DataModel->objects[$i].'<br>
								            MySQL Error: ' . mysqli_error($Link).'
                                          </div>';
						$this->syncStatus = false;
					}
				}
			} else {
				$htmlToReturn .= '<div class="alert alert-danger" role="alert">
								            <strong>Locking Constraint Fields:</strong> COULD NOT ATTEMPT to Add for table: '.$this->DataModel->objects[$i].'<br>
								            MySQL Error: ' . mysqli_error($Link).'
                                          </div>';
				$this->syncStatus = false;
			}
		}
		return $htmlToReturn;
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	protected function getCurrentDBStatus() {
		$Link = $this->connectDB();
		$htmlToReturn = '';
		$syncStatusLable = '';
		if ($this->showSyncStatus) {
			if ($this->syncStatus)
				$syncStatusLable = '<small class="pull-right"><span class="label label-success">Sync Succeeded!</span></small>';
			else
				$syncStatusLable = '<small class="pull-right"><span class="label label-danger">Sync Failed!</span></small>';
		}
		$htmlToReturn .= '<h4 class="page-header" style="margin-top: 0px;">Current Database Status'.$syncStatusLable.'
                </h4>';
		
		$sql = "SHOW TABLES FROM $this->db_name";
		array_push($this->sqlStatementArray,$sql);
		$result = $Link->query($sql);
		if (!$result) {
			$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                            <strong>DB Error!</strong> could not list tables<br>
                                            MySQL Error: ' . mysqli_error($Link).'
                                          </div>';
			return $htmlToReturn;
		}
		$num_tables = mysqli_num_rows( $result );
		$htmlToReturn .= '<p>The app definition currently has '.sizeof($this->DataModel->objects).' objects</p>';
		
		$totalExpectedTables = sizeof($this->DataModel->objects);
		for ($i=0;$i<sizeof($this->DataModel->objects);$i++)
		{
			if (array_key_exists($this->DataModel->objects[$i], $this->DataModel->objectManyRelations))
			{
				$totalExpectedTables += sizeof($this->DataModel->objectManyRelations[$this->DataModel->objects[$i]]);
			}
		}
		$htmlToReturn .= '<p>The expected amount of tables based on the app definition is: '.$totalExpectedTables.'</p>';
		if ($totalExpectedTables != $num_tables) {
			$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                            <strong>Synchronization Required!</strong> The database currently has '.$num_tables.' tables, listed below:
                                          </div>';
		} else {
			$htmlToReturn .= '<div class="alert alert-info" role="alert">
                                            <strong>All Good!</strong> Table count matches App Definition<br>
                                            Only Synchronize if you have added fields or relationships
                                          </div>';
		}
		while ($row = mysqli_fetch_row($result)) {
			$htmlToReturn .= 'Table: '.$row[0].'<br>';
		}
		return $htmlToReturn;
	}
	
	protected function ResetDB() {
		$Link = $this->connectDB();
		$this->syncStatus = true;
		$this->showSyncStatus = true;
		$htmlToReturn = '';
		$htmlToReturn .= '<h4 class="page-header" style="margin-top: 0px;">Reset Summary</h4>';
		$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                            <strong>Backup</strong> Reset backup created "'.$this->backupDB(true).'"<br>
                                          </div>';
		$sql = "SHOW TABLES FROM $this->db_name";
		array_push($this->sqlStatementArray,$sql);
		$result = $Link->query($sql);
		if (!$result) {
			$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                            <strong>DB Error!</strong> could not list tables<br>
                                            MySQL Error: ' . mysqli_error($Link).'
                                          </div>';
			return $htmlToReturn;
		}
		$htmlToReturn .= '<h4>Dropping all tables...</h3>';
		$allDropped = true;
		$preSql = 'SET FOREIGN_KEY_CHECKS = 0';
		array_push($this->sqlStatementArray,$preSql);
		$preResult = $Link->query($preSql);
		if (!$preResult) {
			$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                            <strong>DB Error!</strong> could not ignore constraints<br>
                                            MySQL Error: ' . mysqli_error($Link).'
                                          </div>';
			return $htmlToReturn;
		}
		while ($row = mysqli_fetch_row($result)) {
			$sql1 = "DROP TABLE {$row[0]}";
			array_push($this->sqlStatementArray,$sql1);
			$result1 = $Link->query($sql1);
			if ($result1) {
				$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                           Table '.$row[0].' dropped successfully...
                                          </div>';
			}
			$allDropped = $allDropped && $result1;
		}
		mysqli_free_result($result);
		if ($allDropped)
		{
			for ($i=0;$i<sizeof($this->DataModel->objects);$i++)
			{
				$sql="CREATE TABLE ".$this->DataModel->objects[$i]."(";
				for ($j=0;$j<sizeof($this->DataModel->objectAttributes[$this->DataModel->objects[$i]]);$j++)
				{
					if ($j == 0)
					{
						$sql .= "Id INT UNIQUE AUTO_INCREMENT, ";
					}
					else
					{
						$sql .= ", ";
					}
					$sql .= $this->DataModel->objectAttributes[$this->DataModel->objects[$i]][$j]." ".$this->DataModel->objectAttributeTypes[$this->DataModel->objects[$i]][$j];
				}
				//$sql .= ", LastUpdated TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP";
				$sql .= ")";
				array_push($this->sqlStatementArray,$sql);
				$result = $Link->query($sql);
				if ($result) {
					$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                           Table '.$this->DataModel->objects[$i].' created successfully...
                                          </div>';
				}
				else
				{
					$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                           Table '.$this->DataModel->objects[$i].' could not be created...<br>
                                           MySQL Error: ' . mysqli_error($Link).'
                                          </div>';
					$this->syncStatus = false;
				}
			}
			// Create relationships
			for ($i=0;$i<sizeof($this->DataModel->objects);$i++)
			{
				// Create 1-to-many relationships
				if (array_key_exists($this->DataModel->objects[$i], $this->DataModel->objectSingleRelations))
				{
					for ($k=0;$k<sizeof($this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]]);$k++)
					{
						$htmlToReturn .= '<div class="alert alert-info" role="alert">
                                           Creating Relationship One-to-Many '.$this->DataModel->objects[$i].'_'.$this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k].'...
                                          </div>';
						$sql = "ALTER TABLE ".$this->DataModel->objects[$i]." ADD ".$this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k]." INT";
						array_push($this->sqlStatementArray,$sql);
						$result = $Link->query($sql);
						$sql = "ALTER TABLE ".$this->DataModel->objects[$i]." ADD SearchMetaInfo TEXT";
						array_push($this->sqlStatementArray,$sql);
						$resultSearchMeta = $Link->query($sql);
						if ($result) {
							$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                                    Relationship '.$this->DataModel->objects[$i].'_Single_'.
								$this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k].' reference Id added
                                                </div>';
							$sql = "ALTER TABLE ".$this->DataModel->objects[$i]." ADD INDEX (".$this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k].")";
							array_push($this->sqlStatementArray,$sql);
							$result1 = $Link->query($sql);
							if ($result1) {
								$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                                    Relationship '.$this->DataModel->objects[$i].'_Single_'.
									$this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k].' reference Id Index added
                                                    </div>';
								$sql = "ALTER TABLE " .$this->DataModel->objects[$i]." ADD CONSTRAINT ".
									$this->DataModel->objects[$i]."_".$this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k].
									" FOREIGN KEY ( ".$this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k].") REFERENCES ".
									($this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k])."
                             (`Id`) ON DELETE SET NULL ON UPDATE CASCADE " ;
								array_push($this->sqlStatementArray,$sql);
								$result2 = $Link->query($sql);
								if ($result2) {
									$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                                            Relationship '.$this->DataModel->objects[$i].'_Single_'.
										$this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k].' created successfully...
                                                        </div>';
								} else {
									$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                                            Relationship '.$this->DataModel->objects[$i].'_Single_'.
										$this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k].' could not be created...<br>
                                                            MySQL Error: ' . mysqli_error($Link).'
                                                        </div>';
									$this->syncStatus = false;
								}
							} else {
								$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                                            Relationship '.$this->DataModel->objects[$i].'_Single_'.
									$this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k].' could not be created...<br>
                                                            MySQL Error: ' . mysqli_error($Link).'
                                                        </div>';
								$this->syncStatus = false;
							}
						} else {
							$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                                            Relationship '.$this->DataModel->objects[$i].'_Single_'.
								$this->DataModel->objectSingleRelations[$this->DataModel->objects[$i]][$k].' could not be created...<br>
                                                            MySQL Error: ' . mysqli_error($Link).'
                                                        </div>';
							$this->syncStatus = false;
						}
					}
				}
				// Create many-to-many relationships
				if (array_key_exists($this->DataModel->objects[$i], $this->DataModel->objectManyRelations))
				{
					for ($k=0;$k<sizeof($this->DataModel->objectManyRelations[$this->DataModel->objects[$i]]);$k++)
					{
						$htmlToReturn .= '<div class="alert alert-info" role="alert">
                                           Creating Relationship Many-to-Many '.$this->DataModel->objects[$i].'_'.$this->DataModel->objectManyRelations[$this->DataModel->objects[$i]][$k].'...
                                          </div>';
						$sql="CREATE TABLE ".$this->DataModel->objects[$i]."_".$this->DataModel->objectManyRelations[$this->DataModel->objects[$i]][$k].
							"_assn (".$this->DataModel->objects[$i]."ID INT,
                        ".$this->DataModel->objectManyRelations[$this->DataModel->objects[$i]][$k]."ID INT)";
						array_push($this->sqlStatementArray,$sql);
						$result = $Link->query($sql);
						if ($result) {
							$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                                Table '.$this->DataModel->objects[$i].'_'.
								$this->DataModel->objectManyRelations[$this->DataModel->objects[$i]][$k].'_assn created successfully...
                                                </div>';
							$sql = "ALTER TABLE ".$this->DataModel->objects[$i]."_".$this->DataModel->objectManyRelations[$this->DataModel->objects[$i]][$k].
								"_assn ADD INDEX (".$this->DataModel->objects[$i]."ID)";
							array_push($this->sqlStatementArray,$sql);
							$result1 = $Link->query($sql);
							if ($result1) {
								$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                                        Index for '.$this->DataModel->objects[$i].'ID added successfully...
                                                    </div>';
								$sql = "ALTER TABLE ".$this->DataModel->objects[$i]."_".$this->DataModel->objectManyRelations[$this->DataModel->objects[$i]][$k].
									"_assn ADD INDEX (".$this->DataModel->objectManyRelations[$this->DataModel->objects[$i]][$k]."ID)";
								array_push($this->sqlStatementArray,$sql);
								$result2 = $Link->query($sql);
								if ($result2) {
									$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                                        Index for '.$this->DataModel->objectManyRelations[$this->DataModel->objects[$i]][$k].'ID added successfully...
                                                    </div>';
								}
							}
							
							$sql = "ALTER TABLE ".$this->DataModel->objects[$i]."_".$this->DataModel->objectManyRelations[$this->DataModel->objects[$i]][$k].
								"_assn ADD UNIQUE (".$this->DataModel->objects[$i]."ID)";
							array_push($this->sqlStatementArray,$sql);
							$result3 = $Link->query($sql);
							if ($result3) {
								$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                                        Unique for '.$this->DataModel->objects[$i].'ID added successfully...
                                                    </div>';
								$sql = "ALTER TABLE ".$this->DataModel->objects[$i]."_".$this->DataModel->objectManyRelations[$this->DataModel->objects[$i]][$k].
									"_assn ADD UNIQUE (".$this->DataModel->objectManyRelations[$this->DataModel->objects[$i]][$k]."ID)";
								array_push($this->sqlStatementArray,$sql);
								$result4 = $Link->query($sql);
								if ($result4) {
									$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                                        Unique for '.$this->DataModel->objectManyRelations[$this->DataModel->objects[$i]][$k].'ID added successfully...
                                                    </div>';
								}
							}
							
							$sql = "ALTER TABLE ".$this->DataModel->objects[$i]."_".$this->DataModel->objectManyRelations[$this->DataModel->objects[$i]][$k].
								"_assn ADD FOREIGN KEY ( ".$this->DataModel->objects[$i]."ID) REFERENCES ".($this->DataModel->objects[$i])."
                             (`Id`) ON DELETE SET NULL ON UPDATE CASCADE" ;
							array_push($this->sqlStatementArray,$sql);
							$result5 = $Link->query($sql);
							if ($result5) {
								$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                                        Foreign key for '.$this->DataModel->objects[$i].'ID added successfully...
                                                    </div>';
							} else {
								$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                                        Foreign key for '.$this->DataModel->objects[$i].'ID could not be created...<br>
                                                        MySQL Error: ' . mysqli_error($Link).'
                                                    </div>';
								$this->syncStatus = false;
							}
							
							$sql = "ALTER TABLE ".$this->DataModel->objects[$i]."_".$this->DataModel->objectManyRelations[$this->DataModel->objects[$i]][$k].
								"_assn ADD FOREIGN KEY ( ".$this->DataModel->objectManyRelations[$this->DataModel->objects[$i]][$k]."ID) REFERENCES ".
								($this->DataModel->objectManyRelations[$this->DataModel->objects[$i]][$k])."
                             (`Id`) ON DELETE SET NULL ON UPDATE CASCADE" ;
							array_push($this->sqlStatementArray,$sql);
							$result6 = $Link->query($sql);
							if ($result6) {
								$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                                        Foreign key for '.$this->DataModel->objectManyRelations[$this->DataModel->objects[$i]][$k].'ID added successfully...
                                                    </div>';
							} else {
								$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                                        Foreign key for '.$this->DataModel->objectManyRelations[$this->DataModel->objects[$i]][$k].
									'ID could not be created...<br>
                                                        MySQL Error: ' . mysqli_error($Link).'
                                                    </div>';
								$this->syncStatus = false;
							}
							
							$sql = "ALTER TABLE ".$this->DataModel->objects[$i]."_".$this->DataModel->objectManyRelations[$this->DataModel->objects[$i]][$k].
								"_assn ADD PRIMARY KEY (".$this->DataModel->objects[$i]."ID,".$this->DataModel->objectManyRelations[$this->DataModel->objects[$i]][$k]."ID)";
							array_push($this->sqlStatementArray,$sql);
							$result7 = $Link->query($sql);
							if ($result7) {
								$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                                        Composite Primary key for '.$this->DataModel->objects[$i].'_'.
									$this->DataModel->objectManyRelations[$this->DataModel->objects[$i]][$k].'_assn added successfully...
                                                    </div>';
							} else {
								$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                                        Composite Primary key for '.$this->DataModel->objectManyRelations[$this->DataModel->objects[$i]][$k].
									'ID could not be created...<br>
                                                            MySQL Error: ' . mysqli_error($Link).'
                                                    </div>';
								$this->syncStatus = false;
							}
						} else {
							$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                                    Composite Primary key for '.$this->DataModel->objects[$i].'_'.
								$this->DataModel->objectManyRelations[$this->DataModel->objects[$i]][$k].'_assn could not be created...
                                                    MySQL Error: ' . mysqli_error($Link).'
                                                    </div>';
							$this->syncStatus = false;
						}
					}
				}
			}
		} else {
			$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                Could not drop all tables (Possibly because of Foreign key constraints). Please try again...
                                </div>';
			$this->syncStatus = false;
			
		}
		$postSql = 'SET FOREIGN_KEY_CHECKS = 1';
		array_push($this->sqlStatementArray,$postSql);
		$postResult = $Link->query($postSql);
		$this->closeDB($Link);
		return $htmlToReturn;
	}
	
	protected function SyncDB() {
		$this->syncStatus = true;
		$this->showSyncStatus = true;
		$Link = $this->connectDB();
		$htmlToReturn = '';
		$htmlToReturn .= '<h4 class="page-header" style="margin-top: 0px;">Synchronization Summary</h4>';
		$htmlToReturn .= '<div class="alert alert-success" role="alert">
            <strong>Backup</strong> Sync backup created "'.$this->backupDB(false).'"<br>
                                          </div>';
		$htmlToReturn .= $this->checkDropTables($Link);
		$htmlToReturn .= $this->checkCreateTables($Link);
		$htmlToReturn .= $this->checkCreateSingleRelations($Link);
		$htmlToReturn .= $this->checkLockingConstraintColumns($Link);
		$this->closeDB($Link);
		return $htmlToReturn;
	}
	
	protected function UserRoleSync() {
		$Link = $this->connectDB();
		$htmlToReturn = '';
		$htmlToReturn .= '<h4 class="page-header" style="margin-top: 0px;">User Role Synchronization</h4>';
		$sqlRowsToRemove = '';
		$notAtStart = false;
		foreach ($this->DataModel->userRoleListToSetup as $aRole) {
			$sql = "SELECT Role FROM `UserRole` WHERE Role='$aRole';";
			array_push($this->sqlStatementArray,$sql);
			$resultRoleCheck = $Link->query($sql);
			// If the role does not exist, we create it
			if (mysqli_num_rows($resultRoleCheck) == 0) {
				// Create the user role
				$sql = "INSERT INTO `UserRole` (Role) VALUES ('$aRole');";
				array_push($this->sqlStatementArray,$sql);
				$resultRoleInsert = $Link->query($sql);
				if (!$resultRoleInsert) {
					$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                            <strong>Error!</strong> could not create user role "'.$aRole.'"<br>
                                            MySQL Error: ' . mysqli_error($Link).'
                                          </div>';
					$this->syncStatus = false;
				} else {
					$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                            User role "'.$aRole.'" has been successfully added
                                          </div>';
				}
			}
			if ($notAtStart)
				$sqlRowsToRemove .= "AND ";
			$sqlRowsToRemove .= "NOT Role = '".$aRole."' ";
			$notAtStart = true;
			$this->createUserRoleFolders($aRole);
		}
		// Remove roles that are not required anymore
		$sqlRoleRemove = "DELETE FROM `UserRole` WHERE ".$sqlRowsToRemove.";";
		array_push($this->sqlStatementArray,$sqlRoleRemove);
		$resultRoleRemove = $Link->query($sqlRoleRemove);
		if (!$resultRoleRemove) {
			$htmlToReturn .= '<div class="alert alert-danger" role="alert">
                                            <strong>Error!</strong> Could not remove redundant user roles<br>
                                            MySQL Error: ' . mysqli_error($Link).'
                                          </div>';
			$this->syncStatus = false;
		} else {
			$htmlToReturn .= '<div class="alert alert-success" role="alert">
                                            Redundant User roles have been successfully removed
                                          </div>';
		}
		$this->closeDB($Link);
		return $htmlToReturn;
	}
	
	protected function createUserRoleFolders($userRole) {
		if (!file_exists('../App/'.$userRole)) {
			mkdir('../App/'.$userRole, 0777, true);
		}
		if (!file_exists('../App/'.$userRole.'/index.php')) {
			$generatedFile = fopen('../App/'.$userRole.'/index.php', "w") or die("Unable to open file!");
			$code = '<?php
require(\'../../sdev.inc.php\');

if (!checkRole(array(\''.$userRole.'\')))
    AppSpecificFunctions::Redirect(__USRMNG__.\'/login/\');

class '.$userRole.'IndexForm extends QForm {
    public function Form_Create() {
        parent::Form_Create();
    }
}
'.$userRole.'IndexForm::Run(\''.$userRole.'IndexForm\');
?>';
			fwrite($generatedFile, $code);
			fclose($generatedFile);
		}
		
		if (!file_exists('../App/'.$userRole.'/index.tpl.php')) {
			$generatedFile = fopen('../App/'.$userRole.'/index.tpl.php', "w") or die("Unable to open file!");
			$code = '<?php $strPageTitle = \''.$userRole.' Home\';?>
<?php require(__CONFIGURATION__ . \'/header_with_nav.inc.php\');?>

<?php $this->RenderBegin();?>
<h1 class="page-header">'.$userRole.' Home page</h1>

<?php $this->RenderEnd();?>

<?php require(__CONFIGURATION__ . \'/footer.inc.php\');	?>';
			fwrite($generatedFile, $code);
			fclose($generatedFile);
		}
	}
	
	protected function backupDB($isReset = true) {
		$protocol = 'http://';
		if (AppSpecificFunctions::isSecure())
			$protocol = 'https://';
		$server = $_SERVER['SERVER_NAME'];
		if ($isReset)
			$url = $protocol.$server.__DBMNG__.'/db_backup.php?auth='.urlencode(__MAINTENANCEPWD__).'&f=LastReset_backup';
		else
			$url = $protocol.$server.__DBMNG__.'/db_backup.php?auth='.urlencode(__MAINTENANCEPWD__).'&f=LastSync_backup';

//echo $url;
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
			// Provide the url to the backup script here
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true
		));
		$result = curl_exec($curl);
		curl_close($curl);
		return $result;
	}
	protected function restoreDB($beforeReset = true) {
		$protocol = 'http://';
		if (AppSpecificFunctions::isSecure())
			$protocol = 'https://';
		$server = $_SERVER['SERVER_NAME'];
		if ($beforeReset)
			$url = $protocol.$server.__DBMNG__.'/db_restore.php?auth='.urlencode(__MAINTENANCEPWD__).'&sql=LastReset_backup.sql';
		else
			$url = $protocol.$server.__DBMNG__.'/db_restore.php?auth='.urlencode(__MAINTENANCEPWD__).'&sql=LastSync_backup.sql';
		
		//return $url;
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
			// Provide the url to the backup script here
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true
		));
		$result = curl_exec($curl);
		curl_close($curl);
		//var_dump($result);
		return $result;
	}
	
	protected function checkTableNamesCase() {
		$Link = $this->connectDB();
		$strQuery = "SHOW VARIABLES LIKE 'lower_case_table_names'";
		array_push($this->sqlStatementArray,$strQuery);
		$objResult = $Link->query($strQuery);
		while ($row=mysqli_fetch_row($objResult)) {
			if ($row[1] == 2) {
				return true; //All good
			}
		}
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			while ($row=mysqli_fetch_row($objResult)) {
				if ($row[1] == 2) {
					return true; //All good
				}
			}
		} else {
			// We assume it is fine, since it is not Windows
			return true;
		}
		return false;
	}
	
	protected function getSQLSet() {
		$strSqlSet = '';
		foreach ($this->sqlStatementArray as $statement) {
			$strSqlSet .= $statement.'<br>';
		}
		return $strSqlSet;
	}
	protected function logCurrentMemory($Prefix = '') {
		AppSpecificFunctions::AddCustomLog($Prefix.' Current memory: '.AppSpecificFunctions::getSizeSymbolByQuantity(memory_get_usage(true)));
	}
}
ManageDBForm::Run('ManageDBForm');
?>