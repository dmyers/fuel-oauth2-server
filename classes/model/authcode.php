<?php

namespace OAuth2Server;

class Model_AuthCode extends \Orm\Model
{
	protected static $_table_name = 'oauth_auth_codes';

	protected static $_properties = array(
		'id',
		'code',
		'client_id',
		'user_id',
		'redirect_uri',
		'expires',
		'scope',
	);
}