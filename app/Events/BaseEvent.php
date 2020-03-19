<?php

namespace App\Events;

// use AloPeykAuth;

/**
 * Class BaseEvent
 *
 */
class BaseEvent extends Event
{
	/**
	 * The data sent to this event
	 * 
	 * @var array
	 */
	public $data;

	/**
	 * The user who fired this event
	 * 
	 * @var null | App\Models\User\User
	 */
	public $user;

	/**
	 * The Timestamp in which the event was fired
	 * 
	 * @var string
	 */
	public $timestamp;

	/**
	 * The current logged in user object
	 * 
	 * @var User
	 */
	public $loggedInUser;

	/**
	 * Create a new event instance.
	 *
	 * @param mixed $data This is inputs data.
	 */
	public function __construct( $data )
	{
		$this->data = $data;
		// $this->user = AloPeykAuth::user();
		// $this->loggedInUser = AloPeykAuth::user();
		$this->timestamp = date( 'Y-m-d H:i:s' );
	}
}