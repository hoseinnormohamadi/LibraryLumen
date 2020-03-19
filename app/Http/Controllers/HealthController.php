<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\JsonResponse;

/**
 * Class HealthController
 */
class HealthController extends BaseController
{
	/**
	 * @return mixed
	 */
	public function healthStatus()
	{
        return response()->json(['result' => 'ok'], 222);
	}
}
