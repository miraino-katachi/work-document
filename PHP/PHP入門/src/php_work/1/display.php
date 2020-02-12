<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHPのワーク</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="container-md">

        <table class="table table-striped table-hover my-3">
            <tr>
                <th>お名前</th>
                <td><?= $_POST['name'] ?></td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td><?= $_POST['email'] ?></td>
            </tr>
            <tr>
                <th>パスワード</th>
                <td><?= $_POST['password'] ?></td>
            </tr>
            <tr>
                <th>性別</th>
                <td>
                    <?php if ($_POST['gender'] == '1') : ?>
                        男性
                    <?php elseif ($_POST['gender'] == '2') : ?>
                        女性
                    <?php else : ?>
                        その他
                    <?php endif ?>
                </td>
            </tr>
            <tr>
                <th>事業所所在地</th>
                <td><?= $_POST['pref'] ?></td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td><?= $_POST['tel'] ?></td>
            </tr>
            <tr>
                <th>管理者</th>
                <td>
                    <?php if (isset($_POST['is_admin']) && $_POST['is_admin'] == '1') : ?>
                        はい
                    <?php else : ?>
                        いいえ
                    <?php endif ?>
                </td>
            </tr>
        </table>

    </div>

</body>

</html>