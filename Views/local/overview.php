<!-- overview for local -->

<a class="btn btn-primary mb-2 py-2" href="<?=base_url()?>/local/create">Create Article</a><br /><br /> 

<?php if (! empty($local) && is_array($local)): ?>
	
	<?php if($message == 1):?>
		<div class="alert alert-success" id="ajaxArticle" role="alert">Article Added</div>
	<?php elseif($message == 2):?>
		<div class="alert alert-danger" id="ajaxArticle" role="alert">Article Deleted</div>
	<?php endif;?>

	<div id ="spin" class="spinner-border" role="status" style="visibility: hidden">
		<span class="visually-hidden">Loading...</span>
	</div>

	<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">

	<?php foreach ($local as $news_item): ?>
	
		<div class="col">
		<div class="card mb-2 h-100">
			<div class="card-body">
				<h5 class="card-title"><?= esc($news_item['title']) ?></h5>
				<p class="card-text">
					<p id="ajaxArticle<?= esc($news_item['slug'], 'url') ?>"></p>
			</div>
		
			<div class="card-footer">
				<div class="btn-group">
					<a href="<?=base_url()?>/local/<?= esc($news_item['slug'], 'url') ?>" class="btn btn-primary">View article</a>
					<button onclick="getData('<?= esc($news_item['slug'], 'url') ?>')" class="btn btn-secondary">View article via Ajax</button>
					<a href="<?=base_url()?>/local/delete/<?= esc($news_item['slug'], 'url') ?>" class=" btn btn-danger">Delete article</a>
				</div>	
			</div>
		</div>
		</div>
	
	<?php endforeach ?>
	
	</div>

<?php else: ?>

    <h3>No News</h3>

    <p>Unable to find any news for you.</p>

<?php endif ?>

<script>
	function getData(slug) {
		
		// show spinner
		document.getElementById("spin").style.visibility = "visible";
		document.getElementById("ajaxArticle" + slug).innerHTML = "Please Wait...";
		
		// fetch data
		fetch('https://mi-linux.wlv.ac.uk/~1827197/project-root/public/localajax/get/' + slug)
		
		// convert response string to json object
		.then(response => response.json())
		.then(response => {
			
			// hide spinner
			document.getElementById("spin").style.visibility = "hidden";
			
			// copy one element of response to the HTML paragraph
			document.getElementById("ajaxArticle" + slug).innerHTML = response.title + ": " + response.body;
		})
		
		.catch(err => {
			
			// display erros in console
			console.log(err)
		});
	}
</script>