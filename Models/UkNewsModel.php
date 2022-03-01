<?php
namespace App\Models;
	
use CodeIgniter\Model;
	
class UkNewsModel extends Model {
	
	// 'ukNews' = name of database table
	protected $table = 'ukNews';
	
	public function getUkNews($slug = false) {
		if($slug === false) {
			return $this->findAll();
		}
		
		return $this->where(['slug' => $slug])->first();
	}
}
?>