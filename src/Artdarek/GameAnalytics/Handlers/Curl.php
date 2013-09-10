<?php namespace Artdarek\GameAnalytics\Handlers;

use Artdarek\GameAnalytics\Handlers\Handler as Handler;

class Curl extends Handler {

	protected $url = '';

	protected $data = [];
	
	protected $secret = '';

	protected $response = null;

	/**
	 * Send request
	 * 
	 * @return void
	 */
	public function flush() {

		$ch = curl_init(); 

		curl_setopt($ch, CURLOPT_URL, $this->url ); 
		curl_setopt($ch, CURLOPT_POST, true); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->getMessage() ); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: ".$this->getAuthorization() )); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 10); 

		$result = curl_exec($ch); 
		$curl_info = curl_getinfo($ch); 

		curl_close($ch); 

		// save result
		$this->response = $result;
	}

}