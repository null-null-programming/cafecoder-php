<?php
/*
*username codesession contestid documentroot からcode sessionの絶対パスを返す
*/
function get_uploaded_session_path($username, $code_session, $contest_id, $docroot){
    return $docroot."/".$username."/"."codes"."/".$contest_id."/".$code_session;
}
function echo_nav_card($contest_id){
    echo '    <div class="container">
        <div class="card" style="width: auto">
            <div class="card-body">
                <nav class="navbar navbar-expand-sm navbar-light bg-light">

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navmenu1" aria-controls="navmenu1" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navmenu1">
                        <div class="navbar-nav">
                            <a class="nav-item nav-link" href="index.php">コンテストTOP</a>
                            <a class="nav-item nav-link" href="/problem_list.html">問題一覧</a>
                            <a class="nav-item nav-link" href="/ranking.php?contest_id='.$contest_id.'">ランキング</a>
                            <a class="nav-item nav-link" href="/my_submit.php?contest_id='.$contest_id.'">自分の提出</a>
                            <a class="nav-item nav-link" href="/all_submit.php?contest_id='.$contest_id.'">みんなの提出</a>

                        </div>
                    </div>
                </nav>';
}
function echo_nav_card_footer(){
    echo '            </div>
        </div>
    </div>';
}