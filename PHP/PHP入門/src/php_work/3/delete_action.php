<?php
// データベースに接続
$dsn = 'sqlite:../work.db';
$dbh = new PDO($dsn);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// レコードを追加するSQL文
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
