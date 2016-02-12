<?php

class Controller_Email extends Controller
{
    public function action_email()
    {
        $now = Date::forge()->get_timestamp();
        $date = strtotime('+1 days', $now);
        $data['tomorrow'] = Date::forge($date)->format('%Y/%m/%d');

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
                        array('date', '=', $data['tomorrow']),
                    ),
                ),
            ),
        ));

        // 明日の予約分の合計を取得
        $data['total'] = DB::select(
            array('C.name', 'name'),
            array(DB::expr('SUM(O.number)'), 'number'),
            array(DB::expr('SUM(O.cost)'), 'cost'),
            array(DB::expr('SUM(O.price)'), 'price')
        )
            ->from(array('order_children', 'O'))
            ->join(array('commodities', 'C'), 'left')
            ->on('O.commodity_id', '=', 'C.id')
            ->where('date', '=', $data['tomorrow'])
            ->group_by('commodity_id')
            ->execute()->as_array();

        $user_email = Auth::get('email');
        $user_name = Auth::get('username');
        // 文字コード指定
        $email = Email::forge('jis');
        // 送信元アドレスと送信者名
        $email->from($user_email, $user_name);
        // 送信先アドレス
        $email->to($user_email, $user_name);
        // 件名
        $email->subject('明日の予約一覧');
        // viewの内容が本文として書かれる
        $email->html_body(\View::forge('email/email', $data));

        try
        {
            // メール送信
            $email->send();
        }
        catch (\EmailValidationFailedException $e)
        {
            $err_msg = '送信に失敗しました。';
        }
        catch (\EmailSendingFailedException $e)
        {
            $err_msg = '送信に失敗しました。';
        }

        $data['date'] = $now;
        $data["subnav"] = array('email'=> 'active' );
        \Response::redirect_back();

        return View::forge('email/email', $data);
    }
}
