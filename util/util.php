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
    require(dirname(__FILE__)."/../public/call_api.php");
    $contest_name = call_api("contest","GET",array("contest_id"=>$contest_id))["contest_name"];
    echo '    <div class="container">
        <div class="card" style="width: auto">
            <div class="card-body">
                <nav class="navbar navbar-expand-sm navbar-light bg-light">

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navmenu1" aria-controls="navmenu1" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navmenu1">
                        <div class="navbar-nav">
                            <a class="nav-item nav-link" href="/'.$contest_name.'/index.php">コンテストTOP</a>
                            <a class="nav-item nav-link" href="/'.$contest_name.'/problem_list.php">問題一覧</a>
                            <a class="nav-item nav-link" href="/ranking.php?contest_id='.$contest_id.'">ランキング</a>
                            <a class="nav-item nav-link" href="/my_submit.php?contest_id='.$contest_id.'">自分の提出</a>
                            <a class="nav-item nav-link" href="/all_submit.php?contest_id='.$contest_id.'">みんなの提出</a>

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

function block_out_of_contest($contest_id){
    if($_SESSION["role"]==="admin"){
        return true;
    }
    require(dirname(__FILE__)."/../public/call_api.php");
    try{
        $contest= call_api("contest","GET",array("contest_id"=>$contest_id));
        $contest_name = $contest["contest_name"];
            if(!$contest["is_open"]){
                echo "コンテストは開始前です。";
                die();
            }
    }catch(Exception $e){
        echo "TIME ERROR";
        die();
    }
}
