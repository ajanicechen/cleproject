<?php
//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Require database in this file & image helpers
    /** @var mysqli $db */
    require_once "../include/database.php";

    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $name = mysqli_escape_string($db, $_POST['Name']);
    $twitter = mysqli_escape_string($db, $_POST['Twitter']);
    $email = mysqli_escape_string($db, $_POST['E-mail']);
    $style = mysqli_escape_string($db, $_POST['Style']);
    $description = mysqli_escape_string($db, $_POST['Description']);

    require_once "../include/form-validation.php";

    if (empty($errors)) {
        echo 'no errors';
        //Saves commission into the database
        $query = "INSERT INTO commissions (name, twitter, email, style, description)
                  VALUES ('$name', '$twitter', '$email', '$style', '$description')";
        $result = mysqli_query($db, $query)
        or die('Error: '.$query);

        //Close connection
        mysqli_close($db);

        if ($result) {
            header('Location: confirmation.php?Name=' . $name . '&Twitter=' . $twitter . '&E-mail=' . $email . '&Style=' . $style . '&Description=' . $description);
            exit;
        } else {
            $errors[] = 'Something went wrong, please try again';
        }
    }
    else{
        echo 'ERROR';
    }
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Request Forum</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class = "item">
        <form action="" method="post">
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
                    <input class="center-block" type="text" name="Name" placeholder="Name" value="<?= isset($name) ? htmlentities($name) : '' ?>"required><br>
                    <span class="errors"><?= isset($errors['name']) ? $errors['name'] : '' ?></span>

                    <input class="center-block" type="text" name="Twitter" placeholder="Twitter" value="<?= isset($twitter) ? htmlentities($twitter) : '' ?>"required><br>
                    <span class="errors"><?= isset($errors['twitter']) ? $errors['twitter'] : '' ?></span>

                    <input class="center-block" type="email" name="E-mail" placeholder="Email" value="<?= isset($email) ? htmlentities($email) : '' ?>"required>
                    <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
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
                <input type="submit" value="Submit Request!" name="submit">
            </div>
        </form>
    </div>
</body>
</html>