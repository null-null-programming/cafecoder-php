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
    <?php include_once("../template/nav.php");
include_once("../util/util.php");
echo_nav_card($_GET["contest_id"]);
?>

    <?php

                //todo magic number to config
                $ext = array(
                    "0"=>"c",
                    "1"=>"cpp",
                    "2"=>"java",
                    "3"=>"py",
                    "4"=>"cs",
                );
                include_once("../database/connection.php");
                if (!preg_match("/^[0-9a-zA-Z]+$/", $_GET["code_session"])) {
                    echo "CODE SESSION ERROR";
                    exit();
                }

                $code_session = $_GET["code_session"];
                $con = new DBC();

               //get user_code path
                $sql = "SELECT username,problem,contest_id,contest_id,lang FROM uploads,users WHERE uid=user_id AND code_session=?";
                try {
                    $rec = $con->prepare_execute($sql, array($code_session))[0];
                } catch (Exception $e) {
                    echo "DB SELECT ERROR 1";
                }
                $problem = $rec["problem"];
                $contest_id = $rec["contest_id"];
                $language = $rec["lang"];
                $user_id = $rec["user_id"];
                $username = $rec["username"];

                //check time and login
                $sql = "SELECT contest_name FROM contests WHERE contest_id=? AND NOW() BETWEEN start_time AND end_time";
                try {
                    $rec = $con->prepare_execute($sql, array($contest_id))[0];
                } catch (Exception $e) {
                    echo "DB SELECT ERROR 2";
                    exit();
                }
                $contest_name = $rec["contest_name"];

                //if contest time
                if ($contest_name != "") {
                    if ($_SESSION["username"] != $username) {
                        echo "コンテスト中は本人のみが確認できます。";
                        exit();
                    }
                }

                //get test_case_list path
                $sql = "SELECT testcase_list_dir,point FROM problem WHERE contest_id=? and problem_id=?";
                try {
                    $rec = $con->prepare_execute($sql, array($contest_id, $problem))[0];
                } catch (Exception $e) {
                    echo "DB SELECT ERROR 3";
                }
                $testcase_list_path = $rec["testcase_list_dir"]. "/testcase_list.txt";
                //get user_code
                $user_code_base = "./users/$username/codes/$contest_id/$problem/$code_session";
                $user_code_path = $user_code_base .".". $ext[$language];
                $user_error_path = $user_code_base . ".error";
                $user_code = file_get_contents($user_code_path);
                $user_error = file_get_contents($user_error_path);

                $cnt = 0;
                $result_path = $user_code_base . ".result";
                if (file_exists($result_path)) {
                    $file = new SplFileObject($result_path);
                    $file->setFlags(SplFileObject::READ_CSV);
                }
                $inn = file_get_contents($testcase_list_path);
                $inn = explode("\n", $inn);
                //print  code
                echo 'CODE : <br/> ';
                echo '<pre class="prettyprint">';
                echo htmlspecialchars($user_code);
                //print error
                echo '</pre>';
                echo 'ERROR : <br/> ';
                echo '<pre>';
                echo htmlspecialchars($user_error);
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


                if (file_exists($result_path)) {
                    foreach ($file as $outputs) {
                        $start = 5;
                        $end = count($outputs);
                        for ($i = $start; $i <= $end - 2; $i += 2) {
                            $case_number = intdiv(($i - 4), 2);
                            $tim = $outputs[$i + 1];
                            echo '<tr>';
                            echo '<th>' . $inn[$case_number] . '</th>';
                            echo '<th><span class="' . $outputs[$i] . '">' . $outputs[$i] . '</span></th>';
                            echo '<th>' . $tim . '[ms]</th>';
                        }
                    }
                }
                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
                echo '<table class="table table-bordered">';
                echo '<tbody>';
                echo '<tr>';
                echo '<th>ユーザID</th>';
                echo '<th>' . $username . '</th>';
                echo '</tr>';
                echo '<tr>';
                echo '<th>問題</th>';
                echo '<th>' . $problem . '</th>';
                echo '</tr>';
                echo '<tr>';
                echo '<th>結果</th>';
                if (isset($outputs[3])) {
                    echo '<th class=".'.$outputs[3].'">' . $outputs[3] . '</th>';
                } else {
                    echo '<th>' . 'WJ...' . '</th>';
                }
                echo '</tr>';
                echo '<tr>';
                echo '<th>実行時間</th>';
                echo '<th>' . $outputs[1] . ' [ms]</th>';
                echo '</tr>';
                echo '<tr>';
                echo '<th>メモリ使用量</th>';
                echo '<th>' . $outputs[2] . ' [kB]</th>';
                echo '</tr>';
                echo '<tr>';
                echo '<th>得点</th>';
                echo '<th>' . $outputs[4] . '</th>';
                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
                
                ?>
    </div>
    </div>
    </div>
</body>