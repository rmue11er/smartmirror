<!DOCTYPE html>
<html lang="en">
  <head>
  	<!-- Copyright 2015 René Müller -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SmartMirror</title>

    <!-- CSS -->
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300' rel='stylesheet' type='text/css'> <!-- Font -->
	<link href="css/weather-icons.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
    <!-- JS -->
    <script src="js/jquery.js"></script>
    
  </head>
  <body>
    <?php 
    	//Load Modules
    	$path = "./modules/";
    	$files = null;
    	$modules = null;
	    $iterator = new RecursiveIteratorIterator(
	    		new RecursiveDirectoryIterator($path),
	    		RecursiveIteratorIterator::SELF_FIRST);
	    
	    foreach($iterator as $file) {
	    	if($file->isDir()) {
	    		if($file->getFilename() != "." && $file->getFilename() != ".."){
	    			include("./modules/".$file->getFilename()."/".$file->getFilename().".php");
	    			
	    			$module_files = ";".$module_files;
	    			$files .= $module_files;
	    			$modules .= $module_name.";";
	    		}
	    		
	    	}
	    }	
	    
	    //Format file list
	    $files = substr($files, 1);
	    $files = explode(";", $files);
	    
	    //Load Module-Files
	    for($i = 0; $i < sizeof($files); $i++){
	    	$js = strpos($files[$i], ".js");
	    	$css = strpos($files[$i], ".css");
	    	$php = strpos($files[$i], ".php");
	    	$html = strpos($files[$i], ".html");
	    	
	    	if($js == true) echo '<script src="'.$files[$i].'"></script>';
	    	if($css == true) echo '<link href="'.$files[$i].'" rel="stylesheet">';
	    	if($php == true || $html == true) include($files[$i]);
	    }
    ?>
  </body>
</html>