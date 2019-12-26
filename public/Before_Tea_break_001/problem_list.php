<!doctype html>
<html lang="ja">

<head>
    <?php include_once "../../template/head.php"; ?>
</head>

<body>
    <?php include_once "../../template/nav.php"; ?>

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
                <?php
		include_once("../../util/util.php");
		echo_nav_card('betea001');
                block_out_of_contest('betea001');
                ?>
<br />

                <table class="table">
                    <thead>
                        <tr>
                            <th>難易度</th>
                            <th scope="col">
                                問題名
                            </th>
                            <th>
                                実行制限時間
                            </th>
                            <th>
                                writer
                            </th>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Green</th>
                            <th><a href="./Problems/A.php">Happiness Function easy</a>
                            </th>
                            <th>2sec</th>
                            <th>earlgray283</th>
                        </tr>
                        <tr>
                            <th scope="row">Ceylon</th>
                            <th><a href="./Problems/B.php">Semiprime-like</a>
                            </th>
                            <th>2sec</th>
                            <th>Ultraviolett</th>
                        </tr>
                        <tr>
                            <th scope="row">Darjeeling</th>
                            <th><a href="./Problems/C.php">trick of treat</a>
                            </th>
                            <th>2sec</th>
                            <th>otamay</th>
                        </tr>
                        <tr>
                            <th scope="row">Earlgray</th>
                            <th><a href="./Problems/D.php">Happiness Festival</a>
                            </th>
                            <th>2sec</th>
                            <th>earlgray283</th>
                        </tr>
                        <tr>
                            <th scope="row">Earlgray</th>
                            <th><a href="./Problems/E.php">最小全域木？なにそれおいしいの？</a>
                            </th>
                            <th>2sec</th>
                            <th>sakaki_tohru</th>
                        </tr>
                        <tr>
                            <th scope="row">Keemun</th>
                            <th><a href="./Problems/F.php">Multiple Multiple</a>
                            </th>
                            <th>2sec</th>
                            <th>otamay</th>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</body>

</html>
