<?php
$success = false;
//Checks if submit button is clicked on
if (isset($_POST['submit'])) {
    /** @var mysqli $db */
    //includes connection to database
    require_once "../include/database.php";

    //if style isset then protect from sql injections
    if (isset($_POST['style'])){
        $style = mysqli_escape_string($db, $_POST['style']);
    }
    //if not isset, show error
    else {
        $errors['style'] = '!! Style cannot be empty !!' . '<br>';
        $style='';
    }

    //receives all input from form and protects input from sql injections
    $name = mysqli_escape_string($db, $_POST['name']);
    $twitter = mysqli_escape_string($db, $_POST['twitter']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $description = mysqli_escape_string($db, $_POST['description']);

    require_once "../include/form-validation.php";

    if (empty($errors)) {
        //query to save commission into the database
        $query = "INSERT INTO commissions (name, twitter, email, style, description)
                  VALUES ('$name', '$twitter', '$email', '$style', '$description')";
        $result = mysqli_query($db, $query)
        or die('Error: '.$query);

        //Close connection to database
        mysqli_close($db);

        if ($result) {
            $success = true;
        } else {
            $errors[] = 'Something went wrong, please try again';
        }
    }
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Request Form</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class = "item">
        <?php
        //if commission is made, show confirmation
        if ($success){ ?>
        <div class="centerTextAlign subtitle">
            Thank you for your <br> request!
        </div>
        <br>
        <table class="rules">
            <tr>
                <td>Name:</td>
                <td><span><?= htmlentities($name); ?></span></td>
            </tr>
            <tr>
                <td>Twitter:</td>
                <td><span><?= htmlentities($twitter); ?></span></td>

            </tr>
            <tr>
                <td>E-mail:</td>
                <td><span><?= htmlentities($email); ?></span></td>

            </tr>
            <tr>
                <td>Style:</td>
                <td><span><?= htmlentities($style); ?></span></td>

            </tr>
            <tr>
                <td>Description:</td>
                <td><span><?= str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n"),"<br/>",htmlentities($description)); ?></span></td>
            </tr>
        </table>
        <br>
        <div class="centerTextAlign">
            <a href="index.php">Home</a>
        </div>

        <?php
        //else show request forum
        } else { ?>
        <form action="" method="post">
            <div class="subtitle">
                <div class = "centerTextAlign">
                    Request form
                </div>
            </div>
            <br>
            <div class="rules">
                <div class="centerTextAlign">
                    Please fill in this form!
                    <br>
                    <br>
                    <span class="pinkText"><?= isset($errors['name']) ? $errors['name'] : '' ?></span>
                    <input class="center-block" type="text" name="name" placeholder="Name" value="<?= isset($name) ? htmlentities($name) : '' ?>"><br>

                    <span class="pinkText"><?= isset($errors['twitter']) ? $errors['twitter'] : '' ?></span>
                    <input class="center-block" type="text" name="twitter" placeholder="Twitter" value="<?= isset($twitter) ? htmlentities($twitter) : '' ?>"><br>

                    <span class="pinkText"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
                    <input class="center-block" type="email" name="email" placeholder="E-mail" value="<?= isset($email) ? htmlentities($email) : '' ?>"><br>
                </div>
                <br>
                <span class="pinkText"><?= isset($errors['style']) ? $errors['style'] : '' ?> <br> </span>
                In what style would you like to commission?
                <br>
                <input type="radio" name="style" value="Cartoon">
                Cartoon €15,-
                <br>

                <input type="radio" name="style" value="Full Body">
                Full Body €25,-
                <br>

                <input type="radio" name="style" value="90s Anime">
                90's Anime €30,-
                <br>
                <br>
                <div class="centerTextAlign">
                    <span class="pinkText"><?= isset($errors['description']) ? $errors['description'] : '' ?> <br></span>
                    <textarea name="description" placeholder="Please enter commission details (´｡• ᵕ •｡`)/)" ><?= isset($description) ? htmlentities($description) : '' ?></textarea>
                </div>
            </div>
            <br>
            <br>
            <div class="centerTextAlign">
                <input type="submit" value="Submit Request!" name="submit">
            </div>
        </form>
        <?php } ?>
    </div>
</body>
</html>