<?php

class Controller_react extends Controller_Template
{

    public $template = 'examples/template';

    public function before()
    {
        parent::before(); 
        if(!Auth::check()){
            Response::redirect('user/login');
        }
    }

    public function action_index()
    {
        $data["subnav"] = array('index'=> 'active');
        $this->template->title = 'test';
        $this->template->content = View::forge('examples/basic/index.php', $data);
    }

}
