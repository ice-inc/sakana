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

    public function action_basic_commonjs()
    {
        $this->template->title = 'basic commonjs';
        $this->template->content = View::forge('examples/basic-commonjs/index.php');
    }

    public function action_basic_jsx()
    {
        $this->template->title = 'basic jsx';
        $this->template->content = View::forge('examples/basic-jsx/index.php');
    }

    public function action_basic_jsx_external()
    {
        $this->template->title = 'basic jsx external';
        $this->template->content = View::forge('examples/basic-jsx-external/index.php');
    }

    public function action_jquery_bootstrap()
    {
        $this->template->title = 'jquery bootstrap';
        $this->template->content = View::forge('examples/jquery-bootstrap/index.php');
    }

}
