<?php
class UsersProxy extends AbstractProxy
{
	public function getUsersJSON()
	{
		return $this->db->query("SELECT ID, user_login, user_email FROM wp_users");
	}
}