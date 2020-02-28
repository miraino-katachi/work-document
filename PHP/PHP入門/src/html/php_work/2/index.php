<?php
// 検索条件
$pref = '';
if (isset($_GET['pref'])) {
    // フォームから送信されたデータがあれば、変数に代入する
    $pref = $_GET['pref'];
}

// データベースに接続するための文字列（DSN・接続文字列）
$dsn = 'mysql:dbname=php_work;host=localhost;charset=utf8';

// PDOクラスのインスタンスを作る
$dbh = new PDO($dsn, 'root', 'root');

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
    <title>検索結果</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="container">

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
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>

</html>