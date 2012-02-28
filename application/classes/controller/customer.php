<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Customer.
 *
 * @package    Kohana-Bootstrap/Customer
 * @category   Controllers
 * @author     GongNation
 */
class Controller_Customer extends Controller_Template {

	public $template = 'default/tpl_main';

	protected $session;

	public function before()
	{
		if ($this->request->action() == 'media' AND !$this->request->is_ajax())
		{
			// media和ajax页面不需要页面模版
			$this->auto_render = FALSE;
		}
		else
		{
			// 判断用户是否已登录，如未登录则重定向到首页
			$is_login = Model_User::is_login();
			if (!$is_login)
			{
				$this->request->redirect();
			}
			$this->session = Session::instance();

			// 设置语言
			Model_User::set_lang();
		}

		parent::before();
	}

	// Index
	public function action_index()
	{
	}
	
	// Home
	public function action_home()
	{
		$this->template->title = "Home Page";
		$this->template->username_session = $this->session->get('username');
		$this->template->view = View::factory('default/home');
	}
	
	// Profile
	public function action_profile()
	{
		$this->template->title = "Home Page";
		$username_get = $this->request->param('username');
		$this->template->username_get = $username_get;
		$this->template->username_session = $this->session->get('username');
		$this->template->view = View::factory('default/profile');
	}

	// Logout
	public function action_logout()
	{
		Model_User::logout();
		$this->request->redirect();
	}

	// Archives
	public function action_archives()
	{
		$this->template->title = "archives";
	}

	public function action_media()
	{
		// Get the file path from the request
		$file = $this->request->param('file');

		// Find the file extension
		$ext = pathinfo($file, PATHINFO_EXTENSION);

		// Remove the extension from the filename
		$file = substr($file, 0, -(strlen($ext) + 1));

		if ($file = Kohana::find_file('media/', $file, $ext))
		{
			// Check if the browser sent an "if-none-match: <etag>" header, and tell if the file hasn't changed
			$this->response->check_cache(sha1($this->request->uri()).filemtime($file), $this->request);
			
			// Send the file content as the response
			$this->response->body(file_get_contents($file));

			// Set the proper headers to allow caching
			$this->response->headers('content-type',  File::mime_by_ext($ext));
			$this->response->headers('last-modified', date('r', filemtime($file)));
		}
		else
		{
			// Return a 404 status
			$this->response->status(404);
		}
	}
	
	public function after()
	{
		if ($this->auto_render)
		{
			// Get the media route
			$media = Route::get('media');

			// Add styles
			$this->template->styles = array(
			);

			// Add scripts
			$this->template->scripts = array(
			);

			// Add languages
			$this->template->languages = Kohana::message('languages');
		}

		return parent::after();
	}

} // End
