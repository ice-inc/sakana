<?php

class Controller_Sakana extends Controller_Template
{
    public $template = 'template/template';

    public function before()
    {
        // この行がないと、テンプレートが動作しない!
        parent::before();

        //未ログインの場合、ログインページへリダイレクト
        if(!Auth::check()){
            Response::redirect('user/login');
        }
    }

    public function action_index()
    {
        $data['date'] = Date::forge()->get_timestamp();

        // モデルから、全データを取得してビューに渡すための配列に入れる
        $data['commodity'] = Model_Commodity::find('all',array(
           'related' => array('stock')
        ));

        // ビューテンプレート
        $data["subnav"] = array('index'=> 'active' );
        $this->template->title = 'Sakana &raquo; 商品一覧';
        $this->template->content = View::forge('sakana/index', $data);
        $this->template->nav = View::forge('template/nav', $data);
    }

    public function action_create()
    {
        $data = array();
        $data['date'] = Date::forge()->get_timestamp();

        // 投稿ボタンが押され、postされたとき
        if (Input::method() == 'POST')
        {
            $post = \Fuel\Core\Input::post();
            // model/post.phpで定義されたvalidateメソッド実行
            // validateオブジェクトを$valに代入
            $val1 = Model_Commodity::validate('create1');

            if ($val1->run())
            {
                $val2 = Model_Stock::validate('create2');

                print_r($post['number']);
                if ($val2->run())
                {
                    // 各POSTデータをモデルオブジェクトとして、$postに代入
                    $commodity = Model_Commodity::forge(array(
                        'name' => $post['name'],
                        'cost' => $post['cost'],
                        'price' => $post['price'],
                    ));

                    $commodity->stock = Model_Stock::forge(array(
                        'number' => $post['number']
                    ));

                    // 各POSTデータの保存に成功した時
                    if ($commodity and $commodity->save()) {
                        // 成功したメッセージをフラッシュセッションに入れる
                        Session::set_flash('データの登録に成功しました');
                        // TOPページへリダイレクト
                        Response::redirect('sakana/index');
                    } // 各POSTデータの保存失敗時
                    else {
                        // エラーメッセージをフラッシュセッションに入れる
                        Session::set_flash('エラー', 'データの保存に失敗しました');
                    }
                }
                // validationエラーが出たとき
                else
                {
                    // validationエラーのメッセージをセットする
                    Session::set_flash('error', $val2->error());
                }
            }
            // validationエラーが出たとき
            else
            {
                // validationエラーのメッセージをセットする
                Session::set_flash('error', $val1->error());
            }
        }

        // ビューテンプレート呼び出し
        $data["subnav"] = array('create' => 'active' );
        $this->template->title = 'Sakana &raquo; 商品登録';
        $this->template->content = View::forge('sakana/create', $data);
        $this->template->content = View::forge('sakana/_form', $data);
        $this->template->nav = View::forge('template/nav', $data);
    }

    public function action_edit($id=null)
    {
        $data = array();
        $data['date'] = Date::forge()->get_timestamp();

        // URLに記事idが含まれていない時、トップページへ戻す
        is_null($id) and Response::redirect('sakana/index');

        // 記事idのデータがモデルから見つけられない時
        if ( ! $post = Model_Commodity::find($id,array('related' => 'stock')))
        {
            // エラーメッセージをセット
            Session::set_flash('エラー', '商品が見つかりません');
            // トップページへ戻す
            Response::redirect('sakana/index');
        }

        // 保存されているデータの呼び出し
        $data['name'] = $post['name'];
        $data['cost'] = $post['cost'];
        $data['price'] = $post['price'];
        $data['number'] = $post['stock']['number'];

        // model/post.phpで定義された、validatieメソッド実行
        // validationオブジェクトを$valに代入
        $val1 = Model_Commodity::validate('edit1');

        // validationチェックしてOKだった場合
        if ($val1->run())
        {
            $val2 = Model_Stock::validate('edit2');

            if ($val2->run()) {
                try
                {
                    // 入力データを$postに格納する
                    $post['name'] = Input::post('name');
                    $post['cost'] = Input::post('cost');
                    $post['price'] = Input::post('price');
                    $post->stock->number = Input::post('number');

                    // $postの保存成功
                    if ($post->save())
                    {
                        //成功メッセージをセット
                        Session::set_flash('変更しました');

                        // トップページへ戻る
                        Response::redirect('sakana/index');
                    } // $postの保存失敗
                    else Session::set_flash('エラー', '変更に失敗しました'); // エラーメッセージをセット

                }
                catch (PhpErrorException $e)
                {
                    $commodity = Model_Commodity::find('all');
                    $commodity->name = Input::post('name');
                    $commodity->cost = Input::post('cost');
                    $commodity->price = Input::post('price');
                    $stock = Model_Stock::forge(array(
                        'number' => $post['number'],
                        'commodity_id' => $post['id']
                    ));

                    if ($commodity->save() && $stock->save())
                    {
                        //成功メッセージをセット
                        Session::set_flash('変更しました');

                        // トップページへ戻る
                        Response::redirect('sakana/index');

                    }
                    else Session::set_flash('エラー', '変更に失敗しました'); // エラーメッセージをセット
                }
            }
            else Session::set_flash('error', $val2->error()); // validエラーのメッセージをセットする
        }

        // validationでエラーが出たとき
        else
        {
            // postデータが送られた場合
            if (Input::method() == 'POST')
            {
                // validationチェックしてOKのフィールドは,$postへ保存する
                // validエラーのものは保存されない
                $post->name = $val1->validated('name');
                $post->cost = $val1->validated('cost');
                $post->price = $val1->validated('price');

                // validエラーのメッセージをセットする
                Session::set_flash('error', $val1->error());
            }
        }

        $data["subnav"] = array('reservation'=> 'active' );
        $this->template->title = 'Sakana &raquo; 商品編集';
        $this->template->content = View::forge('sakana/edit', $data);
        $this->template->content = View::forge('sakana/_form', $data);
        $this->template->nav = View::forge('template/nav', $data);
    }

    // 投稿削除
    public function action_delete($id = null)
    {
        // URLに記事idが含まれていない時、トップページへ
        is_null($id) and Response::redirect('sakana/index');

        // 記事idが見つかった時
        if ($post = Model_Commodity::find($id))
        {
            // 該当記事を削除する
            $post->delete();
            // 削除に成功したメッセージをセット
            Session::set_flash('削除しました');
        }

        // 記事idのデータがモデルから見つからない
        else
        {
            // エラーメッセージをセット
            Session::set_flash('エラー', '商品を削除できませんでした');
        }
        // トップページへ戻す
        Response::redirect('sakana/index');
    }
}
