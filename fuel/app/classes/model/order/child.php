<?php

class Model_Order_Child extends \Orm\Model_Soft
{
    protected static $_properties = array(

        'id',
        'orders_id',
        'commodity_id',
        'cost',
        'number',
        'price',
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    );

    protected static $_belongs_to = array(
        'order' => array(
            'key_from' => 'orders_id',
            'model_to' => 'Model_Order',
            'key_to' => 'id',
            'cascade_save' => true,
            'cascade_delete' => false,
        )
    );
    
    protected static $_has_one = array(
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

        if (Input::post('order'))
        {
            $order_children = Input::post('order');

            foreach ($order_children as $form_id => $order_child)
            {
                $val->add_field('order.' . $form_id . '.number', '個数', 'required|valid_string[numeric]|max_length[4]');
            }
            return $val;
        }

        $val->add_field('number', '個数', 'required|valid_string[numeric]|max_length[4]');
        $val->add_field('date', '受取日', 'required|max_length[15]');

        return $val;
    }

    protected static $_table_name = 'order_children';

}
