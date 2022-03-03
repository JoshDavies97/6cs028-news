<?php
namespace App\Controllers;
	
use App\Models\WorldModel;

// this is our controller
class World extends BaseController {
		
	// lists all news items
	public function index() {
		
		// instantiate the model
		$model = model(WorldModel::class);
		
		// the data is stored in an object
		$data = [
			'world' => $model->getWorld(), // get the news items
			'title' => 'World News', // page title
		];
		
		// loads the views and passes the data objects
		echo view('templates/worldNewsHeader', $data);
		echo view('world/overview', $data);
		echo view('templates/footer', $data);
	}
		 
	// lists one news item based on its slug
	public function view($slug = null) {
		
		// grab the model
		$model = model(WorldModel::class);
		
		// load single news item from model pass in the slug 
		$data['world'] = $model->getWorld($slug);
		
		// deal with case where the slug doesn't exist
		if(empty($data['world'])){
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: ' . $slug);
		}
		
		// specify the title
		$data['title'] = $data['world']['title'];
		
		// loads the views and passes the data objects
		echo view('templates/worldNewsHeader', $data);
		echo view('world/view', $data);
		echo view('templates/footer', $data);
	}
}
?>