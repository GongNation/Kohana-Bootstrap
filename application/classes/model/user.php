<?php defined('SYSPATH') or die('No direct script access.');
class Model_User extends Model_Database {
/**
* 通过Id获取user相关信息
*
*/
	static function get_user_by_id($id)
	{
		$query = DB::query(Database::SELECT, 'SELECT * FROM user WHERE id=:id ');
		$query->param(':id', $id);
		$result = $query->execute();
		if ($result->count() == 1)
		{
			// 查询成功，返回user相关信息的数组
			return $result->as_array();
		}
		// 查询失败
		return FALSE;
	}

/**
* 通过username获取user相关信息
*
*/
	static function get_user_by_username($username)
 	{
		$query = DB::query(Database::SELECT, 'SELECT * FROM user WHERE username=:username');
		$query->param(':username', $username);
		$result = $query->execute();
		if ($result->count() == 1)
		{
			// 查询成功，返回user相关信息的数组
			return $result->as_array();
		}
		// 查询失败
		return FALSE;
	}

/**
* 通过email获取user相关信息
*
*/
	static function get_user_by_email($email)
	{
		$query = DB::query(Database::SELECT, 'SELECT * FROM user WHERE email=:email');
		$query->param(':email', $email);
		$result = $query->execute();
		if ($result->count() == 1)
		{
			// 查询成功，返回user相关信息的数组
			return $result->as_array();
		}
		// 查询失败
		return FALSE;
	}

/**
* 用户注册
*
*/
	static function signup($username, $password, $email)
 	{
		$check_username = self::get_user_by_username($username);
		$check_email = self::get_user_by_email($email);
		if (!$check_username AND !$check_email)
		{
			$password = md5($password);
			$query = DB::query(Database::INSERT, 'INSERT INTO user (username, password, email) VALUES (:username, :password, :email)')
				->bind(':username', $username)
				->bind(':password', $password)
				->bind(':email', $email);
			list($insert_id, $affected_rows) = $query->execute();
			if ($affected_rows == 1)
			{
				// 数据插入成功，设置session
				$session = Session::instance();
				$session->set('username', $username);
				$session->set('id', $insert_id);
				return TRUE;
			}
			// 数据插入失败
			return FALSE;
		}
		else if ($check_username AND !$check_email)
		{
			// username已经被注册，email可用，返回值 -1
			return -1;
		}
		else if ($check_email AND !$check_username)
		{
			// email已经被注册，username可用，返回值 -2
			return -2;
		}
		else
		{
			// username和email已经被注册，返回值 -3
			return -3;
		}
	}

/**
* 用户登录
*
*/
	static function login($login, $password, $remember)
	{
		// $login为email
		if (Valid::email($login))
		{
			$check_email = self::get_user_by_email($login);
			if (!$check_email)
			{
				// 登录用的email不存在
				return 1;
			}
			$query = DB::query(Database::SELECT, 'SELECT * FROM user WHERE email=:email AND password=:pass');
			$query->parameters(array(
				':email' => $login,
				':pass' => md5($password),
			));
		}
		else
		// $login为username
		{
			$check_username = self::get_user_by_username($login);
			if (!$check_username)
			{
				// 登录用的username不存在
				return 2;
			}
			$query = DB::query(Database::SELECT, 'SELECT * FROM user WHERE username=:user AND password=:pass');
			$query->parameters(array(
				':user' => $login,
				':pass' => md5($password),
			));
 		}
		
		$result = $query->execute();
		if ($result->count() == 1)
		{
			// 登录成功
			$userinfo_array = $result->as_array();
			$username = $userinfo_array[0]['username'];
			$id = $userinfo_array[0]['id'];
			
			$session = Session::instance();
			$session->set('username', $username);
			$session->set('id', $id);
			
			return TRUE;
		}
		// 密码错误
		return 3;
	}

/**
* 用户退出登录
*
*/
	static function logout()
	{
		$session = Session::instance();
		
		$session->delete('username');
		$session->delete('id');
	}

/**
* 判断用户是否登录
*
*/
	static function is_login()
 	{
		$username = Session::instance()->get('username');
		if ($username === NULL)
		{
			// 没有登录过
			return FALSE;
		}
		
		// 已经登录
		return TRUE;
	}

/**
* 在cookie中保存用户的语言
*
*/
	static function set_lang()
	{
		$lang = Request::current()->query('lang');
		if (array_key_exists($lang, Kohana::message('languages')))
		{
			Cookie::set('lang', $lang);
			I18n::lang($lang);
		}
		else
		{
			I18n::lang(Cookie::get('lang'));
		}
	}
}