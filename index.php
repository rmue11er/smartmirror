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
	    if ($handle = opendir('./modules/')) {
	    
	    	while (false !== ($entry = readdir($handle))) {
		    	if (strpos($entry, ".") !== true) {
				    echo $entry." will be loaded";
				}
	    	}
	    
	    	closedir($handle);
	    }
    ?>
    

    <!-- JS -->
    <script src="js/jquery.js"></script>
  </body>
</html>