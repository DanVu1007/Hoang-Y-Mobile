<?php
// require_once SCRIPT_PATH.'resize.php';
class Upload{
	public function uploadFile($fileObj,$folderUpload,$options=null){
		if($options == null){
			if($fileObj['tmp_name'] != null){
				$uploadDir 		= UPLOAD_PATH.$folderUpload.DS;
				$fileName 	= $this->randomString(8).'.'.pathinfo($fileObj['name'],PATHINFO_EXTENSION); 

				copy($fileObj['tmp_name'],$uploadDir .$fileName);
			}
		}
		return $fileName ;
	}

	public function removeFile($folderUpload,$fileName){
		$fileName = UPLOAD_PATH.$folderUpload.DS.$fileName;
		unlink($fileName);
	}

	private function randomString($length = 5){
		$arrCharacter = array_merge(range('A','Z'), range('a','z'),range(0,9));
		$arrCharacter = implode('',$arrCharacter);
		$arrCharacter = str_shuffle($arrCharacter);

		$result		= substr($arrCharacter,0,$length);
		return $result;
	}
}