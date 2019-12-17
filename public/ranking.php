<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>ランキング</title>
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
<style>
 span.submit_time {
    font-size: 80%;
 }
div.point{
    margin: auto;
    height: 4em;
    width: 7em;
    display: table-cell; 
    vertical-align: middle;
}
div.point.num{
    margin: auto;
}
div.username{
    margin: auto;
    height: 4em;
    width: 7em;
    display: table-cell; 
    vertical-align: middle;
}
th{

     text-align:center;
     width: 10%;
     }
</style>
</head>

<body>

<?php
include_once("../template/nav.php");
include_once("../util/util.php");
echo_nav_card($_GET["contest_id"]);
?>


<table class="table table-bordered">
<thead>
    <tr>
        <th>Rank</th>
        <th>Username</th>
        <th>Point</th>
        <th>A</th>
        <th>B</th>
        <th>C</th>
        <th>D</th>
        <th>E</th>
        <th>F</th>
    </tr>
</thead>
<tbody>

<?php

if(!isset($_GET["contest_id"])){
    echo "contest_idを指定してください。";
    exit();
}

$contest_id = $_GET["contest_id"];
try{
include_once "./call_api.php";
include_once "../util/util.php";
}catch(Exception $e){
    echo "RANKING INIT ERROR";
    exit();
}
try{
    $res = call_api("ranking","GET",array("contest_id"=>$contest_id));
}catch(Exception $e){
    echo "DB SELECT ERROR 1";
    exit();
}
    $enum_problem = array("A","B","C","D","E","F");
    foreach ($res as $user) {
        echo '<tr><th>';
        echo '<div class="point">';
        echo $user["rank"];
        echo '</div>';
        echo '</th>';
        echo '<th>';
        echo '<div class="username">';
        echo $user["username"];
        echo '</div>';
        echo '</th>';
        echo '<th>';
        echo '<div class="point">';
        echo $user["point"];
        echo '</div>';
        echo '</th>';
        for($j=0; $j < 6; $j++){
            if($enum_problem[$j] === $user["submits"][$j]["problem_name"]){
                echo '<th>';
                echo '<div class="point">';
                echo '<a class="num" href="result.php?contest_id='.$contest_id.'&username='.$user["username"].'&code_session='.$user["submits"][$j]["submit_id"].'">'.$user["submits"][$j]["point"].'</a>';
                echo '<br />';
                echo '<span class="submit_time">'.$user["submits"][$j]["submit_time"].'</span>';
                echo '</div>';
                echo '</th>';
            }else{
                echo '<th>';
                echo '<div class="point">';
                echo " - ";
                echo '</div>';
                echo '</th>';

            }
        }
        echo '</tr>';
    }
?>
</tbody>
</table>
</body>
