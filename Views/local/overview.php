<!-- overview for local -->

<a class="btn btn-primary mb-2 py-2" href="<?=base_url()?>/local/create">Create Article</a><br /><br /> 

<?php if (! empty($local) && is_array($local)): ?>
	
	<?php if($message == 1):?>
		<div class="alert alert-success" id="ajaxArticle" role="alert">Article Added</div>
		<script>
			// Let's check if the browser supports notifications
			if (!("Notification" in window)) {
				alert("This browser does not support notifications");
			}

			// Let's check whether notification permissions have already been granted
			else if (Notification.permission === "granted") {
				// notification created if article is created
				var notification = new Notification("Article added!");
			}

			// ask for permission to use notifications
			else if (Notification.permission !== "denied") {
				Notification.requestPermission().then(function (permission) {
					// create a notification if granted permission
					if (permission === "granted") {
					var notification = new Notification("Article added!");
				}
			});
		}
		</script>
	<?php elseif($message == 2):?>
		<div class="alert alert-danger" id="ajaxArticle" role="alert">Article Deleted</div>
		<script>
			// Let's check if the browser supports notifications
			if (!("Notification" in window)) {
				alert("This browser does not support notifications");
			}

			// Let's check whether notification permissions have already been granted
			else if (Notification.permission === "granted") {
				// notification created if article is deleted
				var notification = new Notification("Article deleted!");
			}

			// ask for permission to use notifications
			else if (Notification.permission !== "denied") {
				Notification.requestPermission().then(function (permission) {
					// create a notification if granted permission
					if (permission === "granted") {
					var notification = new Notification("Article deleted!");
				}
			});
		}
		</script>
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
					<a href="<?=base_url()?>/local/<?= esc($news_item['slug'], 'url') ?>" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
						<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
						<path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
						</svg> View</a>
					<button onclick="getData('<?= esc($news_item['slug'], 'url') ?>')" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-view-stacked" viewBox="0 0 16 16">
						<path d="M3 0h10a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3zm0 8h10a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1H3z"/>
						</svg> View via Ajax</button>
					<a href="<?=base_url()?>/local/delete/<?= esc($news_item['slug'], 'url') ?>" class=" btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
						<path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
						</svg> Delete</a>
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