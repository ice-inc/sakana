<?php

namespace Fuel\Migrations;

class Create_mst_digit
{
    public function up()
    {
        \DBUtil::create_table('mst_digit', array(
            'digit' => array('constraint' => 11, 'type' => 'int'),
        ), array('digit'));
    }

    public function down()
    {
        \DBUtil::drop_table('users');
    }
}
