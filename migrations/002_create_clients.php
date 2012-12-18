<?php

namespace Fuel\Migrations;

class Create_Clients
{
	function up()
	{
		\DBUtil::create_table('oauth_clients', array(
			'id' => array(
				'type'           => 'int',
				'constraint'     => 10,
				'auto_increment' => true,
			),
			'client_id' => array(
				'type'       => 'varchar',
				'constraint' => 255,
			),
			'client_secret' => array(
				'type'       => 'varchar',
				'constraint' => 255,
			),
			'redirect_uri' => array(
				'type'       => 'varchar',
				'constraint' => 255,
			),
		), array('id'));
		
		\DBUtil::create_index('oauth_clients', 'client_id', 'client_id');
	}

	function down()
	{
		\DBUtil::drop_table('oauth_clients');
	}
}