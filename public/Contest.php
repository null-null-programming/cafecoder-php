<!doctype html>
<html lang="ja">

<head>
    <!-- Required meta tags -->
    <?php include_once "../template/head.php"; ?>
    <title>コンテスト</title>
</head>

<body>
    <?php include_once "../template/nav.php" ;?>

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




    <!--メインコンテンツ-->
    <div class="container">
        <div class="card" style="width:auto">
            <div class="card-body">
                <h4 class="card-title">コンテスト一覧</h4>
                <p class="card-text">
                    <h5>予定されたコンテスト</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>日時</th>
                                <th scope="col">
                                    コンテスト名
                                </th>
                                <th>
                                    writer
                                </th>
                        </thead>
                        <tbody>
                            <!--
                                        テンプレ
                                        <tr>
                                        <th scope="row">2019-07-30 22:30:00</th>
                                        <td><a href="">(復刻)PCK Screening Meeting Contest</a></td>
                                        <td>なし</td>
                                    </tr>
                                    -->



                        </tbody>
                    </table>


                    <br><br>

                    <h5>過去のコンテスト</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>日時</th>
                                <th scope="col">
                                    コンテスト名
                                </th>
                                <th>
                                    writer
                                </th>
                            </tr>

                        </thead>
                        <tbody>
                            <!--
                                        テンプレ
                                        <tr>
                                        <th scope="row">2019-07-30 22:30:00</th>
                                        <td><a href="">(復刻)PCK Screening Meeting Contest</a></td>
                                        <td>なし</td>
                                    </tr>
                                    -->
                            <tr>
                                <th scope="row">2019-11-06 20:00:00</th>
                                <td>
                                    <a href="https://www.kakecoder.com/Contests/tea001/index.html">Tea Break 001</a>
                                </td>
                                <td>earlgray283</td>
                            </tr>

                        </tbody>
                    </table>
                </p>
            </div>
        </div>
    </div>
</body>

</html>