<?php

class Controller_List extends Controller_Template
{
    public function action_index()
    {
        $data = array();

        // POSTモデルから、全データを取得してビューに渡すための配列に入れる
        $data['client'] = Model_Client::find('all', array(
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
        ));

        // Dateをフォーマットして代入
        $data['date'] = Date::time()->format('%Y年%m月');
        $data['day_of_month'] = Date::time()->format('%d日');

        $data["subnav"] = array('list'=> 'active' );
        $this->template->title = 'Sakana &raquo; 予約一覧';
        $this->template->content = View::forge('list/index', $data);
    }

    public function action_edit($id=null)
    {
        $data["subnav"] = array('list'=> 'active' );
        $this->template->title = 'Sakana &raquo; 予約編集';
        $this->template->content = View::forge('list/edit', $data);
    }
    
    public function action_complete($id=null)
    {

    }
}