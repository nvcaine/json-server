<?php
class PostsProxy extends AbstractProxy
{
	public function getPostsJSON()
	{
		return $this->db->query("SELECT ID, post_title, post_author, post_modified FROM wp_posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY post_modified DESC");
	}
}