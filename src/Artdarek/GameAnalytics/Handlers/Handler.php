<?php namespace Artdarek\GameAnalytics\Handlers;

use Artdarek\GameAnalytics\Handlers\Handler as Handler;

abstract class Handler {

	protected $url = '';

	protected $data = [];
	
	protected $secret = '';

	protected $response = null;

	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct() {}

	/**
	 * Send request 
	 * 
	 * @return void
	 */
	abstract public function flush();

	/**
	 * Set url
	 *
	 * @param string $url
 	 * @return void
	 */
	public function setUrl( $url ) {
		$this->url = $url;
	}
	
	/**
	 * Set authorization
	 *
	 * @param string $authorization
 	 * @return void
	 */
	public function setSecret( $secret ) {
		$this->secret = $secret;
	}

	/**
	 * Set message
	 *
	 * @param $message
	 * @return $result
	 */
	public function setData( $data ) {
		$this->data = $data;
	}

	/**
	 * Get message
	 * 
	 * @return string $message
	 */
	public function getMessage() {
		return $message = json_encode( $this->data ); 
	}

	/**
	 * Get Authorization
	 *
	 * @return string $authorization
	 */
	public function getAuthorization() {
		return $authorization = md5($this->getMessage()."".$this->secret);
	}

	/**
	 * Get response
	 * 
	 * @return $response
	 */
	public function getResponse( ) {

		// response
		$response = json_decode($this->response);

		return $response;
	}

}