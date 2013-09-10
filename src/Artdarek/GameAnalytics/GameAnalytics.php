<?php namespace Artdarek\GameAnalytics;

use Artdarek\GameAnalytics\Handler as Handler;

class GameAnalytics {

	/**
	 * GA REST API Base url
	 * 
	 * @var host
	 */
	const HOST = 'http://api.gameanalytics.com';

	/**
	 * GA API version
	 * 
	 * @var string
	 */
	private $version = 1;

	/**
	 * Game key
	 * 
	 * @var string
	 */
	private $key = '';

	/**
	 * Game secret
	 * 
	 * @var string
	 */
	private $secret = '';

	/**
	 * Category
	 * 
	 * @var string
	 */
	private $category = '';

	/**
	 * Handler
	 * 
	 * @var object
	 */
	private $handler;

	/**
	 * Data
	 * 
	 * @var array
	 */
	private $data = [];

	/**
	 * Constructor
	 *
	 * @param string $handler - Handler name
	 * @return void
	 */
	public function __construct( $handler ) { 

		$allowedHandlers = ['Curl'];

		if ( !in_array($handler, $allowedHandlers) ) {
			throw new \Exception('You have to use one of this handlers: Curl');
		} 

		// generate class name of handler including namespaces
		$handlerName = 'Artdarek\GameAnalytics\Handlers\\'.$handler;		

		// create handler instance
		$handler = new $handlerName;

		// save handler in object variable
		$this->handler = $handler;
	}

	/**
	 * Set API Key
	 * 
	 * @param key $key
	 * @return void
	 */
	public function setKey($key) {
		$this->key = $key;
	}

	/**
	 * Get API game key
	 * 
	 * @param key $key
	 * @return void
	 */
	public function getKey() {

		// check if key was set
		if ( $this->key == '' ) {
			throw new \Exception('API game key have to be set!');
		}

		return $this->key;
	}

	/**
	 * Set API Version
	 * 
	 * @param version $version
	 * @return void
	 */
	public function setVersion($version) {
		$this->version = $version;
	}

	/**
	 * Get API Version
	 * 
	 * @param key $key
	 * @return void
	 */
	public function getVersion() {

		// check if version was set
		if ( $this->version < 1 ) {
			throw new \Exception('API version have to be set!');
		}

		return $this->version;
	}

	/**
	 * Set API Secret
	 * 
	 * @param string $secret
	 * @return void
	 */
	public function setSecret($secret) {
		$this->secret = $secret;
	}

	/**
	 * Get API Secret
	 * 
	 * @param key $key
	 * @return void
	 */
	public function getSecret() {

		// check if key was set
		if ( $this->secret == '' ) {
			throw new \Exception('API secret have to be set!');
		}

		return $this->secret;
	}

	/**
	 * Get endpoint url 
	 * 
	 * @return string $url
	 */
	public function getUrl() {

		$url = self::HOST ."/". $this->getVersion() ."/". $this->getKey() ."/". $this->getCategory();
		return $url;
	}

	/**
	 * Build query
	 * 
	 * @param  string $category
	 * @param  array $data
	 * @return void
	 */
	public function query($category, $data = []) {
		$this->setCategory($category);
		$this->setData($data);
		return $this;
	}

	/**
	 * Build query for user category
	 * 
	 * @param  array $data
	 * @return $this
	 */
	public function queryUser($data = []) {
		return $this->query('user', $data);
	}

	/**
	 * Build query for Design category
	 * 
	 * @param  array $data
	 * @return $this
	 */
	public function queryDesign($data = []) {
		return $this->query('design', $data);
	}

	/**
	 * Build query for Business category
	 * 
	 * @param  array $data
	 * @return $this
	 */
	public function queryBusiness($data = []) {
		return $this->query('business', $data);
	}

	/**
	 * Build query for Quality category
	 * 
	 * @param  array $data
	 * @return $this
	 */
	public function queryQuality($data = []) {
		return $this->query('quality', $data);
	}


	/**
	 * Set category 
	 * 
	 * @param string $category
	 * @return GameAnalytics $this
	 */
	public function setCategory( $category ) {
		
		// allowed categories list
		$allowed = ['user','quality','design','business'];

		if ( !in_array($category, $allowed) ) {
			throw new \Exception('Selected category is not allowed! Allowed categories are: user, quality, design, business.');
		} 

		$this->category = $category;
		return $this;
	}

	/**
	 * Get category 
	 * 
	 * @param void
	 * @return string self::category;
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * Set data
	 * 
	 * @param array $data
	 * @return GameAnalytics $this
	 */
	public function setData( $data = [] ) {

		// check if required data was passed
		if ( ( !isset($data['user_id']) ) or ( !isset($data['session_id']) ) or	( !isset($data['build']) ) ) {
			throw new \Exception('user_id, session_id, build are required fields and have to be defined!');
		}

		$this->data = $data;
		return $this;
	}

	/**
	 * Get data
	 * 
	 * @return array $data
	 */
	public function getData() {		
		$data = $this->data;
		return $data;
	}	

	/**
	 * Send request to Game Aanalitics and get response
	 * 
	 * @return $response
	 */
	public function send() {

		$handler = $this->handler;
		$handler->setUrl( $this->getUrl() );
		$handler->setData( $this->getData() );
		$handler->setSecret( $this->getSecret() );
		$handler->flush();

		// get response
		$response = $handler->getResponse();

		return $response;
	}


}