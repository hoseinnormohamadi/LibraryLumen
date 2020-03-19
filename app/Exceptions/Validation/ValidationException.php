<?php
namespace App\Exceptions\Validation;

use App\Enums\ApiHttpStatus;
use Illuminate\Contracts\Support\MessageBag;

/**
 * Class ValidationException
 */
class ValidationException extends \Exception
{
	/** @var array $messages */
	private $messages;

	/**
	 * ValidationException constructor.
	 *
	 * @param MessageBag $messageBag Param.
	 */
	public function __construct(MessageBag $messageBag)
	{
		parent::__construct('Validation params error', ApiHttpStatus::VALIDATION);

		$this->messages = $messageBag->toArray();
	}

	/**
	 * @return array
	 */
	public function getMessages()
	{
		return $this->messages;
	}

	/**
	 * @return integer
	 */
	public function getStatusCode()
	{
		return ApiHttpStatus::VALIDATION;
	}
}
