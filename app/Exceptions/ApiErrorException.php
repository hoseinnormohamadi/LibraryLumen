<?php

namespace App\Exceptions;

use App\Enums\ApiErrorCodes;
use App\Jobs\SentryLogJob;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Class ApiErrorException
 */
class ApiErrorException extends Exception
{
	/**
	 * error code
	 *
	 * @var integer
	 */
	private $errorCode = ApiErrorCodes::FAIL;

	/**
	 * error message
	 *
	 * @var string
	 */
	private $errorMessage = null;

	/**
	 * exceptions
	 *
	 * @var mixed
	 */
	private $exceptionObject = null;

	/**
	 * extra params
	 *
	 * @var mixed
	 */
	private $extraParams = [];

	/**
	 * SendErrorToSentry
	 *
	 * @var boolean
	 */
	private $sendErrorToSentry = true;

	/**
	 * ApiErrorException constructor.
	 *
	 * @param array $options This is options.
	 */
	public function __construct( array $options = [] )
	{
		parent::__construct();

		$this->setErrorMessage( trans( 'messages.fail' ) );

		if( $options && is_array( $options ) )
		{
			if( isset( $options['message'] ) )
			{
				$this->setErrorMessage( $options['message'] );
			}

			if( isset( $options['code'] ) )
			{
				$this->setErrorCode( $options['code'] );
			}

			if( isset( $options['data'] ) )
			{
				$this->setExtraParams( $options['data'] );
			}

			if( isset( $options['exception'] ) )
			{
				$this->setExceptionObject( $options['exception'] );

				$exceptionErrorMessage = $this->getExceptionObjectErrorMessage();
				$exceptionErrorCode = $this->getExceptionObjectErrorCode();
				$exceptionExtraParams = $this->getExceptionObjectExtraParams();

				if( $exceptionErrorMessage && !empty( $exceptionErrorMessage ) )
				{
					$this->setErrorMessage( $exceptionErrorMessage );
				}

				if( $exceptionErrorCode )
				{
					$this->setErrorCode( $exceptionErrorCode );
				}

				if( $exceptionExtraParams && !empty( $exceptionExtraParams ) )
				{
					$this->setExtraParams( $exceptionExtraParams );
				}
			}//end if
		}//end if


		if( !env( 'APP_DEBUG', false ) )
		{
			$this->setErrorMessage( trans( 'messages.fail' ) );
		}

		$this->message = $this->getErrorMessage();
		$this->code = $this->getErrorCode();

		if( $this->shouldSendToSentry() )
		{
			dispatch( new SentryLogJob( $this ) );
		}

		Log::error(
			$this->getErrorMessage(),
			[
				'errorCode'    => $this->getErrorCode(),
				'errorMessage' => $this->getErrorMessage(),
				'exception'    => $this->getExceptionObject(),
				'extraParams'  => $this->getExtraParams(),
			]
		);
	}

	/**
	 * @return mixed
	 */
	public function getErrorCode()
	{
		return $this->errorCode;
	}

	/**
	 * @param mixed $errorCode This is errorCode.
	 * @return void;
	 */
	public function setErrorCode($errorCode)
	{
		$this->errorCode = $errorCode;
	}

	/**
	 * @return mixed
	 */
	public function getErrorMessage()
	{
		return $this->errorMessage;
	}

	/**
	 * @param  mixed $errorMessage This is errorMessage.
	 * @return void;
	 */
	public function setErrorMessage($errorMessage)
	{
		$this->errorMessage = $errorMessage;
	}

	/**
	 * @return mixed
	 */
	public function getExtraParams()
	{
		return $this->extraParams;
	}

	/**
	 * @param  mixed $extraParams This is extraParams.
	 * @return void;
	 */
	public function setExtraParams($extraParams)
	{
		$this->extraParams = $extraParams;
	}

	/**
	 * @return mixed
	 */
	public function getExceptionObject()
	{
		return $this->exceptionObject;
	}

	/**
	 * @param mixed $exceptionObject This is exceptionObject.
	 * @return void;
	 */
	public function setExceptionObject($exceptionObject)
	{
		$this->exceptionObject = $exceptionObject;
	}

	/**
	 * @return mixed
	 */
	public function getExceptionObjectErrorMessage()
	{
		return $this->exceptionObject && method_exists( $this->exceptionObject, 'getMessage' ) ? $this->exceptionObject->getMessage() : null;
	}

	/**
	 * @return mixed
	 */
	public function getExceptionObjectErrorCode()
	{
		return $this->exceptionObject && method_exists( $this->exceptionObject, 'getErrorCode' ) ? $this->exceptionObject->getErrorCode() : null;
	}

	/**
	 * @return mixed
	 */
	public function getExceptionObjectExtraParams()
	{
		return $this->exceptionObject && method_exists( $this->exceptionObject, 'getExtraParams' ) ? $this->exceptionObject->getExtraParams() : null;
	}

	/**
	 * @return void
	 */
	public function enableSendErrorToSentry()
	{
		$this->sendErrorToSentry = true;
	}

	/**
	 * @return void
	 */
	public function disableSendErrorToSentry()
	{
		$this->sendErrorToSentry = false;
	}

	/**
	 * @return boolean
	 */
	public function shouldSendToSentry()
	{
		return $this->sendErrorToSentry;
	}
}