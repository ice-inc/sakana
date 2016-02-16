<?php

class Controller_Ajax extends Controller_Rest
{
    protected $format = 'json';

    public function post_create()
    {
        $name = \Fuel\Core\Input::post('name');

        $commodity = Model_Commodity::find('all', array(
            'select' => array('id', 'cost', 'price'),
            'where' => array(array('name', $name)),
            'related'=> array('stock')
        ));

        return $this->response($commodity);
    }
}