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
	
	// this function is for the creation of news articles
	public function create() {
		
		// grab the model for database access
		$model = model(WorldModel::class);
		
		// if the form has been submitted
		if($this->request->getMethod() === 'post' && $this->validate([
			'title' => 'required|min_length[3]|max_length[255]',
			'body' => 'required',
		])) {
				// data from form is only saved to the database if the validation rules have been met
				$model->save([
					'title' => $this->request->getPost('title'),
					'slug' => url_title($this->request->getPost('title'), '-', true),
					'body' => $this->request->getPost('body'),
				]);
				
				// redirect to home screen if a new article is created
				return redirect()->to('world');
				
		// this is called before the form is submitted		
		} else {
			echo view('templates/worldNewsHeader', ['title' => 'Create a news item']);
			echo view('world/create');
			echo view('templates/footer');
		}
	}
}
?>