<?php

// 静态文件 (CSS, JS, images)
Route::set('media', 'media(/<file>)', array('file' => '.+'))
	->defaults(array(
		'controller'	=> 'base',
		'action'		=> 'media',
		'file'			=> NULL,
	));

// index
Route::set('index', '(<action>)', array('action' => '(signup|login|about|contact|jobs|service|privacy|feedback)'))
	->defaults(array(
		'controller'	=> 'index',
		'action'		=> 'index',
	));

// 用户退出
Route::set('logout', 'logout')
	->defaults(array(
		'controller'	=> 'customer',
		'action'		=> 'logout',
	));

// 用户的个人主页
Route::set('profile', '<username>')
	->defaults(array(
		'controller'	=> 'customer',
		'action'		=> 'index',
	));

// 用户个人设置
Route::set('settings', 'settings/<action>', array('action' => '(account|system|theme)'))
	->defaults(array(
		'controller'	=> 'customer',
		'action'		=> NULL,
	));

// 默认
Route::set('default', '(<controller>(/<action>))')
	->defaults(array(
		'controller'	=> 'index',
		'action'		=> 'index',
	));

// 404错误页面
Route::set('error', '<path>', array('path' => '.+'))
	->defaults(array(
		'controller'	=> 'error',
		'action'		=> '404',
	));
