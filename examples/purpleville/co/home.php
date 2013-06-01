<?

# main controller
class home_Controller
{
	use moco;

	# home model
	public $homod;

	function set ()
	{
		# set main page
		$this->p->page = 'home';

		# home model is automatically included if appropriatly named
		$this->homod = new home_Model;
	}

	function render ()
	{
		$posts = $this->homod->posts();

		$this->p->data('posts', $posts);

		# place about cotent page
		$this->p->plink('main', 'home/posts.p');

		# render the page
		$this->p->render();
	}

	function about ()
	{
		# place about cotent page
		$this->p->plink('main', 'home/about.p');

		# render the page
		$this->p->render();
	}
}