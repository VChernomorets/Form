<?php
session_start();
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=EB+Garamond|Open+Sans" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/slick.css"/>
    <link rel="stylesheet" type="text/css" href="css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Document</title>
</head>
<body>
<section>
    <div class="left-content">
        <div class="slider"></div>
    </div>
    <div class="right-content">
        <h1 class="right-content__head">Game of thrones</h1>
        <?php
        if (!isset($_SESSION['aboutMeForm'])) {
            include_once("views/registration.php");
        } else {
            include_once("views/aboutForm.php");
        }
        ?>
    </div>
</section>
<script type="text/javascript" src="js/select2.min.js"></script>
<script type="text/javascript" src="js/slick.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>