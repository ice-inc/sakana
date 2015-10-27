<?php

class Controller_Sakana extends Controller_Template
{

	public function action_index()
	{
		// POSTモデルから、全データを取得してビューに渡すための配列に入れる
		$data['commodity'] = Model_Commodity::find('all');
		// ビューテンプレート
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Sakana &raquo; 商品一覧';
		$this->template->content = View::forge('sakana/index', $data);
	}

	public function action_create()
	{
		// 投稿ボタンが押され、postされたとき
		if (Input::method() == 'POST')
		{
			// model/post.phpで定義されたvalidateメソッド実行
			// validateオブジェクトを$valに代入
			$val = Model_Commodity::validate('create');

			if ($val->run())
			{
				// 各POSTデータをモデルオブジェクトとして、$postに代入
				$post = Model_Commodity::forge(array(
					'name' => Input::post('name'),
					'cost' => Input::post('cost'),
					'price' => Input::post('price'),
				));

					// 各POSTデータの保存に成功した時
				if ($post and $post->save())
				{
					// 成功したメッセージをフラッシュセッションに入れる
					Session::set_flash('データの登録に成功しました');
					// TOPページへリダイレクト
					Response::redirect('sakana/index');
				}

				// 各POSTデータの保存失敗時
				else
				{
				// エラーメッセージをフラッシュセッションに入れる
				Session::set_flash('エラー', 'データの保存に失敗しました');
				}
			}
			// validationエラーが出たとき
			else
			{
				// validationエラーのメッセージをセットする
				Session::set_flash('error', $val->error());
			}
		}

		// ビューテンプレート呼び出し
		$data["subnav"] = array('create' => 'active' );
		$this->template->title = 'Sakana &raquo; 商品登録';
		$this->template->content = View::forge('sakana/create', $data);
	}

	public function action_edit($id=null)
	{
		$data = array();

		// URLに記事idが含まれていない時、トップページへ戻す
		is_null($id) and Response::redirect('sakana/index');

		// 記事idのデータがモデルから見つけられない時
		if ( ! $post = Model_Commodity::find($id))
		{
			// エラーメッセージをセット
			Session::set_flash('エラー', '商品が見つかりません');
			// トップページへ戻す
			Response::redirect('sakana/index');
		}

		// 保存されているデータの呼び出し
		$data['name'] = $post->name;
		$data['cost'] = $post->cost;
		$data['price'] = $post->price;

		// model/post.phpで定義された、validatieメソッド実行
		// validationオブジェクトを$valに代入
		$val = Model_Commodity::validate('edit');

		// validationチェックしてOKだった場合
		if ($val->run())
		{
			// 入力データを$postに格納する
			$post->name = Input::post('name');
			$post->cost = Input::post('cost');
			$post->price = Input::post('price');

			// $postの保存成功
			if ($post->save())
			{
				//成功メッセージをセット
				Session::set_flash('変更しました');

				// トップページへ戻る
				Response::redirect('sakana/index');
			}

			// $postの保存失敗
			else
			{
				// エラーメッセージをセット
				Session::set_flash('エラー', '変更に失敗しました');
			}
		}

			// validationでエラーが出たとき
		else
		{
			// postデータが送られた場合
			if (Input::method() == 'POST')
			{
				// validationチェックしてOKのフィールドは,$postへ保存する
				// validエラーのものは保存されない
				$post->name = $val->validated('name');
				$post->cost = $val->validated('cost');
				$post->price = $val->validated('price');

				// validエラーのメッセージをセットする
				Session::set_flash('error', $val->error());
			}

			// 複数のビューに$postを渡せるようにset_globalで、ビューを呼び出す
			$this->template->set_global('sakana', $post, false);
		}
		$data["subnav"] = array('reservation'=> 'active' );
		$this->template->title = 'Sakana &raquo; 商品編集';
		$this->template->content = View::forge('sakana/edit', $data);
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

	public function action_reservation()
	{
		// Commodityモデルから、全データを取得してビューに渡すための配列に入れる
		$data['commodity'] = Model_Commodity::find('all');

		// validationをチェック
		$client_val = Model_Client::validate('reservation');
		//$order_val = Model_Order::validate('reservation');

		// validationがOKだった場合
		if ($client_val->run() and $order_val->run())
		{
			// 各POSTデータをモデルオブジェクトとして、$postに代入
			$post = Model_Client::forge(array(
				'first_name' => Input::post('first_name'),
				'last_name' => Input::post('last_name'),
				'tell' => Input::post('tell'),
				'email' => Input::post('email'),
			));

				// 各POSTデータの保存に成功した時
			if ($post and $post->save())
			{
				// 成功したメッセージをフラッシュセッションに入れる
				Session::set_flash('予約しました');
				// TOPページへリダイレクト
				Response::redirect('sakana/resarvation');
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
			//Session::set_flash('error', $val->error());
		}

		$data["subnav"] = array('reservation'=> 'active' );
		$this->template->title = 'Sakana &raquo; 商品予約';
		$this->template->content = View::forge('sakana/reservation', $data);
	}

	public function action_signin()
	{
		$data["subnav"] = array('signin'=> 'active' );
		$this->template->title = 'Sakana &raquo; ログイン';
		$this->template->content = View::forge('sakana/signin', $data);
	}

	public function action_signup()
	{
		$data["subnav"] = array('signup'=> 'active' );
		$this->template->title = 'Sakana &raquo; 新規登録';
		$this->template->content = View::forge('sakana/signup', $data);
	}
}
