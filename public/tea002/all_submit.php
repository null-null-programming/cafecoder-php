<!doctype html>
<html lang="ja">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-144747694-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-144747694-2');
    </script>

    <title>tea002 - TOP</title>

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@earlgray283_C" />
    <meta property="og:url" content="https://www.kakecoder.com/tea002/index.html" />
    <meta property="og:title" content="Tea Break 002"" />
    <meta property=" og:description" content="コンテスト詳細" />
    <meta property="og:image"
        content="https://2.bp.blogspot.com/-2PgVP0iOkHY/USNoKzJtQlI/AAAAAAAANSI/1xMd2jtWmPA/s1600/cafe_tea.png" />
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark " style="background-color:#a0522d;">
        <a href="https://www.kakecoder.com/" class="navbar-brand">CafeCoder</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navmenu1"
            aria-controls="navmenu1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navmenu1">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="https://www.kakecoder.com/">ホーム</a>
                <a class="nav-item nav-link" href="https://www.kakecoder.com/Contest.html">コンテスト一覧</a>
            </div>
        </div>
    </nav>

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




    <!--メインコンテンツ-->
    <div class="container">
        <br>
        <div class="card" style="width: auto">
            <div class="card-body">
                <nav class="navbar navbar-expand-sm navbar-light bg-light">

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navmenu1"
                        aria-controls="navmenu1" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navmenu1">
                        <div class="navbar-nav">
                            <a class="nav-item nav-link" href="https://www.kakecoder.com/tea002">コンテストTOP</a>
                            <a class="nav-item nav-link"
                                href="https://www.kakecoder.com/tea002/problem_list.php">問題一覧</a>
                            <a class="nav-item nav-link" href="https://www.kakecoder.com/tea002/ranking.php">ランキング</a>
                            <a class="nav-item nav-link"
                                href="https://www.kakecoder.com/tea002/my_submit.php">自分の提出</a>
                            <a class="nav-item nav-link"
                                href="https://www.kakecoder.com/tea002/all_submit.php">みんなの提出</a>
                        </div>
                    </div>
                </nav>
                <!-- write code here -->
                <table class="table table-bordered">
<thead>
    <tr>
        <th>Username</th>
        <th>Problem</th>
        <th>Result</th>
        <th>submit time</th>
    </tr>
</thead>
<tbody>

<?php
include("../../database/connection.php");
$con = new DBC();
try{
    $rec = $con->simple_exec_obj("SELECT problem, code_session, username FROM tea002uploads INNER JOIN users ON tea002uploads.user_id = users.uid");
    $ar = array();
    $i = 0;
    foreach ($rec as $line) {
        try{
        $noext_path = "/var/www/html/public/users/" . $line["username"] ."/codes/".$line["problem"] ."/".$line["code_session"];
        foreach(glob($noext_path.".c") as $name) {
            $epath = $name;
        }
        foreach(glob($noext_path.".cpp") as $name) {
            $epath = $name;
        }
        foreach(glob($noext_path.".py") as $name) {
            $epath = $name;
        }
        foreach(glob($noext_path.".java") as $name) {
            $epath = $name;
        }
        $result = new SplFileObject($noext_path.".result");
        $result->setFlags(SplFileObject::READ_CSV);
        foreach ($result as $r) {
            $res = $r[3];
        }
        $ar[$i] = array(
            "username" => $line["username"],
            "problem" => $line["problem"],
            "result" => $res,
            "time" => filemtime($epath)
        );
        }catch(Exception $e){
            //echo "ERROR 2";
        }
        $i++;
    }
    // var_dump($ar);
    foreach ((array) $ar as $key => $value) {
        $sort[$key] = $value["time"];
    }
    array_multisort($sort, SORT_DESC, $ar);
    foreach ($ar as $ele) {
        echo '<tr><th>';
        echo $ele["username"];
        echo '</th>';
        echo '<th>';
        echo $ele["problem"];
        echo '</th>';
        echo '<th>';
        echo $ele["result"];
        echo '</th>';
        echo '<th>';
        echo date ("Y F d H:i:s", $ele["time"]);
        echo '</th></tr>';
    }
}catch(Exception $e){
    // var_dump($e);
    echo "DB SELECT ERROR";
}
?>
</tbody>
</table>               
            </div>
        </div>
    </div>
</body>
</html>
