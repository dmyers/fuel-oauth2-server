<?php
 
namespace OAuth2Server;

require_once PKGPATH.'oauth2server'.DS.'vendor'.DS.'oauth2'.DS.'OAuth2.php';
require_once PKGPATH.'oauth2server'.DS.'vendor'.DS.'oauth2'.DS.'OAuth2Client.php';
require_once PKGPATH.'oauth2server'.DS.'vendor'.DS.'oauth2'.DS.'IOAuth2Storage.php';
require_once PKGPATH.'oauth2server'.DS.'vendor'.DS.'oauth2'.DS.'IOAuth2GrantCode.php';
require_once PKGPATH.'oauth2server'.DS.'vendor'.DS.'oauth2'.DS.'IOAuth2RefreshTokens.php';
require_once PKGPATH.'oauth2server'.DS.'vendor'.DS.'oauth2'.DS.'OAuth2Exception.php';
require_once PKGPATH.'oauth2server'.DS.'vendor'.DS.'oauth2'.DS.'OAuth2ServerException.php';
require_once PKGPATH.'oauth2server'.DS.'vendor'.DS.'oauth2'.DS.'OAuth2AuthenticateException.php';
require_once PKGPATH.'oauth2server'.DS.'vendor'.DS.'oauth2'.DS.'OAuth2RedirectException.php';

class OAuth2Server extends OAuth2
{
	/**
	 * loaded oauth2server instance
	 */
	protected static $_instance = null;

	/**
	 * Returns a new OAuth2 object.
	 *
	 *     $oauth = OAuth2::forge();
	 *
	 * @param	void
	 * @access	public
	 * @return  OAuth2
	 */
	public static function forge()
	{
		$config = \Config::load('oauth2server', true);

		$instance = new static(new OAuth2StorageFuel(), array(
			self::CONFIG_ACCESS_LIFETIME => $config[self::CONFIG_ACCESS_LIFETIME],
		));
		
		return $instance;
	}

	/**
	 * create or return the oauth2server instance
	 *
	 * @param	void
	 * @access	public
	 * @return	OAuth2
	 */
	public static function instance()
	{
		if (self::$_instance === null) {
			self::$_instance = self::forge();
		}

		return self::$_instance;
	}
}
