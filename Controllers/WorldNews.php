<?php
namespace App\Controllers;
	
use App\Models\WorldNewsModel;

// this is our controller
class WorldNews extends BaseController {
		
	// lists all news items
	public function index() {
		
		// instantiate the model
		$model = model(WorldNewsModel::class);
		
		// the data is stored in an object
		$data = [
			'worldNews' => $model->getWorldNews(), // get the news items
			'title' => 'World News', // page title
		];
		
		// loads the views and passes the data objects
		echo view('templates/worldNewsHeader', $data);
		echo view('worldNews/worldNewsOverview', $data);
		echo view('templates/footer', $data);
	}
		 
	// lists one news item based on its slug
	public function view($slug = null) {
		
		// grab the model
		$model = model(WorldNewsModel::class);
		
		// load single news item from model pass in the slug 
		$data['worldNews'] = $model->getWorldNews($slug);
		
		// deal with case where the slug doesn't exist
		if(empty($data['worldNews'])){
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: ' . $slug);
		}
		
		// specify the title
		$data['title'] = $data['worldNews']['title'];
		
		// loads the views and passes the data objects
		echo view('templates/worldNewsHeader', $data);
		echo view('worldNews/worldNewsView', $data);
		echo view('templates/footer', $data);
	}
}
?>