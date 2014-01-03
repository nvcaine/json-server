<?php
/*
 * This class is responsible for initializing the framework files.
 */
class AppInit
{
	public function __construct($appFolder)
	{
		$this->loadFromFolder($appFolder);
	}

	/*
	 * Load all files from a given folder.
	 *
	 * param @appFolder - the path of the folder to load
	 */	 
	public function loadFromFolder($appFolder)
	{
		$ignore = array('cgi-bin',
						'.svn',
						'templates',
						'compile',
						'.',
						'..');

		$this->parseFolderItems($appFolder, $ignore);
	}

	protected function importClass($pathToFile)
	{
		return require_once($pathToFile);
	}

	protected function parseFolderItems($appFolder, $ignoredItems)
	{
		$dirHandler = @opendir($appFolder);

		while (false !== ($file = readdir($dirHandler)))
			$this->parseFileItem($file, $appFolder, $ignoredItems);

		closedir($dirHandler);
	}

	private function parseFileItem($file, $appFolder, $ignoredItems)
	{
		if (!in_array($file, $ignoredItems))
		{
			if (is_dir("$appFolder/$file"))
				$this->loadFromFolder("$appFolder/$file");
			else
				$this->importClass("$appFolder/$file");
		}
	}
}

?>