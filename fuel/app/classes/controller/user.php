<?php

class Controller_User extends Controller_Template
{
    public function action_create()
    {
        $data["subnav"] = array('signup'=> 'active' );
        $this->template->title = 'Sakana &raquo; 新規登録';
        $this->template->content = View::forge('user/create', $data);
    }
    
    public function action_signin()
    {
        $data["subnav"] = array('signin'=> 'active' );
        $this->template->title = 'Sakana';
        $this->template->content = View::forge('user/signin', $data);
    }
}