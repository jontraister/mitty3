<?php

class Job {
	
	/**
	 * Override this method.
	 * 
	 * @return true on success
	 */
	
	public static function main() {
		$args=$GLOBALS['argv'];
		$script_name=array_shift($args);
		$jobs=array();
		foreach ($args as $arg)
			if ('-'!=substr($arg,0,1))
				$jobs[]=$arg;

		self::runAll($jobs);
	}
	
	public static function runAll($jobs) {
		foreach ($jobs as $job) {
			if (!is_subclass_of($job, __CLASS__))
				throw new Exception("Refusing to run job, '$job' does not extend ".__CLASS__);
			$result=$job::main();
			if (!$result)
				throw new Exception ("Job $job failed - aborting");
		}
	}
	
	
	/**
	* Require value to be present getenv() for CLI scripts. 
	* @param string $name
	*/
	
	public static function requireEnv($name) {
		$val=getenv($name);
		if (FALSE===$val)
			throw new Exception ("Missing required ENV parameter $name");
		return $val;
	}
	
	/**
	 * Require value to be present in $_SERVER
	 * @param string $name
	 */
	public static function requireServer($name) {
		return self::_require('_SERVER',$name);
	}
	
	public static function requireOpt( $name,$terse=null) {
		if (null===$terse) 
			$terse=strlen($name)==1;
		
		if ($terse) 
			$match="-$name";
		else 
			$match="--$name=";
			
		foreach ($GLOBALS['argv'] as $key=>$val) {
			if (0===strpos($val,$match)) 
					return substr($val,strlen($match));	
		}
		
		throw new Exception ("Missing required option $match! ");
	}
	
	/**
	 * Require options to be present on the command line 
	 * 
	 * @param string $options
	 * @param string $longopts
	 * @see getopt
	 */
	public static function requireOptions( $options, $longopts=array()) {
		$val=getopt($options,$longopts);
		if (false===$val)
			throw new Exception ("Missing required options: $options ".join(' ',$longopts));
		return $val;
	} 

	public static function requireConst($name) {
		$val=constant($name);
		if (NULL===$val)
		throw new Exception ("Missing required CONSTANT $name");
		return $val;
	}
	
	public static function requireGlobal($name) {
		return self::_require('GLOBALS',$name);
	}
	
	private static function _require($scope,$name) {
		$val=isset($$scope[$name])?$$scope[$name]:false;
		if (FALSE===$val)
			throw new Exception ("Missing $scope parameter $name");
		return $val;
	}
	
	/**
	* Require a parameter in options, $_SERVER or environment.
	*
	* @param string $name
	*
	* @throws Exception if parameter is not present or ===FALSE
	*/
	public static function req($name) {
		$val=false;
	
		if ('cli'==php_sapi_name()) {
			$v=getopt("",array($name));
			if (isset($v[$name]))
				return $v[$name];
		}
		
		if (isset($_SERVER[$name]))
		$val= $_SERVER[$name];
		else $val=getenv($name);
	
		if (FALSE===$val)
			throw new Exception ("Missing parameter $name");
		
		return $val;
	}
	
	
}

