<?php 
require_once("./modules/news/reddit.php");
$reddit = new reddit("basic");

$obj = $reddit->getListing("news", 5);
?>

<div class="screen bottom" id="scrollerWrapper">
	<ul id="scroller">
		<?php
			$failure = false;
			$output = null;
			for($z = 0; $z < 5; $z++){
				$title = $obj->data->children[$z]->data->title;
				$output .= "<li> +++ ".$title. "&nbsp;</li>";
				if($title == null) $failure = true;
			}
			
			if($failure == false){
				echo $output;
			}
		?>
	</ul>
</div>