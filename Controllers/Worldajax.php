<?php
namespace App\Controllers;

use App\Models\WorldModel;

class Worldajax extends BaseController {
	public function get($slug = null) {
		$model = model(WorldModel::class);
		$data = $model->getWorld($slug);
		
		print(json_encode($data));
	}
}
