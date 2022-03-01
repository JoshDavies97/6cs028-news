<?php
namespace App\Controllers;
	
use App\Models\UkNewsModel;

// this is our controller
class UkNews extends BaseController {
		
	// lists all news items
	public function index() {
		
		// instantiate the model
		$model = model(UkNewsModel::class);
		
		// the data is stored in an object
		$data = [
			'ukNews' => $model->getUKNews(), // get the news items
			'title' => 'UK News', // page title
		];
		
		// loads the views and passes the data objects
		echo view('templates/ukNewsHeader', $data);
		echo view('ukNews/ukNewsOverview', $data);
		echo view('templates/footer', $data);
	}
		
	// lists one news item based on its slug
	public function view($slug = null) {
		
		// grab the model
		$model = model(UkNewsModel::class);
		
		// load single news item from model pass in the slug 
		$data['ukNews'] = $model->getUkNews($slug);
		
		// deal with case where the slug doesn't exist
		if(empty($data['ukNews'])){
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: ' . $slug);
		}
		
		// specify the title
		$data['title'] = $data['ukNews']['title'];
		
		// loads the views and passes the data objects
		echo view('templates/ukNewsHeader', $data);
		echo view('ukNews/ukNewsView', $data);
		echo view('templates/footer', $data);
	}
}
?>