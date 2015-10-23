<?php

namespace Fuel\Migrations;

class Create_orders
{
	public function up()
	{
		\DBUtil::create_table('orders', array(
			'id' => array('constraint' => 11, 'type' => 'int'),
			'client_id' => array('constraint' => 11, 'type' => 'int'),
			'number' => array('constraint' => 11, 'type' => 'int'),
			'price' => array('constraint' => 11, 'type' => 'int'),
			'date' => array('type' => 'datetime'),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('orders');
	}
}
