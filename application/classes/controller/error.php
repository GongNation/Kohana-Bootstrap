<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Error.
 *
 * @package    Kohana-Bootstrap/Error
 * @category   Controllers
 * @author     GongNation
 */
class Controller_Error extends Controller_Template {

	public $template = 'default/tpl_index';

	// Routes
	protected $media;
	protected $index;

	public function before()
	{
		if ($this->request->action() === 'media')
		{
			// Do not template media files
			$this->auto_render = FALSE;
		}
		else
		{
			// Grab the necessary routes
			$this->media = Route::get('media');
			$this->index = Route::get('error');
		}

		// I18n
		$lang = $this->request->query('lang');
		Model_User::set_lang($lang);

		parent::before();
	}

	public function action_404()
	{
		$this->request->status = 404;
		$this->template->title = "error 404";
		$this->template->view = View::factory('default/404');
	}

	public function action_media()
	{
		// Get the file path from the request
		$file = $this->request->param('file');

		// Find the file extension
		$ext = pathinfo($file, PATHINFO_EXTENSION);

		// Remove the extension from the filename
		$file = substr($file, 0, -(strlen($ext) + 1));

		if ($file = Kohana::find_file('media', $file, $ext))
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
			/* $this->template->styles = array(
				$media->uri(array('file' => 'css/form.css')) => 'screen',
				$media->uri(array('file' => 'css/default.css')) => 'screen',
			) */;

			// Add scripts
			/* $this->template->scripts = array(
				$media->uri(array('file' => 'js/html5.js')),
			);
 */
			// Add icon
			//$this->template->icon = $media->uri(array('file' => 'images/favicon.ico'));

			// Add languages
			//$this->template->translations = Kohana::message('userguide', 'translations');
		}

		return parent::after();
	}

} // End Userguide
