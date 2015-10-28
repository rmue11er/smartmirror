<?php 
/**
 * This class is for the Update-system; it downloads the newest file, etc.
 * @author René Müller aka René Uchiha
 * @version 0.1 ALPHA
 */
class Updater {
	
	var $config = "";
	var $hostname = "http://smartmirror.rene-uchiha.com/";
	var $userid = 0;
	var $key = "apitest";
	
	// Fetch Files >>update process
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
			$todo = explode(';', $this->getTodo($version));
			
			for($i = 0; $i < sizeof($todo); $i++){
				if(strpos($todo[$i], 'del') !== FALSE){
					/** Format String **/
					 $todo[$i] = str_replace('del', '', $todo[$i]);
					 $todo[$i] = './'.ltrim($todo[$i]);
					
					if(file_exists($todo[$i])) unlink($todo[$i]);
					if(is_dir($todo[$i])) rmdir($todo[$i]);
				}
				
				if(strpos($todo[$i], 'add') !== FALSE){
					$todo[$i] = str_replace('add', '', $todo[$i]);
					
					$todo[$i] = str_replace(' ', '', $todo[$i]);
					$download = explode('@', $todo[$i]);
					
					$file = fopen($download[1], "w");
					/** @TODO fix loadFile **/
					fwrite($file, $this->loadFile($download[0]));
					fclose($file);
				}
			}
			
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
	
	function loadFile($url) {
		$ch = curl_init();
	
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
	
		$data = curl_exec($ch);
		curl_close($ch);
	
		return $data;
	}
}
?>