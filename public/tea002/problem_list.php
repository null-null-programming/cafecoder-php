<!doctype html>
<html lang="ja">
<?php
if (strcmp($_SERVER['SERVER_NAME'], "localhost") == 0) {
    $address = "http://localhost";
} else {
    $address = "https://www.kakecoder.com";
}
?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-144747694-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-144747694-2');
    </script>

    <title>問題一覧</title>
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
    </nav>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>




    <!--メインコン�?ン�?-->
    <div class="container">
        <div class="card" style="width: auto">
            <div class="card-body">
                <nav class="navbar navbar-expand-sm navbar-light bg-light">

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navmenu1" aria-controls="navmenu1" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navmenu1">
                        <div class="navbar-nav">
                            <?php
                            echo '<a class="nav-item nav-link" href="' . $address . '/tea002">コンテストTOP</a>';
                            echo '<a class="nav-item nav-link" href="' . $address . '/tea002/problem_list.php">問題一覧</a>';
                            echo '<a class="nav-item nav-link" href="' . $address . '/tea002/ranking.php">ランキング</a>';
                            echo '<a class="nav-item nav-link" href="' . $address . '/tea002/my_submit.php">自分の提出</a>';
                            echo '<a class="nav-item nav-link" href="' . $address . '/tea002/all_submit.php">みんなの提出</a>';
                            ?>
                        </div>
                    </div>
                </nav>
                <br>

                <table class="table">
                    <thead>
                        <tr>
                            <th>難易度</th>
                            <th scope="col">
                                問題名
                            </th>
                            <th>
                                実行制限時間
                            </th>
                            <th>
                                writer
                            </th>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Green</th>
                            <td><a href="https://www.kakecoder.com/tea002/Problems/A.php">Semiprime-like</a>
                            </td>
                            <td>2sec</td>
                            <td>Ultraviolett</td>

                        </tr>
                        <tr>
                            <th scope="row">Ceylon</th>
                            <td><a href="https://www.kakecoder.com/tea002/Problems/B.php">trick of
                                    treat</a>
                            </td>
                            <td>2sec</td>
                            <td>otamay</td>

                        </tr>
                        <tr>
                            <th scope="row">Earlgray</th>
                            <td><a href="https://www.kakecoder.com/tea002/Problems/C.php">最小全域木？なにそれおいしいの？</a>
                            </td>
                            <td>2sec</td>
                            <td>sakaki_tohru</td>


                        </tr>
                        <tr>
                            <th scope="row">Keemun</th>
                            <td><a href="https://www.kakecoder.com/tea002/Problems/D.php">Multiple
                                    Multiple</a>
                            </td>
                            <td>2sec</td>
                            <td>otamay</td>

                        </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</body>

</html>