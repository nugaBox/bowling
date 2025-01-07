<!-- ====================== INFO ===========================
        Site Name : 가민볼링장 스코어 프로그램 (인턴평가 제출용)
           Author : 장누가
 Development Date : 2019. 5.
======================================================== -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./img/favicon.png">

    <title>가민볼링장 스코어 프로그램</title>

    <!-- CSS -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" >

    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="./js/jquery1.11.2.min.js"></script>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/newdata.js"></script>
</head>
<body>
    <!-- DB 연결 -->
    <?php require_once './pj/dbConnect.php'?>

    <!-- 레이아웃별 페이지 -->
    <?php require_once './view/header.php'?>
    <?php require_once './view/content.php'?>
    <?php require_once './view/footer.php'?>

</body>
</html>
