<?php

class Validation_Error extends Fuel\Core\Validation_Error
{
    public static function _init()
    {
        parent::_init();

        \Lang::load('validation_params', true);
    }

    protected function _replace_tags($msg)
    {
        // あとでもとに戻すためにコピーしておく
        $params = $this->params;

        if ($this->rule === 'valid_string')
        {
            foreach ($this->params as $key => $val)
            {
                foreach ($val as $k => $v)
                {
                    // ここで param:1 の部分を日本語化
                    $this->params[$key][$k] = \Lang::get('validation_params.' . $this->rule . '.' . $v) ?: $v;
                }
            }
        }

        $msg = parent::_replace_tags($msg);

        $this->params = $params;

        return $msg;
    }
}
