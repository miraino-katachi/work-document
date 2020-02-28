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
    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="./">PHPワーク</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./">一覧表示 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="./add.php">ユーザー追加</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>


        <form method="post" action="./add_action.php" class="my-3">
            <div class="form-group">
                <label for="name">お名前</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>

            <div class="form-group">
                <label for="emal">メールアドレス</label>
                <input type="text" name="email" id="email" class="form-control">
            </div>

            <div class="form-group">
                <label for="passwaord">パスワード</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>

            <div class="form-group">
                <div class="form-check form-check-inline">
                    <input type="radio" name="gender" id="gender1" value="1" class="form-check-input" checked>
                    <label for="gender1">男性</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="gender" id="gender2" value="2" class="form-check-input">
                    <label for="gender2">女性</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="gender" id="gender9" value="9" class="form-check-input">
                    <label for="gender9">その他</label>
                </div>
            </div>

            <div class="form-group">
                <label for="pref">事業所所在地</label>
                <select name="pref" id="pref" class="form-control">
                    <option value="大阪" selected>大阪</option>
                    <option value="兵庫">兵庫</option>
                    <option value="京都">京都</option>
                    <option value="奈良">奈良</option>
                    <option value="和歌山">和歌山</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tel">電話番号</label>
                <input type="text" name="tel" id="tel" class="form-control">
            </div>

            <div class="form-check">
                <input type="checkbox" name="is_admin" id="is_admin" value="1" class="form-check-input">
                <label for="is_admin">管理者の方はチェックを入れてください。</label>
            </div>

            <div class="my-2">
                <input type="submit" value="追加" class="btn btn-primary">
                <input type="reset" value="リセット" class="btn btn-outline-primary">
            </div>
        </form>

    </div>
</body>

</html>