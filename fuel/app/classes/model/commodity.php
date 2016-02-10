<?php

class Model_Commodity extends \Orm\Model_Soft
{
	protected static $_properties = array(
		'id',
		'name',
		'cost',
		'price',
		'created_at',
		'updated_at',
		'deleted_at',
	);

	protected static $_has_one = array(
		'stock' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Stock',
			'key_to' => 'commodity_id',
			'cascade_save' => true,
			'cascade_delete' => false,
		)
	);

    protected static $_belongs_to = array(
        'order_child' => array(
            'key_from' => 'id',
            'model_to' => 'Model_Order_Child',
            'key_to' => 'commodity_id',
            'cascade_save' => false,
            'cascade_delete' => false,
        )
    );

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);

	protected static $_soft_delete = array(
        'deleted_at' => 'deletedAt',
        'mysql_timestamp' => false,
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_callable('Validation_Japanese');
		$val->add_field('name', '商品名', 'required|zenkatakana|max_length[50]');
		$val->add_field('cost', '原価', 'required|valid_string[numeric]');
		$val->add_field('price', '定価', 'required|valid_string[numeric]');

		return $val;
	}

	protected static $_table_name = 'commodities';

}
