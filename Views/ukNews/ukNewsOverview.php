<?php if (! empty($ukNews) && is_array($ukNews)): ?>

	<?php foreach ($ukNews as $news_item): ?>
	
	<h3><?= esc($news_item['title']) ?></h3>
	
	<div class="main">
		<?= esc($news_item['body']) ?>
    </div>
	<p><a href="<?=base_url()?>/ukNews/view/<?= esc($news_item['slug'], 'url') ?>">View article</a></p>
	
	<?php endforeach ?>

<?php else: ?>

    <h3>No News</h3>

    <p>Unable to find any news for you.</p>

<?php endif ?>