<?php
namespace App\Http\Requests;

use App\Exceptions\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;

/**
 * Class FormRequest
 */
abstract class FormRequest extends Request
{
    /**
     * @throws ValidationException Instance of \Exception.
     * @throws UnauthorizedException Instance of \Exception.
     * @return void.
     */
	public function validate()
	{
		if (false === $this->authorize()) {
			throw new UnauthorizedException();
		}

		$validator = app('validator')->make($this->all(), $this->rules(), $this->messages());

		if ($validator->fails()) {
			throw new ValidationException($validator->errors());
		}
	}

	/**
	 * @return boolean
	 */
	protected function authorize()
	{
		return true;
	}

	/**
	 * @return mixed
	 */
	abstract protected function rules();

	/**
	 * @return array
	 */
	protected function messages()
	{
		return [];
	}
}
