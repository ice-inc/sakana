<?php

namespace Fuel\Migrations;

class Create_stock
{
	public function up()
	{
		\DBUtil::create_table('stock', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'number' => array('constraint' => 11, 'type' => 'int'),
			'threshold' => array('constraint' => 11, 'type' => 'int'),
			'commodity_id' => array('constraint' => 11, 'type' => 'int'),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('stock');
	}
}