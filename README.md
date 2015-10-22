<<<<<<< HEAD
# sakana
ひろじゅうのばあちゃんの鮮魚店の予約システム

# 使用言語
PHP5.6

# 使用フレームワーク
FUELPHP1.7.3

# フロントフレームワーク
bootstrap v3.3.5

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
  - 魚名は必ずカタカナ（バリデーションではじく）

* 予約修正画面
  - 登録済みの予約を修正できる

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
=======
#FuelPHP

* Version: 1.7.2
* [Website](http://fuelphp.com/)
* [Release Documentation](http://docs.fuelphp.com)
* [Release API browser](http://api.fuelphp.com)
* [Development branch Documentation](http://dev-docs.fuelphp.com)
* [Development branch API browser](http://dev-api.fuelphp.com)
* [Support Forum](http://fuelphp.com/forums) for comments, discussion and community support

## Description

FuelPHP is a fast, lightweight PHP 5.3 framework. In an age where frameworks are a dime a dozen, We believe that FuelPHP will stand out in the crowd.  It will do this by combining all the things you love about the great frameworks out there, while getting rid of the bad.

## More information

For more detailed information, see the [development wiki](https://github.com/fuelphp/fuelphp/wiki).

##Development Team

* Harro Verton - Project Manager, Developer ([http://wanwizard.eu/](http://wanwizard.eu/))
* Frank de Jonge - Developer ([http://frenky.net/](http://frenky.net/))
* Steve West - Developer

### Want to join?

The FuelPHP development team is always looking for new team members, who are willing
to help lift the framework to the next level, and have the commitment to not only
produce awesome code, but also great documentation, and support to our users.

You can not apply for membership. Start by sending in pull-requests, work on outstanding
feature requests or bugs, and become active in the #fuelphp IRC channel. If your skills
are up to scratch, we will notice you, and will ask you to become a team member.

### Alumni

* Jelmer Schreuder - Developer ([http://jelmerschreuder.nl/](http://jelmerschreuder.nl/))
* Phil Sturgeon - Developer ([http://philsturgeon.co.uk](http://philsturgeon.co.uk))
* Dan Horrigan - Founder, Developer ([http://dhorrigan.com](http://dhorrigan.com))
>>>>>>> 342f7079bdef0216516c68aeeb91b88e44f62a78
