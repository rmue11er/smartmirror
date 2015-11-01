<?php 
require_once("./modules/news/reddit.php");
$reddit = new reddit("basic");

$obj = $reddit->getListing("news", 5);
?>

<div class="screen bottom" id="scrollerWrapper">
	<ul id="scroller">
		<?php
			for($z = 0; $z < 6; $z++){
				$title = $obj->data->children[$z]->data->title;
				echo("<li>+++ ".$title."</li>");
			}
		?>
	</ul>
</div>