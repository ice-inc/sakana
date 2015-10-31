<?php

class Controller_Order extends Controller_Template
{
    public function action_create()
    {
        $data = array();
        // Commodityモデルから、全データを取得してビューに渡すための配列に入れる
        $data['commodity'] = Model_Commodity::find('all');

        if (Input::method() == 'POST')
        {
            //入力されPOSTされた内容を変数に格納
            $post = Input::post();
            // validationをチェック
            $client_val = Model_Client::validate('create');

            // validationがOKだった場合
            if ($client_val->run())
            {
                // validationをチェック
                $order_child_val = Model_Order_Child::validate('create2');

                // validationがOKだった場合
                if ($order_child_val->run($post['order_child']))
                {

                    // 各POSTデータをモデルオブジェクトとして、$clientに代入
                    $client = Model_Client::forge(array(
                        'first_name' => Input::post('first_name'),
                        'last_name' => Input::post('last_name'),
                        'tell' => Input::post('tell'),
                        'email' => Input::post('email'),
                    ));
                    $order = Model_Order::forge();
                    // 各POSTデータをモデルオブジェクトとして、$orderに代入
                    $client->order = Model_Order::forge(array(
                        'number' => '1',
                        'price' => '1',
                        'date' => Input::post('date'),
                    ));

                    // POSTされたデータを$order_childに代入
                    $order_child = Input::post('order_child');

                    // 配列の値が$valueに代入され、配列のキーが$keyに代入される
                    foreach ($order_child as $key => $value)
                    {
                        // 各POSTデータをモデルオブジェクトとして、$order_childに代入
                        $client->order->order_child[] = Model_Order_Child::forge(array(
                            'commodity_id' => Input::post("order_child.$key.commodity_id"),
                            'cost' => Input::post("order_child.$key.number") * Input::post("order_child.$key.cost"),
                            'number' => Input::post("order_child.$key.number"),
                            'price' => Input::post("order_child.$key.number") * Input::post("order_child.$key.price"),
                            'date' => Input::post('date'),
                        ));
                    }

                    // 各POSTデータの保存に成功した時
                    if ($client and $client->save())
                    {
                        // 成功したメッセージをフラッシュセッションに入れる
                        Session::set_flash('予約しました');
                        // TOPページへリダイレクト
                        Response::redirect('sakana/reservation');
                    }

                    // 各POSTデータの保存失敗時
                    else
                    {
                        // エラーメッセージをフラッシュセッションに入れる
                        Session::set_flash('エラー', '予約に失敗しました');
                    }

                }

                // validationエラーが出たとき
                else
                {
                    // validationエラーのメッセージをセットする
                    Session::set_flash('error', $order_child_val->error());
                }

            }

            // validationエラーが出たとき
            else
            {
                // validationエラーのメッセージをセットする
                Session::set_flash('error', $client_val->error());
            }
        }

        $data["subnav"] = array('create'=> 'active' );
        $this->template->title = 'Sakana &raquo; 商品予約';
        $this->template->content = View::forge('sakana/reservation', $data);
    }

}
