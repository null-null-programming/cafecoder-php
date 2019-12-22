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

    <div class="container">
        <br>
    <!--メインコン�?ン�?-->
                <?php
		include_once("../../util/util.php");
		echo_nav_card('betea001');
                block_out_of_contest('betea001');
                ?>

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
                            <td><a href="./Problems/A.php">Happiness Function easy</a>
                            </td>
                            <td>2sec</td>
                            <td>earlgray283</td>
                        </tr>
                        <tr>
                            <th scope="row">Ceylon</th>
                            <td><a href="./Problems/B.php">Semiprime-like</a>
                            </td>
                            <td>2sec</td>
                            <td>Ultraviolett</td>
                        </tr>
                        <tr>
                            <th scope="row">Darjeeling</th>
                            <td><a href="./Problems/C.php">trick of treat</a>
                            </td>
                            <td>2sec</td>
                            <td>otamay</td>
                        </tr>
                        <tr>
                            <th scope="row">Earlgray</th>
                            <td><a href="./Problems/D.php">Happiness Festival</a>
                            </td>
                            <td>2sec</td>
                            <td>earlgray283</td>
                        </tr>
                        <tr>
                            <th scope="row">Earlgray</th>
                            <td><a href="./Problems/E.php">最小全域木？なにそれおいしいの？</a>
                            </td>
                            <td>2sec</td>
                            <td>sakaki_tohru</td>
                        </tr>
                        <tr>
                            <th scope="row">Keemun</th>
                            <td><a href="./Problems/F.php">Multiple Multiple</a>
                            </td>
                            <td>2sec</td>
                            <td>otamay</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</body>

</html>
