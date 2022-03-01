<?php
namespace App\Models;
	
use CodeIgniter\Model;
	
class WorldNewsModel extends Model {
	
	// 'worldNews' = name of database table
	protected $table = 'worldNews';
	
	public function getWorldNews($slug = false) {
		if($slug === false) {
			return $this->findAll();
		}
		
		return $this->where(['slug' => $slug])->first();
	}
}
?>