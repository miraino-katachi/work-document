<?php
// セッションを有効にする
session_start();
// リクエストごとにセッションIDを切り替える
session_regenerate_id(true);

// データベースに接続するための文字列（DSN・接続文字列）
$dsn = 'mysql:dbname=php_work;host=localhost;charset=utf8';

// PDOクラスのインスタンスを作る
$dbh = new PDO($dsn, 'root', 'root');

// ユーザーを検索するSQL文
$sql = '';
$sql .= 'select * from users ';
$sql .= 'where email=:email ';
$sql .= 'and password=:password';

// SQLを実行する準備
$stmt = $dbh->prepare($sql);

// SQL文のパラメーターに値を割り当てる
$stmt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
$stmt->bindValue(':password', $_POST['password'], PDO::PARAM_STR);

// SQL文を実行
$stmt->execute();

// 実行結果を取り出し、変数に代入
$ret = $stmt->fetch(PDO::FETCH_ASSOC);

// 該当のレコードが存在しないときは、ログインページにリダイレクトする
if (!$ret) {
    $_SESSION['error'] = '該当するユーザーが見つかりません';
    header('Location: ./login.php');
    exit;
}

// 所得したユーザーの情報をセッションに保存する
$_SESSION['user'] = $ret;

// エラーメッセージを削除する
unset($_SESSION['error']);

// トップページへリダイレクト
header('Location: ./');
exit;
