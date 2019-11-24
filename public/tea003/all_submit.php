<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>みんなの提出</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/t/bs-3.3.6/jqc-1.12.0,dt-1.10.11/datatables.min.css" />
    <script src="https://cdn.datatables.net/t/bs-3.3.6/jqc-1.12.0,dt-1.10.11/datatables.min.js"></script>
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
</head>

<body>
    <?php
include_once("../template/nav.php");
include_once("../util/util.php");
echo_nav_card($_GET["contest_id"]);
?>
    <table class="table table-bordered">
        <div class="pager">
            <?php
$page = (isset($_GET["page"]) && $_GET["page"] >= 0)? $_GET["page"] : 0 ;
if (!preg_match("/^[0-9]+$/", $page)) {
    echo "PAGE ERROR";
    exit();
}
if ($page > 0) {
    echo '<a href="all_submit.php?page='.($page-1)."&contest_id=".$_GET["contest_id"].'">前へ</a>';
}
echo $page;
echo '<a href="all_submit.php?page='.($page+1).'&contest_id='.$_GET["contest_id"].'">次へ</a>';
?>
        </div>
        <thead>
            <tr>
                <th>Username</th>
                <th>Problem</th>
                <th>source</th>
            </tr>
        </thead>
        <tbody>

            <?php

$page = (isset($_GET["page"]) && $_GET["page"] >= 0)? $_GET["page"] : 0 ;
if (!isset($_GET["contest_id"])) {
    echo "contest_idを指定してください。";
    exit();
}
if (!preg_match("/^[0-9]+$/", $page)) {
    echo "PAGE ERROR";
    exit();
}

$contest_id = $_GET["contest_id"];
include "../database/connection.php";
$con = new DBC();
$page_from = (int)($page * 10);
try {
    $rec = $con->prepare_execute("SELECT username,user_id, problem, code_session FROM uploads LEFT JOIN users ON uid=user_id WHERE contest_id=? LIMIT 10 OFFSET $page_from", array($contest_id));
    // var_dump($rec);
    foreach ($rec as $line) {
        echo '<tr><th>';
        echo $line["username"];
        echo '</th>';
        echo '<th>';
        echo $line["problem"];
        echo '</th>';
        echo '<th>';
        echo '<a href="/result.php?code_session='.$line["code_session"].'">詳細</a>';
        echo '</th></tr>';
    }
} catch (Exception $e) {
    var_dump($e);
    echo "DB SELECT ERROR";
}
?>
        </tbody>
    </table>
    <?php
include_once("../util/util.php");
echo_nav_card_footer();
?>
</body>