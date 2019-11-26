<?php
/*
*username codesession contestid documentroot からcode sessionの相対パスを返す
*/
function get_uploaded_session_path($username, $contest_id, $problem, $code_session){
    return "users/$username/codes/$contest_id/$problem/$code_session";
}
function echo_nav_card($contest_id){
    if(!preg_match("/^[a-zA-Z0-9]+$/", $contest_id)){
        echo "CONTEST ID ERROR";
        die();
    }
    try{
    include_once("../database/connection.php");
    $con = new DBC();
    $contest_name = $con->prepare_execute("SELECT contest_name FROM contests WHERE contest_id=?",array($contest_id))[0]["contest_name"];
    echo '    <div class="container">
        <div class="card" style="width: auto">
            <div class="card-body">
                <nav class="navbar navbar-expand-sm navbar-light bg-light">

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navmenu1" aria-controls="navmenu1" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navmenu1">
                        <div class="navbar-nav">
                            <a class="nav-item nav-link" href="https://www.kakecoder.com/'.$contest_name.'/index.php">コンテストTOP</a>
                            <a class="nav-item nav-link" href="https://www.kakecoder.com/'.$contest_name.'/problem_list.php">問題一覧</a>
                            <a class="nav-item nav-link" href="https://www.kakecoder.com/ranking.php?contest_id='.$contest_id.'">ランキング</a>
                            <a class="nav-item nav-link" href="https://www.kakecoder.com/my_submit.php?contest_id='.$contest_id.'">自分の提出</a>
                            <a class="nav-item nav-link" href="https://www.kakecoder.com/all_submit.php?contest_id='.$contest_id.'">みんなの提出</a>

                        </div>
                    </div>
                </nav>';
    }catch(Exception $e){
        echo ("NAV ERROR 1");
    }
}
function echo_nav_card_footer(){
    echo '            </div>
        </div>
    </div>';
}

function block_out_of_contest(){
    if($_SESSION["role"]==="admin"){
        return;
    }
    require(dirname(__FILE__)."/../database/connection.php");
    try{
        $con = new DBC();
        $rec = $con->prepare_execute("SELECT contest_name ,start_time FROM contests WHERE start_time > NOW() ORDER BY start_time ASC", array());
        foreach($rec as $line){
            $contest_name = $line["contest_name"];
            if(strpos(getcwd(),$contest_name) !== false){
                echo "コンテストは開始前です。";
                die();
            }
        }
    }catch(Exception $e){
        echo "TIME ERROR";
        die();
    }
}