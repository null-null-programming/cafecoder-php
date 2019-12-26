<!DOCTYPE HTML>
<html lang="ja">

<head>
    <title>みんなの提出</title>
    <?php include_once "../template/head.php"; ?>
</head>

<body>

<?php
include_once("../template/nav.php");
include_once("../util/util.php");
echo_nav_card($_GET["contest_id"]);
?>

<br />
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
        echo '<span class="result '.$line["result"]."\">".$line["result"]."</span>";
        echo '</th>';
        echo '<th>';
        echo '<a href="/result.php?code_session='.$line["submit_id"].'&contest_id='.$contest_id.'">提出コード</a>';
        echo '</th></tr>';
    }
?>
</tbody>
</table>
</body>
