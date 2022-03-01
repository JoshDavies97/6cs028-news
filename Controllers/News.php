<?php
namespace App\Controllers;
	
use App\Models\NewsModel;

// this is our controller
class News extends BaseController {
		
	// lists all news items
	public function index() {
		
		// instantiate the model
		$model = model(NewsModel::class);
		
		// the data is stored in an object
		$data =[
			'news' => $model->getNews(), // get the news items
			'title' => 'News Archive' // page title
		];
		
		// loads the views and passes the data objects
		echo view('templates/header', $data);
		echo view('news/overview', $data);
		echo view('templates/footer', $data);
		
	}
		
	// lists one news item based on its slug
	public function view($slug = null) {
		
		// grab the model
		$model = model(NewsModel::class);
		
		// load single news item from model pass in the slug 
		$data['news'] = $model->getNews($slug);
		
		// deal with case where the slug doesn't exist
		if(empty($data['news'])){
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: ' . $slug);
		}
		
		// specify the title
		$data['title'] = $data['news']['title'];
		
		// loads the views and passes the data objects
		echo view('templates/header', $data);
		echo view('news/view', $data);
		echo view('templates/footer', $data);
	}
	
	// this function is for the creation of news articles
	public function create() {
		
		// grab the model for database access
		$model = model(NewsModel::class);
		
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
				return redirect()->to('news');
				
		// this is called before the form is submitted		
		} else {
			echo view('templates/header', ['title' => 'Create a news item']);
			echo view('news/create');
			echo view('templates/footer');
		}
	}
}
?>