<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SmartMirror</title>

    <!-- CSS -->
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300' rel='stylesheet' type='text/css'> <!-- Font -->
    <link href="css/style.css" rel="stylesheet">
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
	    			$files .= $module_files;
	    			$modules .= $module_name.";";
	    		}
	    		
	    	}
	    }	
	    
	    //Format file list
	    $files = substr($files, 1);
	    $files = explode(";", $files);
	    
	    //Load Module-Files
	    for($i = 0; $i < sizeof($files); $i++)
	    	include($files[$i]);
    ?>
    

    <!-- JS -->
    <script src="js/jquery.js"></script>
  </body>
</html>