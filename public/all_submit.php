<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
?>

<div class="card" style="width: auto"> <div class="card-body"> <nav class="navbar navbar-expand-sm navbar-light bg-light"> 
<table class="table table-bordered">
<div class="pager">
</div>

<thead>
    <tr>
        <th>Username</th>
        <th>Date</th>
        <th>Problem</th>
        <th>Result</th>
        <th>Source</th>
    </tr>
</thead>
<tbody>
<?php

if(!isset($_GET["contest_id"])){
    echo "contest_idを指定してください。";
    exit();
}
$contest_id = $_GET["contest_id"];
include_once "./call_api.php";
//get result
try{
    $res = call_api("allsubmits","GET",array("contest_id"=>$contest_id));
}catch(Exception $e){
    echo "DB SELECT ERROR 1";
    exit();
}
    foreach ($res["submits"] as $line) {
        echo '<tr><th>';
        echo $line["username"];
        echo '</th>';
        echo '<th>';
        echo $line["submit_time"];
        echo '</th>';
        echo '<th>';
        echo $line["problem_name"];
        echo '</th>';
        echo '<th>';
        echo $line["result"];
        echo '</th>';
        echo '<th>';
        echo '<a href="/result.php?code_session='.$line["submit_id"].'&contest_id='.$contest_id.'">提出コード</a>';
        echo '</th></tr>';
    }
?>
</tbody>
</table>
</body>
