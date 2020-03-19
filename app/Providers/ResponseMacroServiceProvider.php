<?php
namespace App\Providers;

use App\Utils\ApiResponse;
use Illuminate\Support\ServiceProvider;

/**
 * Class ResponseMacroServiceProvider.
 */
class ResponseMacroServiceProvider extends ServiceProvider
{
	/**
	 * Register the application's response macros.
	 * @return void.
	 */
	public function boot()
	{
		response()->macro(
			'AloResponse',
			function ($object, $status, $message = '', $apiStatus = 200, $httpStatus = 200, $headers = [], $options = 0)
			{
				$data = [
					'status' => $status,
					'message' => $message,
					'object' => $object,
				];

				return new ApiResponse($data, $apiStatus, $httpStatus, $headers, $options);
			}
		);
	}
}