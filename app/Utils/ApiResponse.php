<?php

namespace App\Utils;

use Illuminate\Http\JsonResponse;

/**
 * Class ApiResponse.
 */
class ApiResponse extends JsonResponse
{
    /**
     * ApiResponse constructor.
     * @param array   $data       Param.
     * @param integer $apiStatus  Param.
     * @param integer $httpStatus Param.
     * @param array   $headers    Param.
     * @param integer $options    Param.
     */
    public function __construct(array $data = [], $apiStatus = 200, int $httpStatus = 200, array $headers = [], int $options = 0)
    {
        if( isset( $data['status'] ) && $data['status'] == 'fail' )
        {
            if( $apiStatus == 200 )
            {
                $apiStatus = 400;
            }

            if( $httpStatus == 200 )
            {
                $httpStatus = 400;
            }
        }

        $response = [
            'status' => isset($data['status']) ? $data['status'] : 'fail',
            'code' => $apiStatus,
            'message' => isset($data['message']) ? $data['message'] : '',
            'object' => isset($data['object']) ? $data['object'] : null,
        ];

        parent::__construct($response, $httpStatus, $headers, $options);
    }
}
