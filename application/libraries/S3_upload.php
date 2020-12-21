<?php

/**
 * Amazon S3 Upload PHP class
 *
 * @version 0.1
 */
class S3_upload {

	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('s3');

		$this->CI->config->load('s3', TRUE);
		$s3_config = $this->CI->config->item('s3');
		$this->bucket_name = $s3_config['bucket_name'];
		$this->folder_name = $s3_config['folder_name'];
		$this->s3_url = $s3_config['s3_url'];
	}

	function upload_file($file_path,$file_name,$extension)
	{
		// generate unique filename
		$file = pathinfo($file_path);
		$s3_file = $file_name.'-'.rand(1000,1).'.'.$extension;
		$mime_type = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file_path);

		$saved = $this->CI->s3->putObjectFile(
			$file_path,
			$this->bucket_name,
			$this->folder_name.$s3_file,
			S3::ACL_PUBLIC_READ,
			array(),
			$mime_type
		);
		if ($saved) {
			return $this->s3_url.'/'.$this->folder_name.$s3_file;
		}

		return false;
	}

	function deleteObject($uri){
		//$result = S3::getBucket("pagahoy.com");
		//S3::setAuth('AKIATO7EDAI7LIL6N37C', 'sYVbUeD1sWUMLmmR0cbAr0B2YRRcmI6TY40aXUsG');
		//$result = S3::deleteObject('pagahoy.com', 'recursos/promo-image-5d9a0a80e0289-666.jpg');
		$result = $this->CI->s3->deleteObject('pagahoy.com', $uri);
		return $result;
	}

	function getObject($uri){
		$result = $this->CI->s3->getObject('pagahoy.com', $uri);
		return $result;
	}


}