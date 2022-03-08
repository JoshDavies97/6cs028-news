<h2><?= esc($title) ?></h2>

<!--- function is used to report errors related to CSRF protection --->
<?= session()->getFlashdata('error') ?>

<!--- function is used to report errors related to form validation --->
<?= service('validation')->listErrors() ?>

<form action="<?=base_url()?>/news/create" method="post">
	
	<!--- function creates a hidden input with a CSRF token that helps protect against common attacks --->
	<?= csrf_field() ?>
	
	<!--- title of article --->
	<div class="mb-3">
		<label for="title" class="form-label">Title</label>
		<input class="form-control "type="input" name="title" /><br />
	</div>
	
	<!--- text of article --->
	<div class="mb-3">
		<label for="body" class="form-label">Text</label>
		<textarea class="form-control name="body" cols="45" rows="4"></textarea><br />
	</div>
	
	<!--- submit article button --->
	<input class="btn btn-primary" type="submit" name="submit" value="Create news item" />
</form>	