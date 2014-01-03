<?php
abstract class AbstractSection
{
	protected $appFacade;

	public function __construct(AppFacade $facade)
	{
		$this->appFacade = $facade;
	}

	public function run()
	{
		$this->setHeader();
	}

	protected function setHeader()
	{
		header("Content-type: application/json");
	}
}