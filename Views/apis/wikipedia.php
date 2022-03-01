<?php foreach($links->query->exturlusage->eu as $link):?>

	<h2><?=$link['title']?></h2>
	<p>Links to: <a href='<?$link['url']?>'><?=$link['url']?></a></p>
	<p>pageid: <?=$link['pageid']?></p>

<?php endforeach?>