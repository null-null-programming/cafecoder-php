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
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>




    <!--メインコン�?ン�?-->

<?php
include_once("../template/nav.php");
include_once("../util/util.php");
echo_nav_card("0");
?>
               <br>
                <h3>Green - Semiprime-like　【配点：100 点】</h3>
                <hr>
                <h4><strong>問題文</strong></h4>
                <p>
                <h4><strong>提出する</strong></h4><br>
                <form action="/submit.php" method="POST" name="submit_form">

                    <label>問題：</label>
                    <select name="problem" dssdase>
                        <option value="A">Green - Semiprime-like</option>

                    </select>
                    <select name="contest_id" dssdase>
                        <option value="0"></option>

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
                                if (document.submit_form.userid.value == "" || document.submit_form.contestid.value == "" || document.submit_form.sourcecode.value == "") {
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
