<?php

namespace Fuel\Migrations;

class Create_commodities
{
	public function up()
	{
		\DBUtil::create_table('commodities', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'name' => array('constraint' => 255, 'type' => 'varchar'),
			'cost' => array('constraint' => 11, 'type' => 'int'),
			'price' => array('constraint' => 11, 'type' => 'int'),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('commodities');
	}
}
