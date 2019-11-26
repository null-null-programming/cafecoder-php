<!doctype html>
<html lang="ja">

<head>
    <?php include_once "../template/head.php"; ?>
</head>

<body>
    <?php include_once "../template/nav.php"; ?>
    <br>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>




    <!--メインコン�?ン�?-->
    <div class="container">
        <div class="card" style="width: auto">
            <div class="card-body">
                <nav class="navbar navbar-expand-sm navbar-light bg-light">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navmenu1"
                        aria-controls="navmenu1" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navmenu1">
                        <div class="navbar-nav">
                            <a class="nav-item nav-link" href="https://www.kakecoder.com/tea003">コンテストTOP</a>
                            <a class="nav-item nav-link"
                                href="https://www.kakecoder.com/tea003/problem_list.html">問題一覧</a>
                            <a class="nav-item nav-link" href="https://www.kakecoder.com/tea003/ranking.html">ランキング</a>
                            <a class="nav-item nav-link"
                                href="https://www.kakecoder.com/tea003/my_submit.html">自分の提出</a>
                            <a class="nav-item nav-link"
                                href="https://www.kakecoder.com/tea003/all_submit.html">みんなの提出</a>

                        </div>
                    </div>
                </nav>





                <?php include_once "../../../contests/tea003/D.html"; ?>
                <!--
                <br>
                <h3>難易度 - 問題名　【配点：XXX 点】</h3>
                <hr>
                <h4><strong>問題文</strong></h4><br>


                <br>
                <h4><strong>制約</strong></h4><br>



                <h4><strong>入力</strong></h4><br>



                <h4><strong>出力</strong></h4><br>



                <h4><strong>入力例1</strong></h4><br>



                <h4><strong>出力例1</strong></h4><br>


                -->


                <h4><strong>提出する</strong></h4><br>
                <form action="/submit.php" method="POST" name="submit_form">

                    <label>問題：</label>
                    <select name="problem" dssdase>
                        <option value="D"></option>

                    </select>
                    <select name="contest_id" dssdase>
                        <option value="3"></option>

                    </select>
                    <br><br>

                    <?php include_once "../template/select_language.php"; ?>

                    <br><br>
                    <label>ソースコード：</label>
                    <br>
                    <textarea cols="60" name="sourcecode" rows="20"></textarea>

                    <br>
                    <input type="submit" value="送信" class="btn" onclick="return checkform();">
                    <div>
                        <script>
                            function checkform() {
                                if (document.submit_form.userid.value == "" || document.submit_form.contestid.value ==
                                    "" || document.submit_form.sourcecode.value == "") {
                                    alert("ユーザIDもしくはソースコードが入力されていません。");
                                    return false;
                                } else {
                                    //location.href='WaitForJudgging.php';
                                    return true;
                                }
                            }
                        </script>
                    </div>
                </form>


            </div>
        </div>
    </div>
</body>

</html>