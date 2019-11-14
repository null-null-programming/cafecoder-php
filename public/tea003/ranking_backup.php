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

    <title>tea003 - TOP</title>

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@earlgray283_C" />
    <meta property="og:url" content="https://www.kakecoder.com/tea003/index.html" />
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
                            <a class="nav-item nav-link" href="https://www.kakecoder.com/tea003">コンテストTOP</a>
                            <a class="nav-item nav-link"
                                href="https://www.kakecoder.com/tea003/problem_list.html">問題一覧</a>
                            <a class="nav-item nav-link" href="https://www.kakecoder.com/tea003/ranking.php">ランキング</a>
                            <a class="nav-item nav-link"
                                href="https://www.kakecoder.com/tea003/my_submit.php">自分の提出</a>
                            <a class="nav-item nav-link"
                                href="https://www.kakecoder.com/tea003/all_submit.php">みんなの提出</a>
                        </div>
                    </div>
                </nav>
                <!-- write code here -->
                <table class="table table-bordered">
<thead>
    <tr>
        <th>Username</th>
        <th>A</th>
        <th>B</th>
        <th>C</th>
        <th>D</th>
        <th>score</th>
    </tr>
</thead>
<tbody>
<?php
include("../../database/connection.php");

/// function
function get_score($prob) {
    if ($prob == "A") {
        return 100;
    }
    if ($prob == "B") {
        return 200;
    }
    if ($prob == "C") {
        return 300;
    }
    if ($prob == "D") {
        return 400;
    }
}

$con = new DBC();
/// table作成?
try{
    $rec = $con->simple_exec_obj("SELECT user_id, problem, code_session, username FROM tea002uploads INNER JOIN users ON tea002uploads.user_id = users.uid");
    $obj = [];
    foreach ($rec as $line) {
        // var_dump($line);
        /// ```$no_extpath . ".result"``` resultのファイルパス
        /// $res ---> AC WA,...
        try{
        $noext_path = "/var/www/html/public/users/" . $line["username"] ."/codes/".$line["problem"] ."/".$line["code_session"];
        $result = new SplFileObject($noext_path.".result");
        $result->setFlags(SplFileObject::READ_CSV);
        foreach ($result as $r) {
            $res = $r[3];
        }
        // echo $res;
        if ($res == "AC") {
            $sc = get_score($line["problem"]);
        }else{
            $sc = 0;
        }
        $timeq = filemtime($noext_path.".result");
        // echo $line["problem"];
        if ($line["problem"]=="A" && $sc > 0 && $obj[$line["user_id"]]["Atime"]==NULL){
            $obj[$line["user_id"]]["username"] = $line["username"];
            $obj[$line["user_id"]]["Atime"] = max($obj[$line["username"]]["Atime"], $timeq);
            $obj[$line["user_id"]]["Btime"] = $obj[$line["username"]]["Btime"];
            $obj[$line["user_id"]]["Ctime"] = $obj[$line["username"]]["Ctime"];
            $obj[$line["user_id"]]["Dtime"] = $obj[$line["username"]]["Dtime"];
            $obj[$line["user_id"]]["sumtime"] = max($obj[$line["username"]]["sumtime"], $timeq);
            $obj[$line["user_id"]]["sumscore"] += $sc;

        }
        if ($line["problem"]=="B" && $sc > 0 && $obj[$line["user_id"]]["Btime"]==NULL){
            $obj[$line["user_id"]]["username"] = $line["username"];
            $obj[$line["user_id"]]["Atime"] = $obj[$line["username"]]["Atime"];
            $obj[$line["user_id"]]["Btime"] = max($obj[$line["username"]]["Btime"], $timeq);
            $obj[$line["user_id"]]["Ctime"] = $obj[$line["username"]]["Ctime"];
            $obj[$line["user_id"]]["Dtime"] = $obj[$line["username"]]["Dtime"];
            $obj[$line["user_id"]]["sumtime"] = max($obj[$line["username"]]["sumtime"], $timeq);
            $obj[$line["user_id"]]["sumscore"] += $sc;

        }
        if ($line["problem"]=="C" && $sc > 0 && $obj[$line["user_id"]]["Ctime"]==NULL){
            $obj[$line["user_id"]]["username"] = $line["username"];
            $obj[$line["user_id"]]["Atime"] = $obj[$line["username"]]["Atime"];
            $obj[$line["user_id"]]["Btime"] = $obj[$line["username"]]["Btime"];
            $obj[$line["user_id"]]["Ctime"] = max($obj[$line["username"]]["Ctime"], $timeq);
            $obj[$line["user_id"]]["Dtime"] = $obj[$line["username"]]["Dtime"];
            $obj[$line["user_id"]]["sumtime"] = max($obj[$line["username"]]["sumtime"], $timeq);
            $obj[$line["user_id"]]["sumscore"] += $sc;

        }
        if ($line["problem"]=="D" && $sc > 0 && $obj[$line["user_id"]]["Dtime"]==NULL){
            $obj[$line["user_id"]]["username"] = $line["username"];
            $obj[$line["user_id"]]["Atime"] = $obj[$line["username"]]["Atime"];
            $obj[$line["user_id"]]["Btime"] = $obj[$line["username"]]["Btime"];
            $obj[$line["user_id"]]["Ctime"] = $obj[$line["username"]]["Ctime"];
            $obj[$line["user_id"]]["Dtime"] = max($obj[$line["username"]]["Dtime"], $timeq);
            $obj[$line["user_id"]]["sumtime"] = max($obj[$line["username"]]["sumtime"], $timeq);
            $obj[$line["user_id"]]["sumscore"] += $sc;

        }

        }catch(Exception $e){
            // var_dump($e);
        }
    }
    // var_dump($obj);
    try{
    foreach ((array) $obj as $key => $value) {
        $sort[$key] = $value["sumtime"];
    }
    array_multisort($sort, SORT_ASC, $obj);
    foreach ((array) $obj as $key => $value) {
        $sortq[$key] = $value["sumscore"];
    }
    array_multisort($sortq, SORT_DESC, $obj);
    }catch(Exception $e){
        var_dump($e);
    }
    foreach ($obj as $ele) {
        echo '<tr><th>';
        echo $ele["username"];
        echo '</th>';
        echo '<th>';
        echo date ("H:i:s", $ele["Atime"] - 1573646400);
        echo '</th>';
        echo '<th>';
        echo date ("H:i:s", $ele["Btime"] - 1573646400);
        echo '</th>';
        echo '<th>';
        echo date ("H:i:s", $ele["Ctime"] - 1573646400);
        echo '</th>';
        echo '<th>';
        echo date ("H:i:s", $ele["Dtime"] - 1573646400);
        echo '</th>';
        echo '<th>';
        echo $ele["sumscore"];
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