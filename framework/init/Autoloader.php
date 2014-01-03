<?php
/*
 * This class parses the application folder, and includes classes as they are referenced.
 * Using this method of loading classes avoids having to include ALL the files needed to run the app.
 * This way, we just load the files need to run ONLY the current section.
 */ 
class Autoloader
{
	static private $pathName = "";
	static private $className = "";
	static private $ignore = array('.', '..', 'cgi-bin', '.svn', 'templates', 'compile');

	static public function init($path)
	{
		self::$pathName = $path;
	}

	static public function autoload($className)
	{
		self::loadClass(self::$pathName, $className);
	}

	/*
	 * Recursive method for including a class.
	 * If the class is found in the current folder, it is included, otherwise subfolders are parsed.
	 * 
	 * @param path - the current folder to search
	 * @param className - the name of the class to be included
	 */
	static public function loadClass($path, $className)
	{
		if(file_exists($path . "/" . $className . ".php"))
		{
			require_once($path . "/" . $className . ".php");
			return;
		}

		self::parseFolder($path, $className);
	}

	/*
	 * Open a folder handle and atempt to load the class
	 *
	 * param @path - the folder path
	 * param @className - the class name
	 */
	static private function parseFolder($path, $className)
	{
		$dirHandler = opendir($path);

		while(false !== ($folderItem = readdir($dirHandler)))
			if(is_dir($path . "/" . $folderItem) && !in_array($folderItem, self::$ignore))
				self::loadClass($path . "/" . $folderItem, $className);
	}
}