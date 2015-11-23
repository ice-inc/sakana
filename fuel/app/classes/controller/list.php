<?php

class Controller_List extends Controller_Template
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

    public function action_index($date = null)
    {
        $data = array();
        // タイムスタンプをフォーマット
        $now = Date::forge($date)->format('%Y/%m/%d');

        // 表示されている日付の前後の日付を計算
        $data['next'] = strtotime('+1 days', $date);
        $data['before'] = strtotime('-1 days', $date);

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
        $data['formatted_date'] = Date::forge($date)->format('%Y年%m月');
        $data['day_of_month'] = Date::forge($date)->format('%d日');
        $data['date'] = Date::forge()->get_timestamp();


        $data["subnav"] = array('list'=> 'active' );
        $this->template->title = 'Sakana &raquo; 予約一覧';
        $this->template->content = View::forge('list/index', $data);
        $this->template->nav = View::forge('template/nav', $data);
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
        $this->template->nav = View::forge('template/nav', $data);
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

    public function action_ranking($day, $month, $year)
    {
        $data = array();

        $formatted_day = date("Y/m/d", $day) . "\n";
        $formatted_month = Date::forge($month)->format('%Y/%m');
        $formatted_year = Date::forge($year)->format('%Y');

        // 日時の計算
        $data['next_day'] = strtotime('+1 days', $day);
        $data['before_day'] = strtotime('-1 days', $day);
        $data['next_month'] = strtotime('+1 month', $month);
        $data['before_month'] = strtotime('-1 month', $month);
        $data['next_year'] = strtotime('+1 year', $year);
        $data['before_year'] = strtotime('-1 year', $year);

        // 日別に一致したデータを集計
        $data['result_daily'] = DB::query(
            "SELECT commodities.name, date, sum(number) AS sum_number, sum(order_children.price) AS sales
            FROM `order_children`
            INNER JOIN commodities ON commodity_id = commodities.id
            WHERE order_children.date = '$formatted_day'
            GROUP BY commodity_id
            ORDER BY sum_number DESC"
        )->execute()->as_array();

        // 月別にデータ集計
        $data['result_monthly'] = DB::query(
            "SELECT commodities.name, sum(number) AS sum_number, sum(order_children.price) AS sales
            FROM `order_children` INNER JOIN commodities ON commodity_id = commodities.id
            WHERE DATE_FORMAT(date, '%Y/%m') = '$formatted_month'
            GROUP BY commodity_id
            ORDER BY sum_number DESC"
        )->execute()->as_array();

        // 年別にデータ集計
        $data['result_yearly'] = DB::query(
            "SELECT commodities.name, sum(number) AS sum_number, sum(order_children.price) AS sales
            FROM `order_children`
            INNER JOIN commodities ON commodity_id = commodities.id
            WHERE DATE_FORMAT(date, '%Y') = '$formatted_year'
            GROUP BY commodity_id
            ORDER BY sum_number DESC"
        )->execute()->as_array();

        $data['date'] = Date::forge()->get_timestamp();
        $data['day'] = $day;
        $data['month'] = $month;
        $data['year'] = $year;
        $data['daily'] = Date::forge($day)->format('%Y年%m月%d日');
        $data['monthly'] = Date::forge($month)->format('%Y年%m月');
        $data['yearly'] = Date::forge($year)->format('%Y年');

        $data["subnav"] = array('ranking'=> 'active' );
        $this->template->title = 'Sakana &raquo; 予約ランキング';
        $this->template->content = View::forge('list/ranking', $data);
        $this->template->nav = View::forge('template/nav', $data);
    }

    public function action_daily_earn($date)
    {
        $data = array();

        $data['date'] = Date::forge()->get_timestamp();
        $data['month'] = Date::forge($date)->format('%m');

        $year = Date::forge($date)->format('%Y');
        $year_next = $year + 1;
        $month = Date::forge($date)->format('%Y-%m');
        // 月初と月末の日付を取得
        $first_date = date('Y-m-d', strtotime('first day of'. $month));
        $last_date = date('Y-m-d', strtotime('last day of'. $month));
        // 前年の月初と月末の日付を取得
        $first_date2 = date('Y-m-d', strtotime("$first_date -1 year"));
        $last_date2 = date('Y-m-d', strtotime("$last_date -1 year"));

        // テーブルを選択
        $query = DB::query("SELECT * FROM mst_digit");
        $data['query'] = $query->execute();

        // nullの場合、データをセットしビューを生成
        if($query->execute() == null)
        {
            for($i = 0; $i < 10; $i++){
                DB::query("INSERT INTO mst_digit (digit) VALUES ('$i')")->execute();
            }
            DB::query(
                "CREATE VIEW `vw_sequence99` AS
                SELECT (`d1`.`digit` + (`d2`.`digit` * 10)) AS `Number`
                FROM (`mst_digit` `d1` join `mst_digit` `d2`);"
            )->execute();
        }

        // 今年と前年の月初めから月までの日付を持った売上テーブルを生成
        $data['daily'] = DB::query(
            "SELECT ADDDATE('$first_date', V.Number) as date,
                IFNULL(Sum(O1.`price`),0) as sales,
                ADDDATE('$first_date2', V.Number) as last_date,
                IFNULL(Sum(O2.`price`),0) as last_sales,
                Sum(O1.`price`) / Sum(O2.`price`) * 100 as year_on_year,
                COUNT(DISTINCT O1.orders_id) as number_of_guest,
                COUNT(DISTINCT O2.orders_id) as number_of_guest2,
                IFNULL(Sum(O1.`number`),0) as total_item,
                IFNULL(sum(O1.price)/COUNT(DISTINCT O1.orders_id),0) as average,
                IFNULL(Sum(O1.`number`)/COUNT(DISTINCT O1.orders_id),0) as average2
                FROM vw_sequence99 as V
                LEFT JOIN order_children as O1
                ON ADDDATE('$first_date', V.Number) = DATE(O1.`date`)
                LEFT JOIN order_children as O2
                ON ADDDATE('$first_date2', V.Number) = DATE(O2.`date`)
                WHERE ADDDATE('$first_date', V.Number) BETWEEN '$first_date' AND '$last_date'
                GROUP BY ADDDATE('$first_date', V.Number)"
        )->execute()->as_array();

        // 表示されている日付の前後の月を計算
        $data['next'] = strtotime('+1 month', $date);
        $data['before'] = strtotime('-1 month', $date);
        $data['this_date'] = $date;

        $data["subnav"] = array('earn'=> 'active' );
        $this->template->title = 'Sakana &raquo; 売り上げ';
        $this->template->content = View::forge('list/daily_earn', $data);
        $this->template->nav = View::forge('template/nav', $data);
    }
    
    public function action_monthly_earn($date)
    {
        $data = array();

        $data['date'] = Date::forge()->get_timestamp();

        $year = Date::forge($date)->format('%Y');
        $year_next = $year + 1;

        // テーブルを選択
        $query = DB::query("SELECT * FROM mst_digit");
        $data['query'] = $query->execute();

        // nullの場合、データをセットしビューを生成
        if($query->execute() == null)
        {
            for($i = 0; $i < 10; $i++){
                DB::query("INSERT INTO mst_digit (digit) VALUES ('$i')")->execute();
            }
            DB::query(
                "CREATE VIEW `vw_sequence99` AS
                SELECT (`d1`.`digit` + (`d2`.`digit` * 10)) AS `Number`
                FROM (`mst_digit` `d1` join `mst_digit` `d2`);"
            )->execute();
        }

        // 月ごとの売上累計
        $data['monthly'] = DB::query(
            "SELECT DATE_FORMAT(date, '%Y-%m') AS date, 
            sum(number) AS sum_number, 
            sum(order_children.price) AS sales,
            COUNT(DISTINCT orders_id) as number_of_guest
            FROM `order_children`
            WHERE DATE_FORMAT(date, '%Y-%m') BETWEEN '$year-01' AND '$year-12'
            GROUP BY DATE_FORMAT(date, '%Y-%m')
            ORDER BY DATE_FORMAT(date, '%Y-%m') ASC"
        )->execute()->as_array();
        
        // 表示されている日付の前後の日付を計算
        $data['next'] = strtotime('+1 year', $date);
        $data['before'] = strtotime('-1 year', $date);
        $data['this_date'] = $date;

        $data["subnav"] = array('earn'=> 'active' );
        $this->template->title = 'Sakana &raquo; 売り上げ';
        $this->template->content = View::forge('list/monthly_earn', $data);
        $this->template->nav = View::forge('template/nav', $data);
    }
    
    public function action_yearly_earn()
    {
        $data = array();

        $data['date'] = Date::forge()->get_timestamp();

        // テーブルを選択
        $query = DB::query("SELECT * FROM mst_digit");
        $data['query'] = $query->execute();

        // nullの場合、データをセットしビューを生成
        if($query->execute() == null)
        {
            for($i = 0; $i < 10; $i++){
                DB::query("INSERT INTO mst_digit (digit) VALUES ('$i')")->execute();
            }
            DB::query(
                "CREATE VIEW `vw_sequence99` AS
                SELECT (`d1`.`digit` + (`d2`.`digit` * 10)) AS `Number`
                FROM (`mst_digit` `d1` join `mst_digit` `d2`);"
            )->execute();
        }

        // 年ごとの売上累計
        $data['yearly'] = DB::query(
            "SELECT DATE_FORMAT(date, '%Y') AS date, 
            sum(number) AS sum_number, 
            sum(order_children.price) AS sales,
            COUNT(DISTINCT orders_id) as number_of_guest
            FROM `order_children`
            WHERE DATE_FORMAT(date, '%Y') BETWEEN '2015' AND '2030'
            GROUP BY DATE_FORMAT(date, '%Y')
            ORDER BY DATE_FORMAT(date, '%Y') ASC"
        )->execute()->as_array();

        $data["subnav"] = array('earn'=> 'active' );
        $this->template->title = 'Sakana &raquo; 売り上げ';
        $this->template->content = View::forge('list/yearly_earn', $data);
        $this->template->nav = View::forge('template/nav', $data);
    }
}
