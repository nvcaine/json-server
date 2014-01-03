<?php
class UsersSection extends AbstractSection
{
	public function run()
	{
		parent::run();

		$proxy = new UsersProxy(DBWrapper::cloneInstance());

		echo json_encode($proxy->getUsersJSON());
	}
}