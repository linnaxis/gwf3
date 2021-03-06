<?php
final class Slaytags_CrossLogin extends GWF_Method
{
	const SITE_SLAY = 1;
	private function slayradioHash($userid) { return slayradio_cross_login_hash($userid); }
	
	public function getHTAccess()
	{
		return 'RewriteRule ^slayradio/cross/login/(\\d+)/([^/]+)/?$ index.php?mo=Slaytags&me=CrossLogin&site=1&uid=$1&token=$2'.PHP_EOL;
	}
	
	public function execute()
	{
		require_once GWF_CORE_PATH.'module/Slaytags/slay_secrets.php';
		
		if (0 === ($site = Common::getGetInt('site')))
		{
			return GWF_HTML::err('ERR_PARAMETER', array(__FILE__, __LINE__, 'site'));
		}
		
		if (0 >= ($userid = Common::getGetInt('uid')))
		{
			return GWF_HTML::err('ERR_PARAMETER', array(__FILE__, __LINE__, 'uid'));
		}
		
		if ('' === ($token = Common::getGetString('token')))
		{
			return GWF_HTML::err('ERR_PARAMETER', array(__FILE__, __LINE__, 'uid'));
		}

		if ($site === 1)
		{
			return $this->onCrossLoginSlayradio($userid, $token);
		}
		else
		{
			return GWF_HTML::err('ERR_PARAMETER', array(__FILE__, __LINE__, 'site'));
		}
	}
	
	
	private function onCrossLoginSlayradio($userid, $token)
	{
		if ($token !== $this->slayradioHash($userid))
		{
//			return $this->module->error('err_cross_login');
		}
		
		$username = "1_{$userid}";
		
		return $this->onCrossLogin($username);
	}
	
	private function onCrossLogin($username)
	{
		if (false === ($user = GWF_User::getByName($username)))
		{
			if (false === ($user = $this->onCrossRegister($username)))
			{
				return GWF_HTML::err('ERR_DATABASE', array(__FILE__, __LINE__));
			}
		}
		
		return $this->onCrossLoginB($user);
	}
	
	private function onCrossRegister($username)
	{
		$options = 0;
		
		$password = GWF_Random::randomKey();
		
		$user = new GWF_User(array(
			'user_id' => 0,
			'user_options' => $options,
			'user_name' => $username,
			'user_password' => GWF_Password::hashPasswordS($password),
			'user_regdate' => GWF_Time::getDate(GWF_Date::LEN_SECOND),
			'user_regip' => GWF_IP6::getIP(GWF_IP_EXACT),
			'user_email' => '',
			'user_gender' => 'no_gender',
			'user_lastlogin' => time(),
			'user_lastactivity' => time(),
			'user_birthdate' => '00000000',
			'user_avatar_v' => 0,
			'user_countryid' => 0,
			'user_langid' => 1,
			'user_langid2' => 0,
			'user_level' => 0,
			'user_title' => '',
			'user_settings' => '',
			'user_data' => '',
			'user_credits' => '0.00',
		));
		
		if (false === ($user->insert()))
		{
			return false;
		}
		
		return true;
	}

	private function onCrossLoginB(GWF_User $user)
	{
		if ($user->isDeleted())
		{
			return GWF_HTML::err('ERR_NO_PERMISSION');
		}
		
		if (false === GWF_Session::onLogin($user, false, true))
		{
			return $this->module->error('ERR_GENERAL', array(__FILE__, __LINE__));
		}
		
		return $this->module->message('msg_cross_login');
	}
}
?>