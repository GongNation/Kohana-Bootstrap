<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Index.
 *
 * @package    Kohana-Bootstrap/Index
 * @category   Controllers
 * @author     GongNation
 */
class Controller_Index extends Controller_Template {

	public $template = 'default/tpl_index';

	protected $login_error = FALSE;
	protected $signup_error = FALSE;
	protected $is_login = FALSE;

	public function before()
	{
		$action = $this->request->action();
		if ($action == 'media' AND !$this->request->is_ajax())
		{
			// media和ajax页面不需要页面模版
			$this->auto_render = FALSE;
		}
		else
		{
			// 设置语言
			Model_User::set_lang();
		}

		parent::before();
	}
	
	// Index
	public function action_index()
	{
		// 判断用户是否已登录，如已登录则将请求转向到其个人中心
		$is_login = Model_User::is_login();
		if ($is_login)
		{
			$request = Request::factory('customer/home');
			$response = $request->execute()->send_headers()->body();
			echo $response;
			exit;
		}
		
		$this->template->title = "Kohana-Bootstrap";
		$this->template->login_error = $this->login_error;
		$this->template->signup_error = $this->signup_error;
		$this->template->view = View::factory('default/index');
	}

	// Login
	public function action_login()
	{
		// 判断用户是否已登录，如已登录则重定向到其个人中心
		$is_login = Model_User::is_login();
		if ($is_login)
		{
			$this->request->redirect();
		}
		
		if (count($this->request->post()) == 0)
		{
			// 无数据，重定向到登录页面
			$this->request->redirect();
		}
		else
		{
			$login = $this->request->post('login');
			$password = $this->request->post('password');
			$remember = $this->request->post('remember');
			$login = Model_User::login($login, $password, $remember);
			if ($login === TRUE)
			{
				$this->request->redirect();
			}
			$this->login_error = $login;
			$this->action_index();
		}
	}

	// Signup
	public function action_signup()
	{
		// 判断用户是否已登录，如已登录则重定向到其个人中心
		$is_login = Model_User::is_login();
		if ($is_login)
		{
			$this->request->redirect();
		}
		
		if (count($this->request->post()) == 0)
		{
			// 无数据，重定向到注册页面
			$this->request->redirect();
		}
		else
		{
			$username 	= $this->request->post('username');
			$password 	= $this->request->post('password');
			$email 		= $this->request->post('email');
			
			$signup = Model_User::signup($username, $password, $email);
			if (is_bool($signup))
			{
				$this->request->redirect();
			}
			$this->signup_error = $signup;
			$this->action_index();
		}
	}

	// About
	public function action_about()
	{
		$this->template->title = __('About');
		$this->template->view = View::factory('default/about');
	}

	// Contact
	public function action_contact()
	{
		$this->template->title = __('Contact');
		$this->template->view = View::factory('default/contact');
	}

	// Jobs
	public function action_jobs()
	{
		$this->template->title = __('Jobs');
		$this->template->view = View::factory('default/jobs');
	}

	// Service
	public function action_service()
	{
		$this->template->title = __('Service');
		$this->template->view = View::factory('default/service');
	}

	// Privacy
	public function action_privacy()
	{
		$this->template->title = __('Privacy');
		$this->template->view = View::factory('default/privacy');
	}

	// Feedback
	public function action_feedback()
	{
		$this->template->title = __('Feedback');
		$this->template->view = View::factory('default/feedback');
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

			// Add scripts
			$this->template->scripts = array(
				$media->uri(array('file' => 'js/index.js')),
			);

			// Add languages
			$this->template->languages = Kohana::message('languages');
		}

		return parent::after();
	}

} // End
