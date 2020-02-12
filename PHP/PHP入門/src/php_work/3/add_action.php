<?php
// データベースに接続
$dsn = 'sqlite:../work.db';
$dbh = new PDO($dsn);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// レコードを追加するSQL文
$sql = '';
$sql .= 'insert into users (';
$sql .= 'name,';
$sql .= 'email,';
$sql .= 'password,';
$sql .= 'gender,';
$sql .= 'is_admin,';
$sql .= 'pref,';
$sql .= 'tel';
$sql .= ') values (';
$sql .= ':name,';
$sql .= ':email,';
$sql .= ':password,';
$sql .= ':gender,';
$sql .= ':is_admin,';
$sql .= ':pref,';
$sql .= ':tel';
$sql .= ')';

// SQLを実行する準備
$stmt = $dbh->prepare($sql);

// SQL文のパラメーターに値を割り当てる
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
// echo '<pre>';
// var_dump($stmt);
// echo '</pre>';
// SQL文を実行
$stmt->execute();
// echo '<pre>';
// $stmt->debugDumpParams();
// echo '</pre>';

// echo '<pre>';
// var_dump(PDO::errorCode());
// echo '</pre>';
// トップページへリダイレクト
// header('Location: ./');
