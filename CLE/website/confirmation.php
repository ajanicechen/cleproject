

<html>
    <head>
        <meta charset="UTF-8">
        <title>Request confirmation</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div class="item">
            <?php
            if (empty($_POST)){
                header("Location: forum.php");
            }
            ?>
            <div class="centerTextAlign">
                Thank you for your request!
            </div>
            <br>
            <table>
                <tr>
                    <td>Name:</td>
                    <td><?= $_POST['Name'];?></td>
                </tr>
                <tr>
                    <td>Twitter:</td>
                    <td><?= $_POST['Twitter'];?></td>
                </tr>
                <tr>
                    <td>E-mail:</td>
                    <td><?= $_POST['E-mail'];?></td>
                </tr>
                <tr>
                    <td>Style:</td>
                    <td><?= $_POST['Style'];?></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><?= $_POST['Description'];?></td>
                </tr>
            </table>
            <br>
            <div class="centerTextAlign">
                <a href="homepage.php">Home</a>
            </div>
        </div>
    </body>
</html>
