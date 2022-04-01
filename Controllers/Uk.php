<?php
namespace App\Controllers;
	
use App\Models\UkModel;

// this is our controller
class Uk extends BaseController {
	
	// deletes an item
	public function delete($slug) {
		print("Delete news items: ".$slug);
		
		// grab the model
		$model = model(UkModel::class);
		
		// delete item via model
		$model->deleteNews($slug);
		
		// redirect to home screen if an article is deleted
		return redirect()->to('uk/index/2');
	}
		
	// lists all news items
	public function index($message = '') {
		
		// instantiate the model
		$model = model(UkModel::class);
		
		// the data is stored in an object
		$data = [
			'uk' => $model->getUk(), // get the news items
			'title' => 'UK News', // page title
			'message' => $message,
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
	
	// this function is for the creation of news articles
	public function create() {
		
		// grab the model for database access
		$model = model(UkModel::class);
		
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
					'image' => $this->request->getPost('image'),
				]);
				
				// redirect to home screen if a new article is created
				return redirect()->to('uk/index/1');
				
		// this is called before the form is submitted		
		} else {
			echo view('templates/ukNewsHeader', ['title' => 'Create a news item']);
			echo view('uk/create');
			echo view('templates/footer');
		}
	}
}
?>