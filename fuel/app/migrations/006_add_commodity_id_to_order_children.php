<?php

namespace Fuel\Migrations;

class Add_commodity_id_to_order_children
{
	public function up()
	{
		\DBUtil::add_fields('order_children', array(
			'commodity_id' => array('constraint' => 11, 'type' => 'int'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('order_children', array(
			'commodity_id'

		));
	}
}