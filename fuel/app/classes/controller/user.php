<?php

class Controller_User extends Controller_Base
{
    public $template = 'template';

    // すべてのアクションが実行される間にされる処理
    public function before()
    {
        // この行がなければテンプレートが動作しない
        parent::before();

        //
        if (Request::active()->controller !== 'Controller_User' or ! in_array(Request::active()->action, array('login', 'logout')))
        {
            // ログインしている場合
            if (Auth::check())
            {
                $admin_group_id = Config::get('auth.driver', 'Simpleauth') == 'Ormauth' ? 6 : 100;
                if ( ! Auth::member($admin_group_id))
                {
                    Session::set_flash('error', e('You don\'t have access to the admin panel'));
                    Response::redirect('/');
                }
            }
            else
            {
//                Response::redirect('user/login');
            }
        }
    }

    public function action_login()
    {
        // すでにログインしていた場合、リダイレクト
        Auth::check() and Response::redirect('user');

        $val = Validation::forge();

        // POSTされた場合
        if (Input::method() == 'POST')
        {
            // 各項目をvalidateする
            $val->add('email', 'Email or Username')
                ->add_rule('required');
            $val->add('password', 'Password')
                ->add_rule('required');

            // バリデーションがOKだった場合
            if ($val->run())
            {
                // ログインしていない場合
                if ( ! Auth::check())
                {
                    // postされた値をもとにログイン処理
                    if (Auth::login(Input::post('email'), Input::post('password')))
                    {
                        // このレコードを更新した続いたユーザーIDを割り当てます
                        foreach (\Auth::verified() as $driver)
                        {
                            // ユーザidがfalseでない場合
                            if (($id = $driver->get_user_id()) !== false)
                            {
                                // 資格情報がOKならば, うまくいく
                                $current_user = Model\Auth_User::find($id[1]);
                                // セッションフラッシュをセット
                                Session::set_flash('ログインしました', e('ようこそ, '.$current_user->username.'さん'));
                                // リダイレクト
                                $now = Date::forge()->get_timestamp();
                                Response::redirect('list/index/'.$now);
                            }
                        }
                    }
                    // ログインできなかった場合
                    else
                    {
                        // エラーメッセージをセット
                        $this->template->set_global('ログインエラー', 'ログインに失敗しました!');
                    }
                }
                // すでにログインされているアカウントの場合
                else
                {
                    // エラーメッセージをセット
                    $this->template->set_global('ログインエラー', 'すでにログインされています');
                }
            }
        }

        $this->template->title = 'Sakana &raquo; Login';
        $this->template->content = View::forge('user/login', array('val' => $val), false);
    }

    public function action_create()
    {
        $val = Validation::forge();
        // POSTされた場合
        if (Input::method() == 'POST')
        {
            // 各項目をvalidateする
            $val->add('username', 'Username')->add_rule('required');
            $val->add('password', 'Password')->add_rule('required');
            $val->add('email', 'Email')->add_rule('required');

            // バリデーションがOKだった場合
            if ($val->run())
            {
                try
                {
                    $created = Auth::create_user(
                        Input::post('username'),
                        Input::post('password'),
                        Input::post('email'),
                        1,
                        array()
                    );

                    if($created)
                    {
                        // ユーザに通知
                        Session::set_flash('Success', '新規登録完了しました');

                        // そして、前のページに戻る
                        \Response::redirect_back();
                    }
                    else
                    {
                        // 新しいユーザーの作成に失敗した場合
                        Session::set_flash('Error', 'アカウント登録に失敗しました');
                    }
                }
                
                catch(\SimpleUserUpdateException $e)
                {
                    if($e->getCode() == 2)
                    {
                        Session::set_flash('Error', 'そのメールアドレスは、既に存在しています');
                    }
                    elseif($e->getCode() == 3)
                    {
                        Session::set_flash('Error', 'そのユーザ名は、既に存在しています');
                    }
                    else
                    {
                        Session::set_flash('Error', $e->getMessage());
                    }
                }                
            }
        }
        
        $this->template->title = 'Sakana &raquo; ユーザ登録';
        $this->template->content = View::forge('user/create', array('val' => $val), false);
    }
    
    /**
     * ログアウト処理
     *
     * @access  public
     * @return  void
     */
    public function action_logout()
    {
        Auth::logout();

        Response::redirect('user/login');
    }
}

