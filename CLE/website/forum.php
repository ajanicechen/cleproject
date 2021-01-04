

<?php

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Request Forum</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class = "item">
        <form action="confirmation.php" method="post">
            <div class="subtitle">
                <div class = "centerTextAlign">
                    Request forum
                </div>
            </div>
            <br>
            <div class="rules">
                <table>
                    <tr>
                    <td>Contact</td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td><input type="text" name="Name" required></td>
                    </tr>
                    <tr>
                        <td>Twitter</td>
                        <td><input type="text" name="Twitter" required></td>
                    </tr>
                    <tr>
                        <td> E-mail</td>
                        <td><input type="email" name="E-mail" required></td>
                    </tr>
                </table>
            <br>
            In what style would you like to commission?
            <br>

            <input type="radio" name="Style" value="Cartoon" required>
            Cartoon €15,-
            <br>

            <input type="radio" name="Style" value="Full Body" required>
            Full Body €25,-
            <br>

            <input type="radio" name="Style" value="90s Anime" required>
            90's Anime €30,-
            <br>
            <br>

            Description
            <br>
            <textarea name="Description" rows="4" cols="40" placeholder="Please enter commission details (´｡• ᵕ •｡`)/)"></textarea>
            </div>
            <br>
            <br>

            <input type="submit" value="Submit Request!">


        </form>
    </div>
</body>
</html>