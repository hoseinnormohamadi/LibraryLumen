<?php
namespace App\Jobs;

use Exception;

/**
 * Class SentryLogJob
 */
class SentryLogJob extends Job
{
	/**
	 * The name of the queue the job should be sent to.
	 *
	 * @var null|string
	 */
	public $queue = 'service_sentry_log';

	/**
	 * exception.
	 *
	 * @var array
	 */
	protected $exception;

	/**
	 * Create a new job instance.
	 *
	 * @param \Exception $exception Param.
	 */
	public function __construct(Exception $exception)
	{
		$this->exception = $exception;
	}

	/**
	 * Execute the job.
	 * @return void.
	 */
	public function handle()
	{
		if ( !empty($this->exception) )
		{
			app('sentry')->captureException($this->exception);
		}
	}
}