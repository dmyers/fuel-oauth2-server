<?php

Autoloader::add_core_namespace('OAuth2Server');

Autoloader::add_classes(array(
	'OAuth2Server\\OAuth2Server'          => __DIR__.'/classes/oauth2server.php',
	'OAuth2Server\\OAuth2ServerException' => __DIR__.'/classes/oauth2server.php',
	'OAuth2Server\\OAuth2StorageFuel'     => __DIR__.'/classes/oauth2storagefuel.php',
	'OAuth2Server\\Model_AccessToken'     => __DIR__.'/classes/model/accesstoken.php',
	'OAuth2Server\\Model_AuthCode'        => __DIR__.'/classes/model/authcode.php',
	'OAuth2Server\\Model_Client'          => __DIR__.'/classes/model/client.php',
	'OAuth2Server\\Model_RefreshToken'    => __DIR__.'/classes/model/refreshtoken.php',
));
