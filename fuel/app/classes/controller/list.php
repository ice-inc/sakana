<?php

class Controller_List extends Controller_Template
{   
    public function before()
    {
        // この行がないと、テンプレートが動作しない!
        parent::before();
        
        //未ログインの場合、ログインページへリダイレクト
        if(!Auth::check()){
            Response::redirect('user/login');
        }
    }
    
    public function action_index($date = null)
    {
        $data = array();
        // タイムスタンプをフォーマット
        $now = Date::forge($date)->format('%Y/%m/%d');
        
        // 表示されている日付の前後の日付を計算し、タイムスタンプに変換して代入
        $data['next'] = strtotime(strftime('%Y%m%d', strtotime($now. '+1 days')));
        $data['before'] = strtotime(strftime('%Y%m%d', strtotime($now. '-1 days')));
            
        // POSTモデルから、全データを取得してビューに渡すための配列に入れる
        $data['client'] = Model_Client::find('all', array(
            'related' => array(
                'order' => array(
                    'related' => array(
                        'order_child' => array(
                            'related' => array('commodity'),
                        ),
                    ),
                    'where' => array(
                        array('date', '=', $now), 
                    ),
                ),
            ),
        ));

        // Dateをフォーマットして代入
        $data['date'] = Date::forge($date)->format('%Y年%m月');
        $data['day_of_month'] = Date::forge($date)->format('%d日');

        $data["subnav"] = array('list'=> 'active' );
        $this->template->title = 'Sakana &raquo; 予約一覧';
        $this->template->content = View::forge('list/index', $data);
    }
    

    public function action_edit($id=null)
    {
        $data = array();
        $data['date'] = Date::forge()->get_timestamp();
        
        // URLに記事idが含まれていない時、トップページへ戻す
        is_null($id) and Response::redirect('list/index');
        
        // 記事idのデータがモデルから見つけられない時
        if ( ! $post = Model_Client::find($id, array(
            'related' => array(
                'order' => array(
                    'related' => array(
                        'order_child' => array(
                            'related' => array('commodity'),
                        ),
                    ),
                    'order_by' => array(
                        'date' => 'desc',
                    ),
                ),
            ),
        )))
        {
            // エラーメッセージをセット
            Session::set_flash('エラー', 'データが見つかりません');
            // トップページへ戻す
            Response::redirect('list/index');
        }
        
        $data['post'] = $post;
        
        // model/post.phpで定義された、validatieメソッド実行
        // validationオブジェクトを$valに代入
        $val_client = Model_Client::validate('edit');

        // validationチェックしてOKだった場合
        if ($val_client->run())
        {
            // 入力データを$postに格納する
            $post->first_name = Input::post('first_name');
            $post->last_name = Input::post('last_name');
            $post->tell = Input::post('tell');
            $post->email = Input::post('email');

            // validatieメソッド実行
            // validationオブジェクトを$valに代入
            $val_child = Model_Order_Child::validate('edit2');

            // validationチェックしてOKだった場合
            if($val_child->run($post['order_child']))
            {
                $sum_num = 0;
                $sum_cost = 0;
                $sum_price = 0;

                // POSTされたデータを$order_childに代入
                $child = Input::post('order_child');

                // それぞれの合計値を求める
                foreach ($child as $key => $value)
                {
                    $sum_cost += Input::post("order_child.$key.number") * Input::post("order_child.$key.cost");
                    $sum_num += Input::post("order_child.$key.number");
                    $sum_price += Input::post("order_child.$key.number") * Input::post("order_child.$key.price");
                }
                
                // 入力データを$postに格納する
                $post->order->number = $sum_num;
                $post->order->price = $sum_price;
                $post->order->date = Input::post('date');
                
                foreach ($child as $key => $value)
                {
                    // 入力データを$postに格納する
                    $post->order->order_child[$key]->cost = Input::post("order_child.$key.number") * Input::post("order_child.$key.cost");
                    $post->order->order_child[$key]->number = Input::post("order_child.$key.number");
                    $post->order->order_child[$key]->price = Input::post("order_child.$key.number") * Input::post("order_child.$key.price");
                    $post->order->order_child[$key]->date = Input::post('date');
                }
                
                // $postの保存成功
                if ($post->save())
                {
                    //成功メッセージをセット
                    Session::set_flash('変更しました');

                    // トップページへ戻る
                    Response::redirect('list/index');
                }

                // $postの保存失敗
                else
                {
                    // エラーメッセージをセット
                    Session::set_flash('エラー', '変更に失敗しました');
                }
            }
            
            // validationエラーが出たとき
            else
            {
                // validationエラーのメッセージをセットする
                Session::set_flash('error', $val_child->error());
            }

            
        }

        // validationでエラーが出たとき
        else
        {
            // validationエラーのメッセージをセットする
            Session::set_flash('error', $val_client->error());
        }
        
        $data["subnav"] = array('list'=> 'active' );
        $this->template->title = 'Sakana &raquo; 予約編集';
        $this->template->content = View::forge('list/edit', $data);
    }
    
    public function action_complete($id=null)
    {
        // URLに記事idが含まれていない時、トップページへ
        is_null($id) and Response::redirect('list/index');
        // 記事idが見つかった時
        if ($post = Model_Client::find($id, array(
            'related' => array(
                'order' => array(
                    'related' => array(
                        'order_child' => array(
                            'related' => array('commodity'),
                        ),
                    ),
                    'order_by' => array(
                        'date' => 'desc',
                    ),
                ),
            ),
        )))
        {
            // 該当記事を削除する
            $post->delete();
            // 削除に成功したメッセージをセット
            Session::set_flash('完了しました');
        }

        // 記事idのデータがモデルから見つからない
        else
        {
            // エラーメッセージをセット
            Session::set_flash('エラー', '完了できませんでした');
        }
        // トップページへ戻す
        Response::redirect('list/index');
    }
    
    public function action_ranking()
    {
        $data['date'] = Date::forge()->get_timestamp();

        $data["subnav"] = array('ranking'=> 'active' );
        $this->template->title = 'Sakana &raquo; 予約ランキング';
        $this->template->content = View::forge('list/ranking', $data);
    }
    
    public function action_earn()
    {
        $data['date'] = Date::forge()->get_timestamp();

        $data["subnav"] = array('earn'=> 'active' );
        $this->template->title = 'Sakana &raquo; 売り上げ';
        $this->template->content = View::forge('list/earn', $data);
    }
}