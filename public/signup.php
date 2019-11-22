<!doctype html>
<html lang="ja">

<head>
<?php include_once "../template/head.php"; ?>
</head>
<body>
<?php include_once "../template/nav.php"; ?>
<br>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

</body>
<!--メインコンテンツ-->
<div class="container">
    <div class="card" style="width: auto">
        <div class="card-body">
            <form action="signuputil.php" method="POST">
                <p>ユーザー登録</p>
                <label>ユーザーID</label>
                <p class="username"><input type="text" name="username" maxlength="32" autocomplete="OFF" /></p>
                <label>パスワード</label>
                <p class="password"><input type="password" name="password" maxlength="32" autocomplete="OFF" /></p>
                <p class="submit"><input type="submit" value="登録" /></p>
            </form>
        </div>
    </div>
</div>
<br />

</body>

</html>