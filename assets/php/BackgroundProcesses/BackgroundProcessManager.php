<?php
/**
 * Created by PhpStorm.
 * User: Johan Griesel (Stratusolve (Pty) Ltd)
 * Date: 2017/02/18
 * Time: 10:07 AM
 */
class BackgroundProcessManager {
	// The array containing key => value pairs for post data
	public $PostData = array();
	protected $BackgroundProcessObject;
	public $Timeout = 300; //300 Seconds or 5 Minutes. This can be set to anything you deem reasonable for your script, but is mandatory to prevent processes from killing the server with infinite loops
	public $MaxMemoryUsage = 32; //Value set in Megabytes. Once the background script reaches this limit, it will fail with a message
	
	public $ErrorArray = array();
	public function __construct($argv) {
		if (isset($argv)) {
			foreach ($argv as $arg) {
				$KeyValue = explode('=',$arg);
				if (sizeof($KeyValue) == 2) {
					$this->PostData[$KeyValue[0]] = $KeyValue[1];
				}
			}
		}
	}
	
	public function initProcess($Timeout = 300,$MaxMemoryUsage = 32) {
		//This ensures that something cannot just run this script from their browser
		if (isset($this->PostData['SystemPassword'])) {
			if ($this->PostData['SystemPassword'] != __MAINTENANCEPWD__) {
				array_push($this->ErrorArray,'No authorisation');
				return false;
			}
		} else {
			array_push($this->ErrorArray,'No authorisation');
			return false;
		}
		if (!isset($this->PostData['PId'])) {
			array_push($this->ErrorArray,'No Process ID Provided');
			return false;
		}
		$this->BackgroundProcessObject = BackgroundProcess::QuerySingle(QQ::Equal(QQN::BackgroundProcess()->PId,$this->PostData['PId']));
		if (!$this->BackgroundProcessObject) {
			array_push($this->ErrorArray,'Process could not be retrieved via PId');
			return false;
		}
		if (strpos(strtoupper($this->BackgroundProcessObject->Status),'COMPLETED') !== false) {
			//Already done
			array_push($this->ErrorArray,'Process completed already');
			return false;
		}
		$this->Timeout = $Timeout;
		set_time_limit($this->Timeout);
		$this->MaxMemoryUsage = $MaxMemoryUsage;
		return true;
	}
	public function updateProcess_Running($Message) {
		$BackgroundProcessObjectFromDb = BackgroundProcess::QuerySingle(QQ::Equal(QQN::BackgroundProcess()->PId,$this->BackgroundProcessObject->PId));
		if (!$BackgroundProcessObjectFromDb) {
			$this->failProcess();
			return false;
		}
		if (strpos(strtoupper($BackgroundProcessObjectFromDb->Status),'COMPLETED') !== false) {
			//Already done
			array_push($this->ErrorArray,'Process completed already');
			return false;
		}
		if ($this->checkTimeout()) {
			return false;
		}
		if ($this->checkMemoryLimit()) {
			return false;
		}
		if (!AppSpecificFunctions::updateBackgroundProcess($this->BackgroundProcessObject->PId,$Message,'Running')) {
			//Something went wrong while updating. We should kill the process now.
			$this->failProcess();
			return false;
		}
		return true;
	}
	public function updateProcess_Completed_Successfully($Message,$AdditionalSummaryDetails = '') {
		$BackgroundProcessObjectFromDb = BackgroundProcess::QuerySingle(QQ::Equal(QQN::BackgroundProcess()->PId,$this->BackgroundProcessObject->PId));
		if (!$BackgroundProcessObjectFromDb) {
			$this->failProcess();
			return false;
		}
		if (strpos(strtoupper($BackgroundProcessObjectFromDb->Status),'COMPLETED') !== false) {
			//Already done
			array_push($this->ErrorArray,'Process completed already');
			return false;
		}
		if ($this->checkTimeout()) {
			return false;
		}
		if ($this->checkMemoryLimit()) {
			return false;
		}
		$Summary = 'Process started: '.$BackgroundProcessObjectFromDb->StartDateTime->format(DATE_TIME_FORMAT_HTML.' H:i:s').'
Process ended: '.QDateTime::Now()->format(DATE_TIME_FORMAT_HTML.' H:i:s').'
'.$AdditionalSummaryDetails;
		if (!AppSpecificFunctions::updateBackgroundProcess($this->BackgroundProcessObject->PId,$Message,'Completed Successfully',$Summary)) {
			//Something went wrong while updating. We should kill the process now.
			$this->failProcess();
			return false;
		}
		return true;
	}
	public function updateProcess_Completed_Failed($Message,$AdditionalSummaryDetails = '') {
		$BackgroundProcessObjectFromDb = BackgroundProcess::QuerySingle(QQ::Equal(QQN::BackgroundProcess()->PId,$this->BackgroundProcessObject->PId));
		if (!$BackgroundProcessObjectFromDb) {
			$this->failProcess();
			return false;
		}
		if (strpos(strtoupper($BackgroundProcessObjectFromDb->Status),'COMPLETED') !== false) {
			//Already done
			array_push($this->ErrorArray,'Process completed already');
			return false;
		}
		if ($this->checkTimeout()) {
			return false;
		}
		if ($this->checkMemoryLimit()) {
			return false;
		}
		$Summary = 'Process started: '.$BackgroundProcessObjectFromDb->StartDateTime->format(DATE_TIME_FORMAT_HTML.' H:i:s').'
		Process ended: '.QDateTime::Now()->format(DATE_TIME_FORMAT_HTML.' H:i:s').'
		'.$AdditionalSummaryDetails;
		if (!AppSpecificFunctions::updateBackgroundProcess($this->BackgroundProcessObject->PId,$Message,'Completed Failed',$Summary)) {
			//Something went wrong while updating. We should kill the process now.
			$this->failProcess();
			return false;
		}
		return true;
	}
	protected function failProcess() {
		$this->BackgroundProcessObject->Status = 'Completed Failed';
		$this->BackgroundProcessObject->Summary = json_encode($this->ErrorArray);
		try {
			$this->BackgroundProcessObject->Save(false,true);
		} catch (QCallerException $e) {
			array_push($this->ErrorArray,'Unexpected error: '.$e->getMessage());
		}
	}
	protected function checkTimeout() {
		if ((time() - $this->BackgroundProcessObject->StartDateTime->getTimestamp()) > $this->Timeout) {
			array_push($this->ErrorArray,'Process timed out after '.$this->Timeout.' seconds...');
			$this->failProcess();
			return true; // We've timed out
		}
		return false; // We have not timed out yet...
	}
	protected function checkMemoryLimit() {
		$MaxMemory = memory_get_peak_usage(true)/1024/1024;
		if ($MaxMemory >= $this->MaxMemoryUsage) {
			array_push($this->ErrorArray,'Process reached the maximum memory limit ('.$this->MaxMemoryUsage.'MB). You can increase this in your background process script.');
			$this->failProcess();
			return true; // We've reached max memory
		}
		return false; // We have not reached max memory yet...
	}
}
?>