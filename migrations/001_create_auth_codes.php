<?php

namespace Fuel\Migrations;

class Create_Auth_Codes
{
	function up()
	{
		\DBUtil::create_table('oauth_auth_codes', array(
			'id' => array(
				'type'           => 'int',
				'constraint'     => 10,
				'auto_increment' => true,
			),
			'code' => array(
				'type'       => 'varchar',
				'constraint' => 40,
			),
			'client_id' => array(
				'type'       => 'varchar',
				'constraint' => 255,
			),
			'user_id' => array(
				'type'       => 'int',
				'constraint' => 255,
				'unsigned'   => true,
			),
			'redirect_uri' => array(
				'type'       => 'varchar',
				'constraint' => 200,
			),
			'expires' => array(
				'type'       => 'int',
				'constraint' => 255,
			),
			'scope' => array(
				'type'       => 'varchar',
				'constraint' => 200,
				'null'       => true,
			),
		), array('id'));

		\DBUtil::create_index('oauth_auth_codes', 'code', 'code');
	}

	function down()
	{
		\DBUtil::drop_table('oauth_auth_codes');
	}
}