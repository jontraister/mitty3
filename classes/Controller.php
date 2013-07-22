<?php

/**
 * Base class for controllers.
 */
class Controller{

    /**
     * Controller configuration
     * @var array
     */
	protected $config;

    /**
     * Request data
     * @var array
     */
    protected $request;
    /**
     * Base constructor
     *
     * @param Config $config controller configuration
     */
	public function __construct($config, $request=array()) {
		$this->config=$config;
        $this->request=$request;
	}

}