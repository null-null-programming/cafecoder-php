<!DOCTYPE HTML>
<html lang="ja">

<head>
    <?php include_once "../template/head.php"; ?>


    <title>提出結果</title>
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
        .AC {
            color: palegreen;
        }

        .WA {
            color: orange;
        }

        .TLE {
            color: orange;
        }

        .RE {
            color: orange;
        }

        .MLE {
            color: orange;
        }

        .CE {
            color: lightblue;
        }

        .IE {
            color: lightblue;
        }
    </style>
</head>

<body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>


<?php
include_once("../template/nav.php");
include_once("../util/util.php");
echo_nav_card($_GET["contest_id"]);
?>
<div class="card" style="width: auto"> <div class="card-body"> 
<?php

                //todo magic number to config
                $ext = array(
                    "0"=>"c",
                    "1"=>"cpp",
                    "2"=>"java",
                    "3"=>"py",
                    "4"=>"cs",
                );
                include_once("./call_api.php");
                if (!preg_match("/^[0-9a-zA-Z]+$/", $_GET["code_session"])) {
                    echo "CODE SESSION ERROR";
                    exit();
                }

                $code_session = $_GET["code_session"];
                $contest_id = $_GET["contest_id"];
                //check time and login

                $con = call_api("contest","GET",array("contest_id"=>$contest_id));
                $res = call_api("result","GET",array("code_session"=>$code_session,"auth_token"=>$_SESSION["token"]));
                $username = $res["username"];
                //if contest time
		/*
                if ($con["is_open"]) {
                    if ($_SESSION["username"] != $username ) {
                        echo "コンテスト中は本人のみが確認できます。";
                        exit();
                    }
		}
		*/
		//get test_case_list path
                //get usercode
                //get error
                $testcases = call_api("testcase","GET",array("code_session"=>$code_session,"auth_token"=>$_SESSION["token"]));
                $code = call_api("code","GET",array("code_session"=>$code_session,"auth_token"=>$_SESSION["token"]));
                //get user_code
                //print  code
                echo 'CODE : <br/> ';
                echo '<pre class="prettyprint">';
                echo htmlspecialchars(base64_decode($code["code"]));
                //print error
                echo '</pre>';
                echo 'ERROR : <br/> ';
                echo '<pre>';
                echo htmlspecialchars(base64_decode($res["error"]));
                echo '</pre>';

                echo '<table class="table table-bordered">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>テストケース</th>';
                echo '<th>結果</th>';
                echo '<th>実行時間</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';


                foreach ($testcases["testcases"] as $case) {
                    echo '<tr>';
                    echo '<th>' . $case["testcase_name"] . '</th>';
                    echo '<th><span class="' . $case["result"] . '">' . $case["result"] . '</span></th>';
                    echo '<th>' . $case["runtime"]. '[ms]</th>';
                }
                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
                echo '<table class="table table-bordered">';
                echo '<tbody>';
                echo '<tr>';
                echo '<th>ユーザID</th>';
                echo '<th>' . $res["username"] . '</th>';
                echo '</tr>';
                echo '<tr>';
                echo '<th>問題</th>';
                echo '<th>' . $res["problem"] . '</th>';
                echo '</tr>';
                echo '<tr>';
                echo '<th>結果</th>';
                echo '<th class=".'.$res["result"].'">' . $res["result"] . '</th>';
                echo '</tr>';
                echo '<tr>';
                echo '<th>実行時間</th>';
                echo '<th>' . $res["max_runtime"] . ' [ms]</th>';
                echo '</tr>';
                echo '<tr>';
                echo '<th>メモリ使用量</th>';
                echo '<th>' . "undef" . ' [kB]</th>';
                echo '</tr>';
                echo '<tr>';
                echo '<th>得点</th>';
                if($res["result"] === 'AC'){
                    echo '<th>' . $res["point"] . '</th>';
                }else{
                    echo '<th>0</th>';
                }
                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
                
                ?>
    </div>
    </div>
    </div>
</body>
