<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Base.
 *
 * @package    Kohana-Bootstrap/Base
 * @category   Controllers
 * @author     GongNation
 */
class Controller_Base extends Controller_Template {

	public $template = 'default/index/index';

	public function before()
	{
		if ($this->request->action() == 'media' AND !$this->request->is_ajax())
		{
			// media和ajax页面不需要页面模版
			$this->auto_render = FALSE;
		}

		parent::before();
	}
	
	// Index
	public function action_index()
	{
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
		}

		return parent::after();
	}

} // End
