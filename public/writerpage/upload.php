<?php

if (strcmp($_SERVER['SERVER_NAME'], "localhost") == 0) {
    $address = "http://localhost";
} else {
    $address = "https://www.kakecoder.com";
}

/*ここにバリデーションチェックをいれたいです*/


/*------------------------------------*/

$problem_path=$address.'/'.$_POST["contest_id"].'/Problems/'.$_POST["problem_alpha"].'.php';
echo $problem_path;
system("touch $problem_path");
file_put_contents($problem_path, $_POST["problem_statement"]);

$testcase_path=$address.'/'."Contests/".$_POST["contest_id"]."/testcase/";
for ($i=0;$i<count($_FILES['in_file']);$i++) {
    if (move_uploaded_file($_FILES['in_file'][$i], $testcase_path.'in/'.$_FILES['in_file'][$i])) {
    } else {
        echo '失敗しました';
    }
}
for ($i=0;$i<count($_FILES['out_file']);$i++) {
    if (move_uploaded_file($_FILES['out_file'][$i], $testcase_path.'out/'.$_FILES['out_file'][$i])) {
    } else {
        echo '失敗しました';
    }
}
