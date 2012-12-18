<?php

namespace OAuth2Server;

class Model_RefreshToken extends \Orm\Model
{
	protected static $_table_name = 'oauth_refresh_tokens';

	protected static $_properties = array(
		'id',
		'refresh_token',
		'client_id',
		'user_id',
		'expires',
		'scope',
	);
}