<?php

class Controller_Email extends Controller
{
    public function action_email()
    {
        $now = Date::forge();
        $date = Date::forge(strtotime(strftime('%Y%m%d', strtotime($now. '+1 days'))))->format('%Y/%m/%d');

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
                        array('date', '=', $date),
                    ),
                ),
            ),
        ));


        // 文字コード指定
        $email = Email::forge('jis');
        // 送信元アドレスと送信者名
        $email->from('hiranakaken@server.world', 'mail.server.world');
        // 送信先アドレス
        $email->to('');
        // 件名
        $email->subject('明日の予約一覧');
        // viewの内容が本文として書かれる
        $email->html_body(\View::forge('email/email', $data));
        // 本文をエンコード
        //$email->html_body(mb_convert_encoding($body, 'jis'));

        try
        {
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

        //$this->template->title = 'Sakana &raquo; 明日の予約';
        //$this->template->content = View::forge('email/email', $data);
    }
}
