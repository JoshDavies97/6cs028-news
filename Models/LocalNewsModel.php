<?php
namespace App\Models;
	
use CodeIgniter\Model;
	
class LocalNewsModels extends Model {
	
	// 'localNews' = name of database table
	protected $table = 'localNews';
	
	// the fields inside the table the model is allowed to update
	protected $allowedFields = ['title', 'slug', 'body'];
	
	public function getLocalNews($slug = false) {
		if($slug === false) {
			return $this->findAll();
		}
		
		return $this->where(['slug' => $slug])->first();
	}
}
?>

