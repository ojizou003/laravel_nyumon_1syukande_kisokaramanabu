# 「1週間で！基礎から学ぶ Laravel入門」 Minatomi著

2023/09/06~09/08

## 第一部 基礎編～CRUDをマスターしよう～

- Laravelは、PHPをベースに作られてたWebサービスを作るためのフレームワーク
- フレームワークのイメージは更地の街
- 本書の目的：街ではなく1軒の家(家計簿アプリ)を作る
- CRUDにフォーカス
  - create
  - read
  - update
  - delete
- 脳は新しい概念や用語を理解するのに、6回の見聞きが必要
- 環境構築(cloud9)
- cloud9 ..AWSに取り込まれた
- MVCモデル ..プログラムを書くときに、プログラムの役割をはっきりと分けようとういう考え方のひとつ
  - M ..データそのもの(データベース)を表すモデル
  - V ..画面上に表示されるものを表すビュー
  - C ..MやVの使い分けをするコントローラ
- [第一部コード](https://github.com/suotani/laravel-kakeibo/tree/Part1)

- Laravelのインストール
- $ php --version -> PHP 7.2.24
- 追加ライブラリのインストール
  - $ sudo yum install -y php-mbstring php-openssl php-xml unzip
- composerのインストール
  - $ php -r"copy('https://getcomposer.org/installer','composer-setup.php');"
  - $ sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
- composerを使ってLaravelをインストールしつつ、アプリケーションのひな型を作成
  - $ composer create-project --prefer-dist laravel/laravel kakeibo "5.8.*"

- フォルダ構成
  - 開発で主に触るのは、app,database,resources,routes

- サーバーの動作確認
  - $ php artisan serve --port=8080
  - Ctrl+C ..サーバーの停止

- データベース設定の変更
  - DB_CONNECTION=mysql -> sqlite 、その下の5行(データベースの設定)を削除

- モデルの作成
  - モデルとは、データベースと連携するクラス
  - Bookという名前のモデル(クラス)を作成
    - $ php artisan make:model -m Book

- テーブル設計（マイグレーションファイルの書き換え）

- データベースの作成
  - データベース専用のターミナルの起動
    - $ sqlite3 database/database.sqlite
    - .tables
    - .exit
    - $ php artisan migrate

- 初期データの入力
  - seederファイルの作成
    - $ php artisan make:seeder BooksTableSeeder
  - seederの実行
    - $ php artisan db:seed

- index画面の作成
  - ルーティングファイルの作成
    - ルーティングファイル ..routes/web.php
  - コントローラの作成
    - $ php artisan make:controller BookController
  - ルーティングの確認
    - $ php artisan route:list

- ビューの作成
  - ビューファイルを入れるためのフォルダを作成

- BootStrapで見栄えを整える
  - BootStrapを読み込むためにレイアウトファイルを作成
  - @yield ..別のファイルを埋め込むための記述

- Show
- 参照画面の作成

- Create
- データを画面から登録できるようにする
  - 1. データ入力用のcreate画面の作成
  - 2. 画面から送られてきたデータをデータベースへ登録する処理の記述

- Edit
- 登録したデータを更新(別の値で上書き)

- Update
- 編集画面で編集した内容をサーバーへ送信し、データベースを更新

- Destroy
- データの削除

## 第二部 実践編～実務に近いコードを書こう～

- 第一部で作成した家計簿アプリに対し、
  - カラムの追加
  - selectタグを簡潔に書く
  - fillableを使う

- メモカラムの追加
  - 更新マイグレーションファイルの作成
  - コントローラ、ビューの編集

- selectのプログラム化
  - カテゴリで選択できる対象を配列としてモデル(app\Book.php)へ記述

- fillable
  - fillableは、モデルに書く変数で、入力された値に対して、事前に許可するカラム名を書いておくことで、一つずつ値をインスタンスへ入力していかなくても済むようになる

## 第三部 応用編～ログイン機能をつけよう～

- 会員登録とログイン機能の実装
  ✕ ``` $php artisan make:auth ``` 
  〇 ``` php artisan ui vue --auth ```
  -> ログイン画面とルーティングが自動的に作られる

- 関連付け
  - 自分の登録したデータしか表示しないようにする
    - Bookテーブルへuser_idカラムを追加
    - 家計簿データ登録時にuser_idカラムも登録
    - 自分のbookデータのみ一覧や詳細を表示する
    - 自分が登録したデータ以外の更新や削除を行えないようにする

- user_idカラムの追加
  - マイグレーションファイルの作成と実行

- 家計簿データ登録時にuser_idがuser_idカラムに登録されるようにする

- データ参照の制限

- データ更新の制限
  - 自分の家計簿データ以外のデータを見ようとすると一覧画面にリダイレクトさせる