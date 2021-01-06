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
                    <td><span class="errors"><?= isset($_GET['Name']) ? $_GET['Name'] : '' ?></span></td>
                </tr>
                <tr>
                    <td>Twitter:</td>
                    <td><span class="errors"><?= isset($_GET['Twitter']) ? $_GET['Twitter'] : '' ?></span></td>

                </tr>
                <tr>
                    <td>E-mail:</td>
                    <td><span class="errors"><?= isset($_GET['E-mail']) ? $_GET['E-mail'] : '' ?></span></td>

                </tr>
                <tr>
                    <td>Style:</td>
                    <td><span class="errors"><?= isset($_GET['Style']) ? $_GET['Style'] : '' ?></span></td>

                </tr>
                <tr>
                    <td>Description:</td>
                    <td><span class="errors"><?= isset($_GET['Description']) ? str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n"),"<br/>",$_GET['Description']) : '' ?></span></td>
                </tr>
            </table>
            <br>
            <div class="centerTextAlign">
                <a href="index.php">Home</a>
            </div>
        </div>
    </body>
</html>
