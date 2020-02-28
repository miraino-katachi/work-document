<?php
// データベースに接続するための文字列（DSN・接続文字列）
$dsn = 'mysql:dbname=php_work;host=localhost;charset=utf8';

// PDOクラスのインスタンスを作る
$dbh = new PDO($dsn, 'root', 'root');

// レコードを追加するSQL文
$sql = '';
$sql .= 'update users set ';
$sql .= 'name=:name,';
$sql .= 'email=:email,';
$sql .= 'password=:password,';
$sql .= 'gender=:gender,';
$sql .= 'is_admin=:is_admin,';
$sql .= 'pref=:pref,';
$sql .= 'tel=:tel ';
$sql .= 'where id=:id';

// SQLを実行する準備
$stmt = $dbh->prepare($sql);

// SQL文のパラメーターに値を割り当てる
$stmt->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
$stmt->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
$stmt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
$stmt->bindValue(':password', $_POST['password'], PDO::PARAM_STR);
if (isset($_POST['is_admin']) && $_POST['is_admin'] == 1) {
    $isAdmin = 1;
} else {
    $isAdmin = 0;
}
$stmt->bindValue(':is_admin', $isAdmin, PDO::PARAM_INT);
$stmt->bindValue(':gender', $_POST['gender'], PDO::PARAM_INT);
$stmt->bindValue(':pref', $_POST['pref'], PDO::PARAM_STR);
$stmt->bindValue(':tel', $_POST['tel'], PDO::PARAM_STR);

// SQL文を実行
$stmt->execute();

// トップページへリダイレクト
header('Location: ./');
exit;
