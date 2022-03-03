<?php
namespace App\Models;
	
use CodeIgniter\Model;
	
class UkModel extends Model {
	protected $table = 'Uk'; // 'Uk' = name of database table
	
	// the fields inside the table the model is allowed to update
	protected $allowedFields = ['title', 'slug', 'body'];
	
	public function getUk($slug = false) {
		if($slug === false) {
			return $this->findAll();
		}
		
		// if slug is provided, select it
		return $this->where(['slug' => $slug])->first();
	}
}
?>