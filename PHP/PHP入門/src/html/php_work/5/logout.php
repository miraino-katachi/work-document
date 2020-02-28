<?php
// セッションを有効にする
session_start();
// リクエストごとにセッションIDを切り替える
session_regenerate_id(true);

// セッションに保存したログインシューザー情報を削除する
unset($_SESSION['user']);

// ログインページへリダイレクト
header('Location: ./login.php');
exit;
