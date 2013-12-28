<?php

namespace Fuel\Migrations;

class Create_Refresh_Tokens
{
	function up()
	{
		\DBUtil::create_table('oauth_refresh_tokens', array(
			'id' => array(
				'type'           => 'int',
				'constraint'     => 10,
				'auto_increment' => true,
			),
			'refresh_token' => array(
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
			'expires' => array(
				'type'       => 'int',
				'constraint' => 255,
			),
			'scope' => array(
				'type'       => 'varchar',
				'constraint' => 255,
				'null'       => true,
			),
		), array('id'));
		
		\DBUtil::create_index('oauth_refresh_tokens', 'refresh_token', 'refresh_token');
	}

	function down()
	{
		\DBUtil::drop_table('oauth_refresh_tokens');
	}
}