<?php
/** @var mysqli $db */
require_once "../include/database.php";

session_start();
//checks if admin is logged in
//if admin is not in session
if(!isset($_SESSION['username'])){
    //redirects to login page
    header("Location: login.php");
}
//if submit is clicked
if (isset($_POST['submit'])) {
    //receive data from edit and protect from sql injections
    $id = mysqli_escape_string($db, $_POST['id']);
    $name = mysqli_escape_string($db, $_POST['name']);
    $twitter = mysqli_escape_string($db, $_POST['twitter']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $style = mysqli_escape_string($db, $_POST['style']);
    $description = mysqli_escape_string($db, $_POST['description']);

    //Require the form validation handling
    require_once "../include/form-validation.php";

    //Save variables to array
    $commissions = [
        'name' => $name,
        'twitter' => $twitter,
        'email' => $email,
        'style' => $style,
        'description' => $description,
    ];

    //if no errors
    if (empty($errors)) {
        //query to update the commission information in the database
        $query = "UPDATE commissions
                  SET name = '$name', twitter = '$twitter', email = '$email', style = '$style', description = '$description'
                  WHERE id = '$id'";
        //runs the query on database and put result in $result
        $result = mysqli_query($db, $query);
        //fetches data and put it in $commissions to read data
        $commissions = mysqli_fetch_assoc($result);

        //if query is run
        if ($result) {
            //redirect to admin page
            header('Location: admin.php');
            exit;
        } else {
            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }

    }
}

//if submit is not pressed/page is loaded for the first time
// if there is an id in url
else if (isset($_GET['id'])) {
    //Retrieve the id from url
    $id = $_GET['id'];

    //query to get commission from the database
    $query = "SELECT * FROM commissions WHERE id = " . mysqli_escape_string($db, $id);
    //runs query in database and puts result in $result
    $result = mysqli_query($db, $query);

    //if there is exactly 1 result
    if (mysqli_num_rows($result) == 1) {
        //fetches data and put in $commissions to read data
        $commissions = mysqli_fetch_assoc($result);

    }
    //if there is not exactly 1 result
    else {
        // redirect to admin
        header('Location: admin.php');
        exit;
    }
}
//if there is no id in url
else {
    //redirect to admin
    header('Location: admin.php');
    exit;
}

//Close connection to db
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
