<!-- overview for uk -->

<p id="ajaxArticle"></p>

<a href="<?=base_url()?>/uk/create">Create Article</a><br /><br /> 

<?php if (! empty($uk) && is_array($uk)): ?>

	<?php foreach ($uk as $news_item): ?>
	
	<h3><?= esc($news_item['title']) ?></h3>
	
	<div class="main">
		<?= esc($news_item['body']) ?>
    </div> 
	<p><a href="<?=base_url()?>/uk/<?= esc($news_item['slug'], 'url') ?>">View article</a></p>
	
	<p><button onclick="getData('<?= esc($news_item['slug'], 'url') ?>')">View article via Ajax</button></p>
	
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
		fetch('http://mi-linux.wlv.ac.uk/~1827197/project-root/public/ukajax/get/' + slug)
		
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