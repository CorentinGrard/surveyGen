<?php

class File{

	 /**
	 * Normalizes the path to get to a specific file in the project so that it works on any server
	 * 
	 * @param Place   $path_array  contains the folders and/or files of the path
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 * 
	 * @return $ROOT_FOLDER/$path_array
	 */ 
	public static function build_path($path_array) {
	    $DS = DIRECTORY_SEPARATOR;
	    $ROOT_FOLDER = __DIR__. "/..";
	    return $ROOT_FOLDER. $DS . join($DS, $path_array);
	}
}

?>