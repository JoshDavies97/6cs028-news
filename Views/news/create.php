<h2><?= esc($title) ?></h2>

<!--- function is used to report errors related to CSRF protection --->
<?= session()->getFlashdata('error') ?>

<!--- function is used to report errors related to form validation --->
<?= service('validation')->listErrors() ?>

<form action="<?=base_url()?>/news/create" method="post">
	
	<!--- function creates a hidden input with a CSRF token that helps protect against common attacks --->
	<?= csrf_field() ?>
	
	<!--- title of article --->
	<label for="title">Title</label>
	<input type="input" name="title" /><br />
	
	<!--- text of article --->
	<label for="body">Text</label>
	<textarea name="body" cols="45" rows="4"></textarea><br />
	
	<!--- submit article button --->
	<input type="submit" name="submit" value="Create news item" />
</form>	