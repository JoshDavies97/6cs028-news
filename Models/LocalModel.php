<?php
namespace App\Models;
	
use CodeIgniter\Model;
	
class LocalModel extends Model {
	protected $table = 'Local'; // 'Local' = name of database table
	
	// the fields inside the table the model is allowed to update
	protected $allowedFields = ['title', 'slug', 'body', 'image'];
	
	public function getLocal($slug = false) {
		if($slug === false) {
			return $this->findAll();
		}
		
		// if slug is provided, select it
		return $this->where(['slug' => $slug])->first();
	}
	
	public function deleteNews($slug) {
		$db = \Config\Database::connect();
		$builder = $db->table('Local');
		$builder->delete(['slug' => $slug]);
	}
}
?>

