<?php 
class Updater {
	
	var $config = "";
	var $hostname = "rene-uchiha";
	var $userid = 0;
	
	function checkFile($bool){
		if($bool == true){
			if(!file_exists("./updater/config.dat")){
				$cfg = fopen("./updater/config.dat", "w") or die("<b>Couldn't retrieve update:</b> <em>config.dat</em> isn't writable!");
				fwrite($cfg, "server=".$this->hostname.";");
				fwrite($cfg, "userid=".$this->userid.";");
				fclose($cfg);
			}
		} else {
			$cfg = fopen("./updater/config.dat", "w") or die("<b>Couldn't retrieve update:</b> <em>config.dat</em> isn't writable!");
			fwrite($cfg, "server=".$this->hostname.";");
			fwrite($cfg, "userid=".$this->userid.";");
			fclose($cfg);
		}
	}
	
	
	function Updater(){
		$this->userid = 3; //@TODO read from external file
		
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
	
	function getUniqueId(){
		$uid = explode('=', $this->config[1]);
		
		return $uid[1];
	}
}
?>