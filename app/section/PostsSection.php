<?php
class PostsSection extends AbstractSection
{
	public function run()
	{
		parent::run();

		$proxy = new PostsProxy(DBWrapper::cloneInstance());

		echo json_encode($proxy->getPostsJSON());
	}
}