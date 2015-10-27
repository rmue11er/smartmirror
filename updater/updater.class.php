<?php 
class Updater {
	
	var $config = "";
	var $hostname = "http://smartmirror.rene-uchiha.com/";
	var $userid = 0;
	var $key = "apitest";
	
	//Fetch Files >>update process
	function getTodo($version){
		try {
			$request = hash('sha1', $this->getUniqueId());
			$list = file_get_contents($this->hostname."updates/".$request."/".$version."/list.txt");
			
			return $list;
		} catch (Exception $e) {
		    return null;
		}
	}
	
	function makeUpdate(){
		$version = null;
		if($this->checkNewVersion() != false || $this->checkNewVersion() != null) $version = $this->checkNewVersion();
		
		if($version != null){
			$todo = $this->getTodo($version);
			//@TODO download/delete files ->go threw todo-list
			
			
			$update_version = $this->setVersion($version);
			
			//return
			if($update_version == false){ return false; } else { return true; }
		} else {
			return false;
		}
	}
	
	//Main Checker Classes
	function checkFile($bool){
		if($bool == true){
			if(!file_exists("./updater/config.dat")){
				$cfg = fopen("./updater/config.dat", "w") or die("<b>Couldn't retrieve update:</b> <em>config.dat</em> isn't writable!");
				fwrite($cfg, "server=".$this->hostname.";\r\n");
				fwrite($cfg, "userid=".$this->userid.";");
				fclose($cfg);
			}
		} else {
			$cfg = fopen("./updater/config.dat", "w") or die("<b>Couldn't retrieve update:</b> <em>config.dat</em> isn't writable!");
			fwrite($cfg, "server=".$this->hostname.";\r\n");
			fwrite($cfg, "userid=".$this->userid.";");
			fclose($cfg);
		}
	}
	
	function checkNewVersion(){
		if(!file_exists("./updater/version.dat")){
			$cfg = fopen("./updater/version.dat", "w");
			fwrite($cfg, "0.1");
			fclose($cfg);
		}
		
		try {
			$request = hash('sha1', $this->getUniqueId());
			$version = file_get_contents("./updater/version.dat");
			$update_version = file_get_contents($this->hostname."updates/".$request."/version.txt");
			
			if(floatval($update_version) > floatval($version)){
				return $update_version;
			} else {
				return false;
			}
		} catch (Exception $e) {
		    return false;
		}
	}
	
	
	function Updater(){
		$this->userid = $this->getNewId();
		
		$this->checkFile(true);
		$conf_check = file_get_contents("./updater/config.dat");
		$conf_check = explode(';', $conf_check);
		
		$server_check = explode('=', $conf_check[0]);		
		$uid_check = explode('=', $conf_check[1]);

		if($uid_check[1] == null || $server_check[1] == null) $this->checkFile(false); //creates new, if there is a missing value
		
		//Update the Array
		 $this->config = file_get_contents("./updater/config.dat");
		 $this->config = explode(';', $this->config);
	}
	
	function getServer(){
		$server = explode('=', $this->config[0]);
		
		return $server[1];
	}
	
	function getNewId(){
		try {
			$path = "updates/get_key.php?key=".$this->key; //@TODO add checker if the key is wrong
			
			return file_get_contents($this->hostname.$path);
		} catch (Exception $e) {
			return null;
		}
	}
	
	function getUniqueId(){
		$uid = explode('=', $this->config[1]);
		
		return $uid[1];
	}
	
	function setVersion($version){
		if(file_exists("./updater/version.dat")){
			$cfg = fopen("./updater/version.dat", "w");
			fwrite($cfg, $version);
			fclose($cfg);
		} else {
			return false;
		}
	}
}
?>