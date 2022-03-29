<!-- view for world -->
<!-- view shows the article body and image -->

<div class="mb-2">	
	<p><?= esc($world['body']) ?></p>
	<img src="<?=base_url()?>/<?=esc($world['image'])?>"width="50%" class="img-fluid rounded mx-auto d-block">
</div>	
