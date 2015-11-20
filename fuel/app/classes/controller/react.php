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
        $this->template->title = 'basic';
        $this->template->content = View::forge('examples/basic/index.php');
    }

    public function action_click_counter()
    {
        $this->template->title = 'click counter';
        $this->template->content = View::forge('examples/basic-click-counter/index.php');
    }

}
