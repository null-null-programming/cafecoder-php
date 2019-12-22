<?php
/*
*username codesession contestid documentroot からcode sessionの相対パスを返す
*/
function get_uploaded_session_path($username, $contest_id, $problem, $code_session){
    return "users/$username/codes/$contest_id/$problem/$code_session";
}
function echo_nav_card($contest_id){
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


    include_once(dirname(__FILE__)."/../public/call_api.php");
    if(isset($_SESSION["role"]) && $_SESSION["role"]==="admin"){
        echo "admin";
        return true;
    }
    try{
        $contest = call_api("contest","GET",array("contest_id"=>$contest_id));
	    if(!$contest["is_open"]){
		echo "コンテストは開始前です。";
		die();
	    }else{
		    return true;
	    }
    }catch(Exception $e){
        echo "TIME ERROR";
        die();
    }

}
function echo_submit_form($problem,$contest_id) {
echo '
                <h4><strong>提出する</strong></h4><br>
                <form action="/submit.php" method="POST" name="submit_form">

                    <select style="display:none" name="problem" dssdase>
                        <option  value="'.$problem.'"></option>

                    </select>
                    <select style="display:none" name="contest_id" dssdase>
                        <option value="'.$contest_id.'"></option>

                    </select>
';
                    include_once "../../../template/select_language.php";
		    echo '

	            <br />
                    <label>ソースコード：</label>
                    <br>
                    <textarea cols="60" name="sourcecode" rows="20"></textarea>

                    <br>
                    <input type="submit" value="送信" class="btn" onclick="return checkform();">
                    <div>
                        <script>
                            function checkform() {
                                if (document.submit_form.userid.value == "" || document.submit_form.contestid.value == "" || document.submit_form.sourcecode.value == "") {
                                    alert("ユーザIDもしくはソースコードが入力されていません。");
                                    return false;
                                } else {
                                    //location.href=\'WaitForJudgging.php\';
                                    return true;
                                }
                            }
                        </script>
                    </div>
                </form>

';
}
