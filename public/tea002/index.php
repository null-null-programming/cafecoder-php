<!doctype html>
<html lang="ja">
<?php
if (strcmp($_SERVER['SERVER_NAME'], "localhost") == 0) {
    $address = "http://localhost";
} else {
    $address = "https://www.kakecoder.com";
}
?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-144747694-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-144747694-2');
    </script>

    <title>tea002 - TOP</title>

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@earlgray283_C" />
    <?php
    echo '<meta property="og:url" content="' . $address . '/tea002/index.html/>';
    ?>
    <meta property="og:title" content="Tea Break 002"" />
    <meta property=" og:description" content="コンテスト詳細" />
    <meta property="og:image" content="https://2.bp.blogspot.com/-2PgVP0iOkHY/USNoKzJtQlI/AAAAAAAANSI/1xMd2jtWmPA/s1600/cafe_tea.png" />
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark " style="background-color:#a0522d;">
        <a href="$address/" class="navbar-brand">CafeCoder</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navmenu1" aria-controls="navmenu1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navmenu1">
            <div class="navbar-nav">
                <?php
                echo '<a class="nav-item nav-link" href="' . $address . '/">ホーム</a>';
                echo '<a class="nav-item nav-link" href="' . $address . '/Contest.html">コンテスト一覧</a>';
                ?>
            </div>
        </div>
    </nav>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>




    <!--メインコンテンツ-->
    <div class="container">
        <br>
        <div class="card" style="width: auto">
            <div class="card-body">
                <nav class="navbar navbar-expand-sm navbar-light bg-light">

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navmenu1" aria-controls="navmenu1" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navmenu1">
                        <div class="navbar-nav">
                            <?php
                            echo '<a class="nav-item nav-link" href="' . $address . '/tea002">コンテストTOP</a>';
                            echo '<a class="nav-item nav-link" href="' . $address . '/tea002/problem_list.php">問題一覧</a>';
                            echo '<a class="nav-item nav-link" href="' . $address . '/tea002/ranking.php">ランキング</a>';
                            echo '<a class="nav-item nav-link" href="' . $address . '/tea002/my_submit.php">自分の提出</a>';
                            echo '<a class="nav-item nav-link" href="' . $address . '/tea002/all_submit.php">みんなの提出</a>';
                            ?>
                        </div>
                    </div>
                </nav>

                <br>
                <h1>
                    <p class="text-center"><span style="background-color: rgb(209, 209, 209)">Tea Break
                            002</span>
                    </p>
                </h1>
                <br>
                <p class="card-text">
                    ・開催時刻：2019-11-13(水) 21:00:00<br>
                    ・開催時間：90分<br>
                    ・問題数：4問<br>
                    ・writer：otamay, Ultraviolett, sakaki_tohru<br>
                    <s>・ペナルティ：3分</s><br>
                    ・メニュー：Green-Ceylon-Earlgray-Keemun<br>
                    ・注意事項<br>
                    　※プログラミング言語選択が可能となりました。<br>
                    　　現在対応している言語はC(C11)とC++(C++17)とJava8(OpenJDK1.8.0)とPython3(3.6.8)です。<br>
                    　　デフォルトでC(C11)を選択しているので、C++やJava8などで提出する際は注意してください。<br>
                    　※提出する画面は問題文ページに統合されました。<br>
                    　　提出する際は問題文ページの一番下から提出してください。<br>
                </p>
                KakeCoderが帰ってきた！<br>
                豪華作問メンバーと強化された採点システム、ちょっとだけ強くなったセキュリティでコンテストをお届けします。
                <br>参加登録、特設ページを近日公開！<br />

                <br><br>
                <strong>Tea Breakって何？</strong><br>
                AtCoder～茶色までを対象としたコンテストです。作問等も～茶色付近の人が行います。<br>
                問題の質は下がりますが、同じレベルの者同士で和気藹々と競技プログラミングをすることを目的とします。<br>

                <br><br>
                <strong>難易度って何？</strong><br>
                某PGBATTLEの難易度表記が面白かったのでそれを紅茶に置き換えました。<br>
                説明文を見て難易度を察してください。<br>
                難易度は次のようになっています。(下にいくほど難しい)<br>
                Green(緑茶)…みんな大好きな味です。<br>
                Ceylon(セイロン)…クセなくスッキリ味わうことのできる味です。紅茶はセイロンから。<br>
                Darjeeling(ダージリン)…すこしだけ苦味がありますが、香りがとても良いです。<br>
                Uva(ウバ)…セイロンに渋みが加わった味です。しかしダージリン同様香りが良いです。<br>
                Earlgray(アールグレイ)…かなりクセのある香りと味です。好きな人が限定されます。<br>
                Keemun(キームン)…中国茶です。<br>
                ผักชี（パクチー)…誰も飲めないです。<br>
                <br>
                <img src="https://2.bp.blogspot.com/-2PgVP0iOkHY/USNoKzJtQlI/AAAAAAAANSI/1xMd2jtWmPA/s1600/cafe_tea.png">
            </div>
        </div>
    </div>







</body>

</html>