<?php
if (strcmp($_SERVER['SERVER_NAME'], "localhost") == 0) {
    $address = "http://localhost";
} else {
    $address = "https://www.kakecoder.com";
}
/*
    @session_start();
    if($_SESSION["role"] == "writer" || $_SESSION["role"] == "admin"){
        header("Location: /login.php")
        exit();
    }
    */
?>
<!doctype html>
<html lang="ja">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
    <script>
        jQuery(function($) {
            $.extend($.fn.dataTable.defaults, {
                language: {
                    url: "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"
                }
            });
            $("#result-table").DataTable({
                order: [
                    [0, "desc"]
                ]
            });
        });
    </script>

    <title>CafeCoder - Writerpage</title>

</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark " style="background-color:#a0522d;">
        <?php
        echo '<a href="' . $address . '/" class="navbar-brand">CafeCoder</a>';
        ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navmenu1" aria-controls="navmenu1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navmenu1">
            <div class="navbar-nav">
                <?php
                echo '<a class="nav-item nav-link" href="' . $address . '/">ホーム</a>';
                echo '<a class="nav-item nav-link" href="' . $address . '/Contest.html">コンテスト一覧</a>';
                ?>
            </div>
        </div>
        <div class="navbar-nav" class="username">
            <span class="nav-item">
                <?php
                if ($_SESSION["username"] != "") {
                    echo '<a style="background-color:white">' . $_SESSION["username"] . '</a>';
                    echo '<a href="' . $address . '/' . $_SESSION["username"] . '/.php">サインアウト</a>';
                } else {
                    echo '<a href="' . $address . '/signin.html">サインイン</a>';
                }
                ?>
            </span>
        </div>
    </nav>
    <br>

    <!--メインコンテンツ-->
    <!--
    <form>
        <label>問題</label>
        <select name="">
            <label>テストケース</label>
            <br />
            <textarea cols="60" name="testcase" rows="20">テストケース</textarea>
            <br />
            <label>ソースコード</label>
            <textarea cols="60" name="source code" rows="20">ソースコード</textarea>
            <br />
            <button type="button" name="submit" onclick="checktest()"> </button>
    </form>
            -->

    <div class="container">
        <div class="card" style="width:auto">
            <div class="card-body">
                <h2>問題文アップローダ</h2>
                <hr>
                <form action="<?php echo $address."/writerpage/upload.php";?>" method="POST" name="writer_submit_form">
                    <h3>コンテストid</h3>
                    <input type="text" name="contest_id">    
                
                <h3>問題アルファベット</h3>
                    <select name="problem_alpha">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                    <br>
                    <br>

                    <h3>問題文</h3>

                    <textarea name="problem_statement" cols="100" rows="40">

                        
                    </textarea>

                    <br>
                    <br>
                    <h3>入力テストケース</h3>
                    <input id="file" type="file" name="in_file[]" webkitdirectory>

                    <br>
                    <br>
                    <h3>出力テストケース</h3>
                    <input id="file" type="file" name="out_file[]" webkitdirectory>

                    <br>
                    <br>
                    <input type="submit" value="送信" class="btn">
            </div>
        </div>
    </div>
</body>

</html>