<?php
namespace App\Models;
	
use CodeIgniter\Model;
	
class NewsModel extends Model {
	protected $table = 'News'; // 'News' = name of database table
	
	// the fields inside the table the model is allowed to update
	protected $allowedFields = ['title', 'slug', 'body'];

	// this function returns news items from the database
	public function getNews($slug = false) {
	
		// if no slug is provided, select all
		if($slug === false) {
			return $this->findAll();
		}
		
		// if slug is provided, select it
		return $this->where(['slug'=>$slug])->first();
	}
}
?>