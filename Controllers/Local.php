<?php
namespace App\Controllers;
	
use App\Models\LocalModel;

// this is our controller
class Local extends BaseController {
	
	// deletes an item
	public function delete($slug) {
		print("Delete news items: ".$slug);
		
		// grab the model
		$model = model(LocalModel::class);
		
		// delete item via model
		$model->deleteNews($slug);
		
		// redirect to home screen if an article is deleted
		return redirect()->to('local');
	}
		
	// lists all news items
	public function index() {
		
		// instantiate the model
		$model = model(LocalModel::class);
		
		// the data is stored in an object
		$data = [
			'local' => $model->getLocal(), // get the news items
			'title' => 'Local News', // page title
		];
		
		// loads the views and passes the data objects
		echo view('templates/localNewsHeader', $data);
		echo view('local/overview', $data);
		echo view('templates/footer', $data);
	}
		
	// lists one news item based on its slug
	public function view($slug = null) {
		
		// grab the model
		$model = model(LocalModel::class);
		
		// load single news item from model pass in the slug 
		$data['local'] = $model->getLocal($slug);
		
		// deal with case where the slug doesn't exist
		if(empty($data['local'])){
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: ' . $slug);
		}
		
		// specify the title
		$data['title'] = $data['local']['title'];
		
		// loads the views and passes the data objects
		echo view('templates/localNewsHeader', $data);
		echo view('local/view', $data);
		echo view('templates/footer', $data);
	}
	
	// this function is for the creation of news articles
	public function create() {
		
		// grab the model for database access
		$model = model(LocalModel::class);
		
		// if the form has been submitted
		if($this->request->getMethod() === 'post' && $this->validate([
			'title' => 'required|min_length[3]|max_length[255]',
			'body' => 'required',
			'image' => 'required',
		])) {
				// data from form is only saved to the database if the validation rules have been met
				$model->save([
					'title' => $this->request->getPost('title'),
					'slug' => url_title($this->request->getPost('title'), '-', true),
					'body' => $this->request->getPost('body'),
					'image' => $this->request->getPost('image'),
				]);
				
				// redirect to home screen if a new article is created
				return redirect()->to('local');
				
		// this is called before the form is submitted		
		} else {
			echo view('templates/localNewsHeader', ['title' => 'Create a news item']);
			echo view('local/create');
			echo view('templates/footer');
		}
	}
}
?>