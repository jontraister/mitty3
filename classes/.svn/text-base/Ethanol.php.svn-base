<?php

/**
 * Collection of strategies to to fix security issues.
 * Usage samples:
 * <pre>
 * $fileName=Ethanol::file()->sanitize($_FILE['upload']['name']);
 * if (Ethanol::image()->isImage($_FILE['upload']['tmp_name'])) move_uploaded_file($_FILE['upload']['tmp_name'], Ethanol::image()->sanitize($_FILE['upload']['name']));
 * if (!Ethanol::email()->validate($_REQUEST['recipient_email']) throw Exception ('Recipient email invalid');
 * header('Location: ' . Ethanol::crlf()->sanitize($url));
 * </pre>
 *
 * @author: christian.kissner@fox.com
 * @version 1.3.1
 */

class Ethanol {
	/**
	 * @return EthanolFile
	 * @see EthanolFile
	 */
	static function file() {
		return new EthanolFile();
	}
	/**
	 * @return EthanolEmail
	 * @see EthanolEmail
	 */
	static function email() {
		return new EthanolEmail();
	}
	/**
	 * @return EthanolImage
	 * @see EthanolImage
	 */
	static function image() {
		return new EthanolImage();
	}

	/**
	 * @return EthanolCrlf
	 * @see EthanolCrlf
	 */
	static function crlf() {
		return new EthanolCrlf();
	}

	/**
	* @return EthanolToken
	* @see EthanolToken
	*/
	static function token() {
		return new EthanolToken();
	}
	
}

/**
 * Strategy for fixing File upload issues.
 *
 * @link https://www.owasp.org/index.php/Unrestricted_File_Upload
 */

class EthanolFile  {

	/**
	 * Takes a file name and returns a cleaned up name safe to use for writing into a directory, for logging or for output.
	 * Any path information, leading dots, double dots, slashes, backslashes, special characters,  parens, tags, spaces or unicode lookalikes are discarded. Valid file extensions are preserved, (php) script extensions are discarded.
	 *
	 * @param $string string file name (paths will be stripped)
	 * @return string safe file name
	 */

	public function sanitize($string) {
		$string=substr($string,0,250);
		$name=basename($string);
		$name=preg_replace('/[^a-zA-Z0-9_.-]/','',$name);
		$name=preg_replace('/[.]+/','.',$name);
		$name=preg_replace('/^[.]/','',$name);
		$name=preg_replace('/([.]s?php[3-9]?|[.][ps]html)*$/i','',$name);
		if (""==$name) return uniqid("file_",1);
		return $name;
	}


	/**
	 * Verifies whether a file name is safe to use  writing into a directory, for logging or for output.
	 *
	 * @param $string string file name (paths will be stripped)
	 * @return boolean false if not safe
	 *
	 * @see #sanitize($file);
	 */

	public function validate($string) {
		$sanitized=$this->sanitize($string);
		return ($sanitized===$string) 
			&& (strlen($string)==strlen($sanitized)); // fixed issue with \x00 terminated strings 
	}

	/**
	 * Get file extension.
	 *
	 * @param $name string file name
	 * @return string extension (without leading dots)
	 */

	function getExt($name) {
		$list=explode('.',$name);
		return array_pop($list);
	}


	/**
	 * Checks if filename has a script extension.
	 * Condidering only PHP for now.
	 *
	 * @param $name string file name
	 * @return boolean true on match
	 */

	function isScript($name) {
		return
		preg_match('/[.]s?php[3-9]?$/i',$name) ||
		preg_match('/[.][ps]html$/i',$name);
	}


	/**
	 * Get MIME type from file.
	 *
	 * @param $filename string file name
	 * @return string MIME type
	 */

	function getFileType($filename) {
		if (!file_exists($filename)) return false;
		$finfo = finfo_open(FILEINFO_MIME_TYPE); $type=finfo_file($finfo, $filename); finfo_close($finfo);
		return $type;
	}


	/**
	 * Get MIME type from buffer.
	 *
	 * @param $data string buffer
	 * @return string MIME type
	 */

	function getDataType($data) {
		$finfo = finfo_open(FILEINFO_MIME_TYPE); $type=finfo_buffer($finfo, $data); finfo_close($finfo);
		return $type;
	}

}


/**
 * Strategy for fixing CRLF issues in strings.
 *
 * @link http://www.owasp.org/index.php/CRLF_Injection
 */

class EthanolCrlf {

	/**
	 * Takes a string and returns a cleaned up string safe for use in http and email headers.
	 * Removes any control characters including line feeds and carriage returns. Valid characters are: .,:;?!#@$&()*+="'[]-/ a-zA-Z0-9
	 *
	 * @param $string string input string (e.g. email, url, cookie, header)
	 * @return string safe string
	 */

	public function sanitize($string) {
		$string=substr($string,0,250);
		$special='.,:;?!#@$&()*+="[';
		$escape="]-/";
		$alnum=" 'a-zA-Z0-9_";
		$classes= $alnum . preg_quote($escape,'/'). $special;

		return preg_replace("/[^$classes]/",'',$string);
	}

	/**
	 * Verifies whether a file name is safe to use in for use in http and email headers, e.g. for cookies, email addresses, redirect urls,
	 *
	 * @param $string string
	 * @return boolean false if not safe
	 *
	 * @see #sanitize;
	 */

	public function validate($string) {
		$sanitized=$this->sanitize($string);
		return ($sanitized===$string) 
			&& (strlen($string)==strlen($sanitized)); // fixed issue with \x00 terminated strings 
	}
}



/**
 * Strategy for validating email addresses.
 *
 */

class EthanolEmail {


