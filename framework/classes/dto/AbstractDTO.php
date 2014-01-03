<?php
class AbstractDTO
{
	public function __construct($data)
	{
		$this->parse($data);
	}

	/*
	 * Parse class properties and match them against a dynamic object.
	 * If a match is found, the dynamic object's property value is assigned to the DTO instance's corresponding property.
	 */
	protected function parse($data)
	{
		$vars = $this->getClassVars();

		foreach ($vars as $key => $value)
			if(isset($data[$key]))
				$this->$key = $data[$key];
	}

	protected function getClassVars()
	{
		return get_class_vars(get_class($this));
	}
}
?>