<?php
class AppFacade
{
	protected $smarty;
	protected $settingsManager;

	private $_currentPage = "";

	public function __construct(SettingsManager $settingsManager)
	{
		$this->settingsManager = $settingsManager;
		$this->settingsManager->loadSettings();
	}

	// **************************** Getters ********************************************

	public function getCurrentPage()
	{
		return $this->_currentPage;
	}

	public function getDefaultSection()
	{
		return $this->settingsManager->getDefaultSection();
	}

	public function getAppURL()
	{
		return $this->settingsManager->getAppURL();
	}

	public function getCurrentSection($sectionParamName)
	{
		if (isset($_GET[$sectionParamName]))
			return strtolower($_GET[$sectionParamName]);

		return $this->getDefaultSection();
	}

	// **************************** Public methods ********************************************

	public function handleSectionRequest($section)
	{
		$section = $this->settingsManager->getSectionByName($section); // SectionDTO

		$this->runSectionController($section->name);
	}

	/*
	 * Initialize the controller class by the section name
	 * and execute the entry-point method.
	 *
	 * @param sectionName - the name of the current section
	 */
	protected function runSectionController($sectionName)
	{
		$controllerClassName = ucfirst($sectionName) . "Section";

		$section = new $controllerClassName($this);
		$section->run();
	}
}
?>