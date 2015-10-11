# sakana
ひろじゅうのばあちゃんの鮮魚店の予約システム

# 使用言語
PHP5.6

# 使用フレームワーク
FUELPHP1.7.3

# 目的
現状だとお客さんからの予約注文を紙ベースで管理している。
○月×日に取り寄せないといけない商品を予め整理して一度に買い付けに行くが、整理の段階で漏れが発生してしまうことがあるため、人間の手作業による整理ミスを無くしたい
また、魚の値段と注文数をもとに予約商品の月別代金合計や、年間別、月別売り上げランキングを表示させたい

# 要件
* ユーザは管理者のみ

* 管理者追加機能
  - メールアドレス、名前、電話番号
* ログイン機能

* トップページ
  - ログイン後は当日の日付とその日の予約商品一覧が表示される（トップページ）

* 予約画面
  - 日付、商品名、原価、定価、個数を入力する（複数入力可能）
  - ページ下部に合計金額を表示

* メール機能
  - 予約日前日の17時に管理者に予約商品の一覧をメールで送信する

* 売上画面
  - 月別、年別の売上合計が表示できる（ページ別）
  - 合計額はページ最上部に表示
  - 魚毎の合計を降順表示

* 予約ランキング画面
  - 月別、年別の予約数合計が表示できる（ページ別）
  - 予約合計はページ最上部に表示
  - 魚毎の予約合計を降順表示