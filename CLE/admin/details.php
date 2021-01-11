<?php
//requires database, include database
/** @var mysqli $db */
require_once "../include/database.php";

// redirect when id was not set/not found
if(!isset($_GET['id'])) {
    // redirects back to admin page
    header('Location: admin.php');
    exit;
}

if(isset($_GET['id'])) {
    //Retrieve the GET parameter from the 'Super global'
    $id = $_GET['id'];

    //Get data from the database result
    $query = "SELECT * FROM commissions WHERE id = " . mysqli_escape_string($db, $id);
    $result = mysqli_query($db, $query) or die ('Error: ' . $query );

    if(mysqli_num_rows($result) == 1)
    {
        $commissions = mysqli_fetch_assoc($result);
    }
    else {
        // redirect when database returns no result
        header('Location: admin.php');
        exit;
    }
} else {
    // Id was not present in the url OR the form was not submitted
    // redirect to admin page
    header('Location: admin.php');
    exit;
}

//Close connection
mysqli_close($db);
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Details commission <?= $commissions['id'] ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="item centerTextAlign">
    <div class="subtitle">
        Commission ID <?= $commissions['id']?>
    </div>
    <form action="" method="post">
        <table class="rules">
            <p class="pinkText">Details</p>
            <tr>
                <td>Name:</td>
                <td><?= $commissions['name']?></td>
            </tr>
            <tr>
                <td>Twitter:</td>
                <td><?= $commissions['twitter']?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?= $commissions['email']?></td>
            </tr>
            <tr>
                <td>Style:</td>
                <td><?= $commissions['style']?></td>
            </tr>
            <tr>
                <td>Description:</td>
                <td class="description"><?= $commissions['description']?></td>
            </tr>
        </table>
        <br>
        <br>
        <a href="admin.php">Back to commissions</a>
    </form>
</div>
</body>
</html>