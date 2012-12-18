<?php

namespace OAuth2Server;

/**
 * Fuel storage engine for the OAuth2 Library.
 */
class OAuth2StorageFuel implements IOAuth2GrantCode, IOAuth2RefreshTokens {

	/**
	 * Little helper function to add a new client to the database.
	 *
	 * @param $client_id
	 * Client identifier to be stored.
	 * @param $client_secret
	 * Client secret to be stored.
	 * @param $redirect_uri
	 * Redirect URI to be stored.
	 */
	public function addClient($client_id, $client_secret, $redirect_uri) {
		$client_secret = md5($client_secret . $client_id);
		
		$client = Model_Client::forge();
		$client->client_id 		= $client_id;
		$client->client_secret 	= $client_secret;
		$client->redirect_uri 	= $redirect_uri;
		
		try {
			$client->save();
		} catch (\FuelException $e) {
			$this->handleException($e);
		}
	}

	/**
	 * Implements IOAuth2Storage::checkClientCredentials().
	 */
	public function checkClientCredentials($client_id, $client_secret = NULL) {
		try {
			$client = Model_Client::find_by_client_id($client_id);
			
			if ($client_secret === NULL) {
				return $client !== FALSE;
			}
			
			return md5($client_secret . $client_id) == $client->client_secret;
		} catch (\FuelException $e) {
			$this->handleException($e);
		}
	}

	/**
	 * Implements IOAuth2Storage::getRedirectUri().
	 */
	public function getClientDetails($client_id) {

		$client = Model_Client::find_by_client_id($client_id);
		
		if (is_null($client))
		{
			return FALSE;			
		}
		else
		{
			return $client->to_array();			
		}
	}

	/**
	 * Implements IOAuth2Storage::getAccessToken().
	 */
	public function getAccessToken($oauth_token) {
		return $this->getToken($oauth_token, FALSE);
	}

	/**
	 * Implements IOAuth2Storage::setAccessToken().
	 */
	public function setAccessToken($oauth_token, $client_id, $user_id, $expires, $scope = NULL) {
		$this->setToken($oauth_token, $client_id, $user_id, $expires, $scope, FALSE);
	}

	/**
	 * @see IOAuth2Storage::getRefreshToken()
	 */
	public function getRefreshToken($refresh_token) {
		return $this->getToken($refresh_token, TRUE);
	}

	/**
	 * @see IOAuth2Storage::setRefreshToken()
	 */
	public function setRefreshToken($refresh_token, $client_id, $user_id, $expires, $scope = NULL) {
		return $this->setToken($refresh_token, $client_id, $user_id, $expires, $scope, TRUE);
	}

	/**
	 * @see IOAuth2Storage::unsetRefreshToken()
	 */
	public function unsetRefreshToken($refresh_token) {
		$token = Model_RefreshToken::find_by_refresh_token($refresh_token);
		$token->delete();
	}

	/**
	 * Implements IOAuth2Storage::getAuthCode().
	 */
	public function getAuthCode($oauth_code) {
		$code = Model_AuthCode::find_by_code($oauth_code);
		
		if(is_null($code))
		{
			return NULL;
		}
		else
		{
			return $code->to_array();
		}
	}

	/**
	 * Implements IOAuth2Storage::setAuthCode().
	 */
	public function setAuthCode($oauth_code, $client_id, $user_id, $redirect_uri, $expires, $scope = NULL) {
		$code =  Model_AuthCode::forge();
		$code->code 		= $oauth_code;
		$code->client_id 	= $client_id;
		$code->user_id 		= $user_id;
		$code->redirect_uri = $redirect_uri;
		$code->expires 		= $expires;
		$code->scope 		= $scope;

		try {
			$code->save();
		} catch (\FuelException $e) {
			$this->handleException($e);
		}
	}

	/**
	 * @see IOAuth2Storage::checkRestrictedGrantType()
	 */
	public function checkRestrictedGrantType($client_id, $grant_type) {
		return TRUE; // Not implemented
	}

	/**
	 * Creates a refresh or access token
	 * 
	 * @param string $token - Access or refresh token id
	 * @param string $client_id
	 * @param mixed $user_id
	 * @param int $expires
	 * @param string $scope
	 * @param bool $isRefresh
	 */
	protected function setToken($oauth_token, $client_id, $user_id, $expires, $scope, $isRefresh = TRUE) {
		if($isRefresh)
		{
			$token = Model_RefreshToken::forge();
			$token->refresh_token = $oauth_token;
		}
		else
		{
			$token = Model_AccessToken::forge();
			$token->oauth_token = $oauth_token;			
		}
		
		$token->client_id 	= $client_id;
		$token->user_id 	= $user_id;
		$token->expires 	= $expires;
		$token->scope 		= $scope;

		try {
			$token->save();
		} catch (\FuelException $e) {
			$this->handleException($e);
		}
	}

	/**
	 * Retrieves an access or refresh token.
	 * 
	 * @param string $token
	 * @param bool $refresh
	 */
	protected function getToken($oauth_token, $isRefresh = true) {
		if($isRefresh)
		{
			$token = Model_RefreshToken::find_by_refresh_token($oauth_token);
		}
		else
		{
			$token = Model_AccessToken::find_by_oauth_token($oauth_token);
		}
		
		if(is_null($token))
		{
			return NULL;
		}
		else
		{
			return $token->to_array();
		}
	}
}
