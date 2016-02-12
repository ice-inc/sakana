<?php

class Model_Stock extends \Orm\Model_soft {

    protected static $_properties = array(
        'id',
        'number',
        'threshold',
        'commodity_id',
        'deleted_at',
        'created_at',
        'updated_at'
    );

    protected static $_belongs_to = array(
        'commodity' => array(
            'key_from' => 'commodity_id',
            'model_to' => 'Model_Commodity',
            'key_to' => 'id',
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
            'events' => array('before_save'),
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
        $val->add_field('number', '在庫', 'required|valid_string[numeric]');
        $val->add_field('threshold', '最低個数', 'required|valid_string[numeric]');

        return $val;
    }

    protected static $_table_name = 'stock';
}