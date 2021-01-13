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
    //Postback with the data showed to the user, first retrieve data
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
            header('Location: admin.php');
            exit;
        } else {
            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }

    }
}
else if (isset($_GET['id'])) {
    //Retrieve the GET parameter
    $id = $_GET['id'];

    //Get the commission from the database result
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
    <title>Edit Commission <?= $id ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class = "item">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="subtitle">
                <div class = "centerTextAlign">
                    Commission ID <?= $id ?>
                </div>
            </div>
            <br>
            <div class="rules">
                <div class="centerTextAlign">
                    Edit
                    <br>
                    <br>
                    <span><?= isset($errors['name']) ? $errors['name'] : '' ?></span>
                    <input class="center-block" type="text" name="name" placeholder="Name" value="<?= htmlentities($commissions['name']) ?>"><br>

                    <span><?= isset($errors['twitter']) ? $errors['twitter'] : '' ?></span>
                    <input class="center-block" type="text" name="twitter" placeholder="Twitter" value="<?= htmlentities($commissions['twitter']) ?>"><br>

                    <span><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
                    <input class="center-block" type="email" name="email" placeholder="Email" value="<?= htmlentities($commissions['email']) ?>"><br>

                    <span><?= isset($errors['style']) ? $errors['style'] : '' ?></span>
                    <input class="center-block" type="text" name="style" placeholder="Style" value="<?= htmlentities($commissions['style']) ?>"><br>

                    <span><?= isset($errors['description']) ? $errors['description'] : '' ?></span><br>
                    <textarea class="center-block" name="description" placeholder="Please enter commission details (´｡• ᵕ •｡`)/)"><?= htmlentities($commissions['description']) ?></textarea>
                </div>
            </div>
            <br>
            <br>
            <div class="centerTextAlign">
                <a href="admin.php">Back</a>
                <input type="hidden" name="id" value="<?= $id ?>"/>
                <input type="submit" value="Save!" name="submit">
            </div>
        </form>
</div>
</body>
</html>
