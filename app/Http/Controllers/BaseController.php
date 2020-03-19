<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enums\ApiErrorCodes;
use App\Enums\ApiHttpStatus;
use Validator;

/**
 * Class BaseController
 */
class BaseController extends Controller
{
    /**
     * Response handler
     *
     * @param mixed  $result         This is result.
     * @param string $successMessage This is success message.
     * @param string $failMessage    This is fail message.
     * @return mixed
     */
    public function responseHandler( $result, string $successMessage, string $failMessage = null )
    {
        if( isset( $result ) )
        {
            if( isset( $result['error'] ) )
            {
                return response()->AloResponse( null, 'fail', isset( $result['error_msg'] ) ? $result['error_msg'] : $failMessage );
            }
            else
            {
                return response()->AloResponse( $result, 'success', $successMessage );
            }
        }

        return response()->AloResponse( $result, 'fail', $failMessage ? $failMessage : trans('messages.fail') );
    }

    /**
     * validation handler
     *
     * @param Request $request This is request.
     * @param array   $rules   This is rules.
     * @return mixed
     */
    public function inputValidator( Request $request, array $rules )
    {
        $validator = Validator::make(
            $request->all(),
            $rules
        );

        if ( $validator->fails() )
        {
            return response()->AloResponse(
                $validator->errors(),
                'fail',
                trans('messages.common.inputs_validator.fail'),
                ApiErrorCodes::VALIDATION,
                ApiHttpStatus::VALIDATION
            );
        }

        return $request;
    }
}
