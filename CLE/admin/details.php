<?php
//include and connects to database
/** @var mysqli $db */
require_once "../include/database.php";

session_start();
//checks if admin is logged in
//if admin is not in session
if(!isset($_SESSION['username'])){
    //redirect to login page
    header("Location: login.php");
}

//if id is present in url
if(isset($_GET['id'])) {
    //Retrieve the id
    $id = $_GET['id'];

    //query to get data from the database
    $query = "SELECT * FROM commissions WHERE id = " . mysqli_escape_string($db, $id);
    //runs query on database and puts result in $result
    $result = mysqli_query($db, $query) or die ('Error: ' . $query );

    //if there is exactly one result
    if(mysqli_num_rows($result) == 1) {
        //fetches data and put in $commissions to read
        $commissions = mysqli_fetch_assoc($result);
    }
    //if not exactly one result
    else {
        // redirect when database returns no result
        header('Location: admin.php');
        exit;
    }
}
//if id is not present in url or form was not submitted
else {
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
    <title>Details Commission <?= $id ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="item centerTextAlign">
    <div class="subtitle">
        Commission ID <?= $id?>
    </div>
    <form action="" method="post">
        <table class="rules">
            <p class="pinkText">Details</p>
            <tr>
                <td>Name:</td>
                <td><?= htmlentities($commissions['name'])?></td>
            </tr>
            <tr>
                <td>Twitter:</td>
                <td><?= htmlentities($commissions['twitter'])?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?= htmlentities($commissions['email'])?></td>
            </tr>
            <tr>
                <td>Style:</td>
                <td><?= htmlentities($commissions['style'])?></td>
            </tr>
            <tr class="trDescription">
                <td>Description:</td>
                <td class="description"><?= htmlentities($commissions['description'])?></td>
            </tr>
        </table>
        <br>
        <br>
        <a href="admin.php">Back to commissions</a>
    </form>
</div>
</body>
</html>