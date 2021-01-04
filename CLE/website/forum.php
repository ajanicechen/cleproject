

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
                <div class="centerTextAlign">
                    Please fill in this form!
                    <br>
                    <br>
                    <input class="center-block" type="text" name="Name" placeholder="Name" required><br>
                    <input class="center-block" type="text" name="Twitter" placeholder="Twitter" required><br>
                    <input class="center-block" type="email" name="E-mail" placeholder="Email" required>
                </div>
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
                <div class="centerTextAlign">
                    <textarea name="Description" placeholder="Please enter commission details (´｡• ᵕ •｡`)/)"></textarea>
                </div>
            </div>
            <br>
            <br>
            <div class="centerTextAlign">
                <input type="submit" value="Submit Request!">
            </div>
        </form>
    </div>
</body>
</html>