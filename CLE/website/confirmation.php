<?php
// (=´∇｀=)
// (=｀ω´=)
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Request confirmation</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div class="item">
            <?php
            if (empty($_GET)){
                header("Location: forum.php");
            }
            ?>
            <div class="centerTextAlign subtitle">
                Thank you for your <br> request!
            </div>
            <br>
            <table class="rules">
                <tr>
                    <td>Name:</td>
                    <td><?= $_GET['Name'];?></td>
                </tr>
                <tr>
                    <td>Twitter:</td>
                    <td><?= $_GET['Twitter'];?></td>
                </tr>
                <tr>
                    <td>E-mail:</td>
                    <td><?= $_GET['E-mail'];?></td>
                </tr>
                <tr>
                    <td>Style:</td>
                    <td><?= $_GET['Style'];?></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><?= $_GET['Description'];?></td>
                </tr>
            </table>
            <br>
            <div class="centerTextAlign">
                <a href="index.php">Home</a>
            </div>
        </div>
    </body>
</html>
