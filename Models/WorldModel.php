<?php
namespace App\Models;
	
use CodeIgniter\Model;
	
class WorldModel extends Model {
	
	// 'World' = name of database table
	protected $table = 'World';
	
	// the fields inside the table the model is allowed to update
	protected $allowedFields = ['title', 'slug', 'body'];
	
	public function getWorld($slug = false) {
		if($slug === false) {
			return $this->findAll();
		}
		
		// if slug is provided, select it
		return $this->where(['slug' => $slug])->first();
	}
}
?>