<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseController;
use http\Env\Request;
use Illuminate\Support\Facades\Lang;

/**
 * Class HomeController
 */
class HomeController extends BaseController
{
	/**
	 * @return mixed
	 */
	public function index()
	{
		return response()->AloResponse(null, 'success', Lang::get('messages.work_fine'));
	}
}