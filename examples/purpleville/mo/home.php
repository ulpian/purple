<?

class home_Model
{
	use modo;

	function set ()
	{
		# setup anything
	}

	function posts ()
	{
		# get the posts
		$posts = json_decode(file_get_contents('box/store/posts.json'), true);
		
		(!empty($posts)) 
		?
			$posts = $posts
		: 
			$posts = ['msg' => 'no posts'];

		return $posts;
	}
}