	/**
	 * Sanitizes emails so they're safe for mailing, logging and output.
	 *
	 * @param $string string email
	 * @return string original email if valid, otherwise "email_invalid@foxfilm.com"
	 *
	 * @see #validate($file);
	 */

	function sanitize($string) {
		if (!$this->validate($string))
		return "email_invalid@foxfilm.com";
		else
		return $string;
	}

	/**
	 * Validates email syntax and safety for mailing, logging and output.
	 *
	 * @param $string string email
	 * @return boolean true on success
	 */

	function validate($string) {
		$string=substr($string,0,250);
		$hostname = '(?:[a-z0-9][-a-z0-9]*\.)*(?:[a-z0-9][-a-z0-9]{0,62})\.(?:(?:[a-z]{2}\.)?[a-z]{2,4})';
		$val_email_regex = '/^[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*@' . $hostname . '$/i';
		return preg_match($val_email_regex, $string)?true:false;
	}


}

/**
 * Strategy for fixing Image uploads
 *
 */

class EthanolImage  extends EthanolFile{

	/**
	 * Map of valid image extensions to mime types.
	 */


	public static $validTypes = array('bmp'=>'image/bmp','gif'=>'image/gif','jpeg'=>'image/jpeg','jpg'=>'image/jpeg','png'=>'image/png');


	/**
	 * Gets MIME image type from file name.
	 *
	 * @param $name string file name
	 * @return string mime type or NULL if not a valid image name.
	 *
	 * @see $validTypes
	 */

	function getImageTypeFromName($name) {
		return $this->getImageTypeFromExt($this->getExt($name));
	}

	/**
	 * Gets MIME image type from file extension.
	 *
	 * @param $name string file extension
	 * @return string mime type or NULL if not a valid image name.
	 *
	 * @see $validTypes
	 */

	function getImageTypeFromExt($string) {
		$string=strtolower($string);
		if (!array_key_exists($string,self::$validTypes)) return NULL;
		return self::$validTypes[$string];
	}

	/**
	 * Check if a file name has a valid image extension.
	 *
	 * @param $filename
	 * @return boolean true on success.
	 *
	 * @see $validTypes
	 */

	function isImageName($string)  {
		return ($this->getImageTypeFromName($string))?true:false;
	}


	/**
	 * Checks if data is a valid image.
	 *
	 * @param $bytes string buffer
	 *
	 * @deprecated use the less memory intensive isImageData();
	 * @see isImageData()
	 */

	function validateImageData($bytes) {
		$image=imagecreatefromstring($bytes);
		if (false===$image) return false;

		imagedestroy($image);
		return true;
	}

	/**
	 * Checks if data is a valid image type.
	 *
	 * @param $bytes string buffer
	 * @return boolean true on success
	 *
	 * @see getDataType()
	 * @see $validTypes
	 */

	function isImageData($bytes) {
		return $this->isImageType($this->getDataType($bytes));
	}


	/**
	 * Checks if file is a valid image type.
	 *
	 * @param $file string path/to/file.img
	 * @return boolean true on success
	 *
	 * @see getFileType()
	 * @see $validTypes
	 */

	function isImage($file) {
		return $this->isImageType($this->getFileType($file));
	}


	/**
	 * Checks mime type is a valid image type.
	 *
	 * @param $type string mime type
	 * @return boolean true on success.
	 *
	 * @see $validTypes
	 */

	function isImageType($type)  {
		return ($this->getImageExtension($type))?true:false;
	}


	/**
	 * Returns proper image extension given a valid image type.
	 *
	 * @param $type string mime type
	 * @return string extension (e.g. 'jpg') , or NULL for unrecognized types.
	 *
	 * @see $validTypes
	 */
	function getImageExtension($type) {
		$ext=array_flip(self::$validTypes);
		if (!array_key_exists($type,$ext)) return NULL;
		return $ext[$type];
	}

	/**
	 * Sanitizes image file name and extension.
	 * If the name does not have an image extension, '.jpg' will be appended. Most browsers and tools will display the image regardless of the real type.
	 *
	 *
	 * @param $string string image name (paths will be stripped)
	 * @return string safe image name
	 * @see EthanolFile::sanitize()
	 *
	 **/

	public function sanitize($string) {
		$name=parent::sanitize($string);
		if (!$this->getImageTypeFromName($name)) $name=$name.'.jpg';
		return $name;
	}


	/**
	 * Verifies file name is and image and safe to use for writing into a directory, for logging or for output.
	 *
	 * @param $string string file name (paths will be stripped)
	 * @return boolean false if not safe
	 *
	 * @see #sanitize($file);
	 */

	public function validate($string) {
		return ($this->getImageTypeFromName() && $this->sanitize($string)===$string);
	}


}


/**
 * Strategy for fixing tokens, identifiers and also class and method names. 
 *
 */

class EthanolToken {

   /**
	* Returns a cleaned up string safe for use as ids, class names etc.
	* Removes anything that's not alphanumeric or an underscore and trims to 250 char.  
	*
	* @param $string string input string (e.g. email, url, cookie, header)
	* @return string safe string
	*/
	
	public function sanitize($string) {
		$string=substr($string,0,250);
		return preg_replace("/[^a-zA-Z0-9_]/",'',$string);
	}
	
	/**
	 * Verifies a string is safe for use as ids, class names etc. 
	 *
	 * @param $string string
	 * @return boolean false if not safe
	 *
	 * @see #sanitize;
	 */

	public function validate($string) {
		$sanitized=$this->sanitize($string);
		return ($sanitized===$string) 
			&& (strlen($string)==strlen($sanitized)); // fixed issue with \x00 terminated strings 
	}

}

