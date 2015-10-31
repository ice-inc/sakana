<?php

class Model_Client extends \Orm\Model_Soft
{
    protected static $_properties = array(

        'id',
        'first_name',
        'last_name',
        'tell',
        'email',
        'created_at',
        'updated_at',
        'deleted_at',
    );

    protected static $_has_one = array(
        'order' => array(
            'key_from' => 'id',
            'model_to' => 'Model_Order',
            'key_to' => 'client_id',
            'cascade_save' => true,
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
        $val->add_field('first_name', '姓', 'required|hirakatakan|max_length[50]');
        $val->add_field('last_name', '名', 'required|hirakatakan|max_length[50]');
        $val->add_field('tell', '電話番号', 'required|valid_string[numeric]|max_length[15]|min_length[5]');
        $val->add_field('email', 'メールアドレス', 'required|valid_email');

        return $val;
    }

    protected static $_table_name = 'clients';

}
