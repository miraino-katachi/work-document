<?php
// セッションを有効にする
session_start();
// リクエストごとにセッションIDを切り替える
session_regenerate_id(true);
?>
<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        ログイン
                    </div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['error']) && $_SESSION['error']) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $_SESSION['error'] ?>
                            </div>
                        <?php endif ?>
                        <form method="post" action="./login_action.php">
                            <div class="form-group">
                                <label for="email">メールアドレス</label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="password">パスワード</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <button type="submit" class="btn btn-primary">ログイン</button>
                        </form>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>