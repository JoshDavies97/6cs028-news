<h2><?= esc($title) ?></h2>

<p id="ajaxArticle"></p>

<a class="btn btn-primary mb-2 py-2" href="<?=base_url()?>/news/create">Create Article</a><br /><br /> 

<!--<a href="<?=base_url()?>/index.php/localNews/index">Local News</a> -->

<?php if (! empty($news) && is_array($news)): ?>

	<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">

    <?php foreach ($news as $news_item): ?>
		
		<div class="col">
		<div class="card mb-2 h-100">
			<div class="card-body">
				<h5 class="card-title"><?= esc($news_item['title']) ?></h5>
				<p class="card-text">
			</div>
			
			<div class="card-footer">
				<a href="<?=base_url()?>/news/<?= esc($news_item['slug'], 'url') ?>" class=" btn btn-primary">View article</a><br /><br />
				<a><button onclick="getData('<?= esc($news_item['slug'], 'url') ?>')">View article via Ajax</button></a>
			</div>
		</div>	
		</div>
			
		<!-- <a href="<?=base_url()?>/news/<?= esc($news_item['slug'], 'url') ?>">View article</a></p>  url that's needed when routing -->
		
	<!-- <p><a href="<?=base_url()?>/news/view/<?= esc($news_item['slug'], 'url') ?>">View article</a></p> url that's needed without routing -->

    <?php endforeach ?>

<?php else: ?>

    <h3>No News</h3>

    <p>Unable to find any news for you.</p>

<?php endif ?>

<script>
	function getData(slug) {
		
		// add a loading spinner and a message
		//document.getElementById["spin"].style.visibility = hidden
		//
		
		// fetch data
		fetch('http://mi-linux.wlv.ac.uk/~1827197/project-root/public/ajax/get/' + slug)
		
		// convert response string to json object
		.then(response => response.json())
		.then(response => {
			
			// copy one element of response to the HTML paragraph
			document.getElementById("ajaxArticle").innerHTML = response.title + ": " + response.body;
		})
		
		.catch(err => {
			
			// display erros in console
			console.log(err)
		});
	}
</script>