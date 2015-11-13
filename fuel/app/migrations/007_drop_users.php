<?php

namespace Fuel\Migrations;

class Drop_users
{
	public function up()
	{
		\DBUtil::drop_table('users');
	}

	public function down()
	{
		\DBUtil::create_table('users', array(
			'id' => array('type' => 'int', 'null' => true, 'constraint' => 11, 'auto_increment' => true),
			'client_id' => array('type' => 'int', 'null' => true, 'constraint' => 11),
			'number' => array('type' => 'int', 'null' => true, 'constraint' => 11),
			'price' => array('type' => 'int', 'null' => true, 'constraint' => 11),
			'date' => array('type' => 'datetime', 'null' => true),
			'created_at' => array('type' => 'int', 'null' => true, 'constraint' => 11),
			'updated_at' => array('type' => 'int', 'null' => true, 'constraint' => 11),
			'deleted_at' => array('type' => 'int', 'null' => true, 'constraint' => 11),

		), array('id'));

	}
}