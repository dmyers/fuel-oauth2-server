<?php

namespace OAuth2Server;

class Model_Client extends \Orm\Model
{
	protected static $_table_name = 'oauth_clients';

	protected static $_properties = array(
		'id',
		'client_id',
		'client_secret',
		'redirect_uri',
	);

	protected static $_to_array_filter = array('client_secret');
}