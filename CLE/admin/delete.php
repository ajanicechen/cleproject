<?php
//includes database file and connects to db
/** @var mysqli $db */
require_once "../include/database.php";

session_start();
//checks if admin is logged in
if(!isset($_SESSION['username'])){
    //redirects to login page if not logged in
    header("Location: login.php");
}

if (isset($_POST['submit'])) {
    // Get the commissions from the database result
    $query = "SELECT * FROM commissions WHERE id = " . mysqli_escape_string($db, $_POST['id']);
    $result = mysqli_query($db, $query) or die ('Error: ' . $query );

    $album = mysqli_fetch_assoc($result);

    // Delete data from the database
    $query = "DELETE FROM commissions WHERE id = " . mysqli_escape_string($db, $_POST['id']);

    mysqli_query($db, $query) or die ('Error: '.mysqli_error($db));

    //Close connection
    mysqli_close($db);

    //Redirect to admin page
    header("Location: admin.php");
    exit;

} else if(isset($_GET['id'])) {
    //Retrieve the GET parameter
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
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Delete Commission <?= $id ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="item centerTextAlign">
        <div class="subtitle">
            Commission ID <?= $id?>
        </div>
        <form action="" method="post">
            <table class="rules">
                <p class="pinkText">Are you sure you want to delete this commission?</p>
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
                <tr  class="trDescription">
                    <td>Description:</td>
                    <td class="description"><?= htmlentities($commissions['description'])?></td>
                </tr>
            </table>

            <br>
            <br>
            <a href="admin.php">No, go back</a>
            <input type="hidden" name="id" value="<?= $commissions['id'] ?>"/>
            <input type="submit" name="submit" value="Yes, delete"/>
        </form>
    </div>
</body>
</html>
