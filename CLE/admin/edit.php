<?php
/** @var mysqli $db */
require_once "../include/database.php";

session_start();
//checks if logged in
if(!isset($_SESSION['username'])){
    //redirects to login page
    header("Location: login.php");
}
//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $id = mysqli_escape_string($db, $_POST['id']);
    $name = mysqli_escape_string($db, $_POST['name']);
    $twitter = mysqli_escape_string($db, $_POST['twitter']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $style = mysqli_escape_string($db, $_POST['style']);
    $description = mysqli_escape_string($db, $_POST['description']);

    //Require the form validation handling
    require_once "../include/form-validation.php";

    //Save variables to array so the form won't break
    //This array is build the same way as the db result
    $commissions = [
        'name' => $name,
        'twitter' => $twitter,
        'email' => $email,
        'style' => $style,
        'description' => $description,
    ];

    if (empty($errors)) {
        //Update the commission in the database
        $query = "UPDATE commissions
                  SET name = '$name', twitter = '$twitter', email = '$email', style = '$style', description = '$description'
                  WHERE id = '$id'";
        $result = mysqli_query($db, $query);
        $commissions = mysqli_fetch_assoc($result);

        if ($result) {
            header('Location: details.php');
            exit;
        } else {
            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }

    }
}
else if (isset($_GET['id'])) {
    //Retrieve the GET parameter from the 'Super global'
    $id = $_GET['id'];

    //Get the record from the database result
    $query = "SELECT * FROM commissions WHERE id = " . mysqli_escape_string($db, $id);
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 1) {
        $commissions = mysqli_fetch_assoc($result);
    } else {
        // redirect when db returns no result
        header('Location: admin.php');
        exit;
    }
} else {
    header('Location: admin.php');
    exit;
}


//Close connection
mysqli_close($db);
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit commission <?= $commissions['id'] ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class = "item">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="subtitle">
                <div class = "centerTextAlign">
                    Commission ID <?= $commissions['id'] ?>
                </div>
            </div>
            <br>
            <div class="rules">
                <div class="centerTextAlign">
                    Edit
                    <br>
                    <br>
                    <input class="center-block" type="text" name="Name" placeholder="Name" value="<?= htmlentities($commissions['name']) ?>"><br>

                    <input class="center-block" type="text" name="Twitter" placeholder="Twitter" value="<?= htmlentities($commissions['twitter']) ?>"><br>

                    <input class="center-block" type="email" name="E-mail" placeholder="Email" value="<?= htmlentities($commissions['email']) ?>">

                    <input class="center-block" type="text" name="Style" placeholder="Style" value="<?= htmlentities($commissions['style']) ?>">

                    <textarea class="center-block" name="Description" placeholder="Please enter commission details (´｡• ᵕ •｡`)/)"><?= htmlentities($commissions['description']) ?></textarea>
                </div>
            </div>
            <br>
            <br>
            <div class="centerTextAlign">
                <input type="hidden" name="id" value="<?= $id ?>"/>
                <input type="submit" value="Save!" name="submit">
            </div>
        </form>
</div>
</body>
</html>
