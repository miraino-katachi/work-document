<?php
// セッションを有効にする
session_start();
// リクエストごとにセッションIDを切り替える
session_regenerate_id(true);

// セッションにログインユーザー徐情報がない場合、ログインページへリダイレクトする
if (!isset($_SESSION['user'])) {
    header('Location: ./login.php');
    exit;
}

try {
    // データベースに接続するための文字列（DSN・接続文字列）
    $dsn = 'mysql:dbname=php_work;host=localhost;charset=utf8';

    // PDOクラスのインスタンスを作る
    $dbh = new PDO($dsn, 'root', 'root');

    // データベースのエラーを例外としてスローする
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // レコードを削除するSQL文
    $sql = '';
    $sql .= 'delete from users ';
    $sql .= 'where id=:id';

    // SQLを実行する準備
    $stmt = $dbh->prepare($sql);

    // SQL文のパラメーターに値を割り当てる
    $stmt->bindValue(':id', $_POST['id'], PDO::PARAM_INT);

    // SQL文を実行
    $stmt->execute();

    // トップページへリダイレクト
    header('Location: ./');
    exit;
} catch (Exception $e) {
    // エラーページへリダイレクト
    header('Location: ./error.php');
    exit;
}
