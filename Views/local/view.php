<!-- view for local -->
<!-- view shows the article body and image -->

<div class="mb-2">	
	<p><?= esc($local['body']) ?></p>
	<img src="<?=base_url()?>/<?=esc($local['image'])?>"width="50%" class="img-fluid rounded mx-auto d-block">
</div>	