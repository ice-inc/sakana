<?php

class Controller_Email extends Controller
{
    public function action_email()
    {
        $email = \Email::forge('jis');
        // 送信元アドレスと送信者名
        $email->from('送信元アドレス', '送信者名');
        // 送信先アドレス
        $email->to('送信先アドレス');
        // 件名
        $email->subject('件名');
        // viewの内容が本文内容として書かれる
        $body = \View::forge('email/sample', $data);
        // 本文をエンコード
        $email->body(mb_convert_encoding($body, 'jis'));

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

    }
}