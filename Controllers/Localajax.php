<?php
namespace App\Controllers;

use App\Models\LocalModel;

class Localajax extends BaseController {
	public function get($slug = null) {
		$model = model(LocalModel::class);
		$data = $model->getLocal($slug);
		
		print(json_encode($data));
	}
}
