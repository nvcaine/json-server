<?php
/*
 * Abstract proxy class,
 * Used for creating objects that query data from a persistent layer.
 */
abstract class AbstractProxy
{
	protected $dbInstance;

	public function __construct(DBWrapper $dbInstance = null)
	{
		$this->db = $dbInstance;
	}
}
?>