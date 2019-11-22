<?php

include("../../signin.php");
if(!is_signin(basename(getcwd()))){
    echo "ログインしてください。";
    exit();
}

?>
<!doctype html>
<html lang="ja">

<head>
    <?php include_once "../../../template/head.php" ?>

    <title>UserPage</title>

    <meta property="og:url" content="https://www.kakecoder.com"/>
    <meta property="og:title" content="KakeCoder" />
    <meta property=" og:description" content="喫茶店的プログラミングコンテストサイトです。"/>
    <meta property="og:image" content="https://2.bp.blogspot.com/-2PgVP0iOkHY/USNoKzJtQlI/AAAAAAAANSI/1xMd2jtWmPA/s1600/cafe_tea.png" />

</head>

<body>
   <?php include_once "../../../template/nav.php" ?> 

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
<!--メインコンテンツ-->
<?php
include("../template/usercard.php");
?>

</body>

</html>
