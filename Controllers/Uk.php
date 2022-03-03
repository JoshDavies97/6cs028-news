<?php
namespace App\Controllers;
	
use App\Models\UkModel;

// this is our controller
class Uk extends BaseController {
		
	// lists all news items
	public function index() {
		
		// instantiate the model
		$model = model(UkModel::class);
		
		// the data is stored in an object
		$data = [
			'uk' => $model->getUk(), // get the news items
			'title' => 'UK News', // page title
		];
		
		// loads the views and passes the data objects
		echo view('templates/ukNewsHeader', $data);
		echo view('uk/overview', $data);
		echo view('templates/footer', $data);
	}
		
	// lists one news item based on its slug
	public function view($slug = null) {
		
		// grab the model
		$model = model(UkModel::class);
		
		// load single news item from model pass in the slug 
		$data['uk'] = $model->getUk($slug);
		
		// deal with case where the slug doesn't exist
		if(empty($data['uk'])){
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: ' . $slug);
		}
		
		// specify the title
		$data['title'] = $data['uk']['title'];
		
		// loads the views and passes the data objects
		echo view('templates/ukNewsHeader', $data);
		echo view('uk/view', $data);
		echo view('templates/footer', $data);
	}
}
?>