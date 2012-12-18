<?php

namespace OAuth2Server;

class Model_AccessToken extends \Orm\Model
{
	protected static $_table_name = 'oauth_access_tokens';

	protected static $_properties = array(
		'id',
		'oauth_token',
		'client_id',
		'user_id',
		'expires',
		'scope',
	);
}