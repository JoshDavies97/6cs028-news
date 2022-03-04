<?php
namespace App\Controllers;

use App\Models\UkModel;

class Ukajax extends BaseController {
	public function get($slug = null) {
		$model = model(UkModel::class);
		$data = $model->getUk($slug);
		
		print(json_encode($data));
	}
}
