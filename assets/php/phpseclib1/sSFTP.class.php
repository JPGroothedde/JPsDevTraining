<?php
/**
 * Created by PhpStorm.
 * User: Johan Griesel (Stratusolve (Pty) Ltd)
 * Date: 2017/02/18
 * Time: 10:07 AM
 * A simple implementation of phpseclib1 for connecting to a server using ssh and/or sftp. Basic functions wrapped:
 * View and change directories. View files
 * Upload and download files
 * NOTE: This class is intended to be used with a separate script that is dedicated to communicating with the ssh server of your choice. Do not include this in AppSpecificFunctions
 */
set_include_path(__DOCROOT__.__APP_PHP_ASSETS__.'/phpseclib1/');
include('Net/SSH2.php');
include('Net/SFTP.php');
include('Crypt/RSA.php');
class sSFTP {
	protected $User,$Key,$Password,$Host,$Port;
	protected $sftp;
	public $ErrorMessageArray = array();
	public function __construct($User = '',$Key = '',$Password = '',$Host = '',$Port = 22) {
		$this->User = $User;
		$this->Key = $Key;
		$this->Password = $Password;
		$this->Host = $Host;
		$this->Port = $Port;
	}
	public function connect($UseKey = true) {
		$this->sftp = new Net_SFTP($this->Host,$this->Port);
		if ($UseKey) {
			$key = new Crypt_RSA();
			if ($key->loadKey($this->Key)) {
			
			} else {
				array_push($this->ErrorMessageArray,'Error loading RSA key');
				$this->sftp = null;
				return false;
			}
		} else {
			$key = $this->Password;
		}
		if (!$this->sftp->login($this->User, $key)) {
			array_push($this->ErrorMessageArray,'SFTP Login failed');
			$this->sftp = null;
			return false;
		}
		return true;
	}
	public function doSSHConnect($UseKey = true) {
		$ssh = new Net_SSH2($this->Host,$this->Port);
		if ($UseKey) {
			$key = new Crypt_RSA();
			if ($key->loadKey($this->Key)) {
			
			} else {
				array_push($this->ErrorMessageArray,'Error loading RSA key');
				$this->sftp = null;
				return false;
			}
		} else {
			$key = $this->Password;
		}
		if (!$ssh->login($this->User, $key)) {
			$message =  $ssh->isConnected() ? 'bad username or password' : 'unable to establish connection';
			array_push($this->ErrorMessageArray,$message);
			$this->sftp = null;
			return false;
		} else {
			return true;
		}
	}
	public function viewSimpleFileFolderList() {
		if (is_null($this->sftp)) {
			array_push($this->ErrorMessageArray,'sftp not initialized');
			return null;
		}
		return $this->sftp->nlist();
	}
	public function goToRootDirectory() {
		if (is_null($this->sftp)) {
			array_push($this->ErrorMessageArray,'sftp not initialized');
			return null;
		}
		$FailSafe = 20;
		$LoopCount = 0;
		while ($this->sftp->pwd() != '/') {
			$this->sftp->chdir('..'); // go back to the parent directory
			$LoopCount++;
			if ($LoopCount > $FailSafe)
				break;
		}
	}
	public function getCurrentDirectoryName() {
		if (is_null($this->sftp))
			return '';
		return $this->sftp->pwd();
	}
	public function changeDirectory($Name = '/') {
		if (is_null($this->sftp)) {
			array_push($this->ErrorMessageArray,'sftp not initialized');
			return;
		}
		$this->sftp->chdir($Name);
	}
	public function uploadFile($FilePath = '',$FileName = 'default_file.remote') {
		if (is_null($this->sftp)) {
			array_push($this->ErrorMessageArray,'sftp not initialized');
			return false;
		}
		if (!file_exists($FilePath)){
			array_push($this->ErrorMessageArray,'Filepath : '.$FilePath.' does not exist');
			return false;
		}
		if ($this->sftp->put($FileName, $FilePath, NET_SFTP_LOCAL_FILE)){
			return true;
		}
		array_push($this->ErrorMessageArray,$this->sftp->getSFTPLog());
		return false;
	}
	public function downloadFile($RemoteFileName = '') {
		$Result = '';
		if (is_null($this->sftp)) {
			array_push($this->ErrorMessageArray,'sftp not initialized');
			return $Result;
		}
		$Result = $this->sftp->get($RemoteFileName);
		if ($Result == false) {
			array_push($this->ErrorMessageArray,$this->sftp->getSFTPLog());
			return '';
		} else {
			array_push($this->ErrorMessageArray,$this->sftp->getSFTPLog());
			return $Result;
		}
	}
}