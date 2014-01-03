<?php
/*
 * This class is reposible for loading the app settings and making them available to the AppFacade
 */
class SettingsManager
{
	protected $settingsFileName = "";
	protected $settings;

	private $sectionsInfo = array();
	private $defaultSection = "";
	private $appURL = "";

	public function __construct($settingsFileName)
	{
		$this->settingsFileName = $settingsFileName;
	}

	// **************************** Getters ********************************************
	
	public function getSections()
	{
		return $this->sectionsInfo;
	}

	public function getSectionByName($sectionName)
	{
		foreach ($this->sectionsInfo as $sectionInfo)
			if ($sectionInfo->name == $sectionName)
				return $sectionInfo;

		//return null;
		throw new Exception("Unknown section name: " . $sectionName, 1);
	}

	public function getDefaultSection()
	{
		return $this->defaultSection;
	}

	public function getAppURL()
	{
		return $this->appURL;
	}

	// **************************** Public methods ********************************************
	
	public function loadSettings()
	{
		$xml = simplexml_load_file($this->settingsFileName);

		$this->parseSettings($xml);
	}

	// **************************** Protected methods ********************************************
	
	protected function parseSettings($xml)
	{
		$this->parseSections($xml);
		$this->parseGlobalSettings($xml);
	}

	protected function parseSections($xml)
	{
		foreach ($xml->sections->section as $section)
			$this->sectionsInfo[] = new SectionDTO($section);
	}

	protected function parseGlobalSettings($xml)
	{
		$this->defaultSection = (string)$xml->defaultSection;

		$this->appURL = (string)$xml->appURL;
	}
}

?>