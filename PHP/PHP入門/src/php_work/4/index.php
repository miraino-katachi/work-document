<?php
// セッションを有効にする
session_start();
// リクエストごとにセッションIDを切り替える
session_regenerate_id(true);

// セッションにログインユーザー情報がない場合、ログインページへリダイレクトする
if (!isset($_SESSION['user'])) {
    header('Location: ./login.php');
    exit;
}

// 検索条件
$pref = '';
if (isset($_GET['pref'])) {
    // フォームから送信されたデータがあれば、変数に代入する
    $pref = $_GET['pref'];
}

// データベースに接続
$dsn = 'sqlite:../work.db';
$dbh = new PDO($dsn);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// データを表示するためのSQL文
$sql = 'select * from users';
if ($pref) {
    // フォームから値が送信されたときは、検索条件を追加
    $sql .= ' where pref=:pref';
}

// SQLを実行する準備
$stmt = $dbh->prepare($sql);

if ($pref) {
    // フォームから値が送信されたときは、SQL文の中のパラメータに値を割り当てる
    $stmt->bindValue(':pref', $pref, PDO::PARAM_STR);
}

// SQL文を実行
$stmt->execute();

// 実行結果をすべて取り出し、変数に代入
$list = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>一覧表示</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="./">PHPワーク</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="./">一覧表示 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./add.php">ユーザー追加</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= $_SESSION['user']['name'] ?>さん
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="./logout.php">ログアウト</a>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>

        <form method="get" action="./" class="my-4">
            <div class="form-group">
                <label for="pref">事業所所在地</label>
                <select name="pref" id="pref" class="form-control">
                    <option value="" <?php if ($pref == '') echo ' selected' ?>>全件表示</option>
                    <option value="大阪" <?php if ($pref == '大阪') echo ' selected' ?>>大阪</option>
                    <option value="兵庫" <?php if ($pref == '兵庫') echo ' selected' ?>>兵庫</option>
                    <option value="京都" <?php if ($pref == '京都') echo ' selected' ?>>京都</option>
                    <option value="奈良" <?php if ($pref == '奈良') echo ' selected' ?>>奈良</option>
                    <option value="和歌山" <?php if ($pref == '和歌山') echo ' selected' ?>>和歌山</option>
                </select>
            </div>
            <div class="my-2">
                <input type="submit" value="検索" class="btn btn-primary">
            </div>
        </form>

        <table class="table table-striped table-hover my-3">
            <thead class="bg-primary text-white">
                <tr>
                    <th>id</th>
                    <th>お名前</th>
                    <th>email</th>
                    <th>パスワード</th>
                    <th>管理者</th>
                    <th>性別</th>
                    <th>勤務地</th>
                    <th>勤電話番号</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- レコードの数の分だけ繰り返し処理を行う -->
                <!-- $listの中の1レコード分が$vに繰り返し代入される -->
                <?php foreach ($list as $v) : ?>
                    <tr>
                        <td><?= $v['id'] ?></td>
                        <td><?= $v['name'] ?></td>
                        <td><?= $v['email'] ?></td>
                        <td><?= $v['password'] ?></td>
                        <!-- is_adminが1のときは「はい」と表示する（1でないときは何も表示しない） -->
                        <td><?php if ($v['is_admin'] == 1) echo 'はい' ?></td>
                        <td>
                            <!-- genderが1だったら「男性」と表示 -->
                            <?php if ($v['gender'] == 1) : ?>
                                男性
                                <!-- genderが2だったら「女性」と表示 -->
                            <?php elseif ($v['gender'] == 2) : ?>
                                女性
                                <!-- genderが3だったら「その他」と表示 -->
                            <?php else : ?>
                                その他
                            <?php endif ?>
                        </td>
                        <td><?= $v['pref'] ?></td>
                        <td><?= $v['tel'] ?></td>
                        <td>
                        <form action="./update.php" method="post" style="display: inline">
                                <input type="hidden" name="id" value="<?= $v['id'] ?>">
                                <input type="submit" class="btn btn-primary" value="修正">
                            </form>
                            <form action="./delete_action.php" method="post" style="display: inline">
                                <input type="hidden" name="id" value="<?= $v['id'] ?>">
                                <input type="submit" class="btn btn-primary" value="削除">
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>