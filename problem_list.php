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
                            <?php
                            echo '<a class="nav-item nav-link" href="/tea003/">コンテストTOP</a>';
                            echo '<a class="nav-item nav-link" href="/tea003/problem_list.php">問題一覧</a>';
                            echo '<a class="nav-item nav-link" href="/ranking.php?contest_id=3">ランキング</a>';
                            echo '<a class="nav-item nav-link" href="/my_submit.php?contest_id=3">自分の提出</a>';
                            echo '<a class="nav-item nav-link" href="/all_submit.php?contest_id=3">みんなの提出</a>';
                            ?>
                        </div>
                    </div>
                </nav>
                <br>

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
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Green</th>
                            <td><a href="/Problems/A.php">Hop Step Jump!</a>
                            </td>
                            <td>2sec</td>
                            <td>null</td>
                        </tr>
                        <tr>
                            <th scope="row">Ceylon</th>
                            <td><a href="/Problems/B.php">Sound!</a>
                            </td>
                            <td>2sec</td>
                            <td>ir_1st_vil</td>
                        </tr>
                        <tr>
                            <th scope="row">Dimbula</th>
                            <td><a href="/Problems/C.php">Good Triangle</a>
                            </td>
                            <td>2sec</td>
                            <td>null</td>
                        </tr>
                        <tr>
                            <th scope="row">Darjeeling</th>
                            <td><a href="/Problems/D.php">Breaker</a>
                            </td>
                            <td>2sec</td>
                            <td>ir_1st_vil</td>
                        </tr>
                        <tr>
                            <th scope="row">Earlgray</th>
                            <td><a href="/Problems/E.php">Cafe Road</a>
                            </td>
                            <td>2sec</td>
                            <td>holeguma</td>
                        </tr>
                        <tr>
                            <th scope="row">Keemun</th>
                            <td><a href="/Problems/F.php">'0' or '1'</a>
                            </td>
                            <td>2sec</td>
                            <td>Keemun</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</body>

</html>