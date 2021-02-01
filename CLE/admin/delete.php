<?php
//includes database file and connects to db
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
    // Delete data from the database
    $query = "DELETE FROM commissions WHERE id = " . mysqli_escape_string($db, $_POST['id']);

    //runs query on database, or stop the query if error and show error
    mysqli_query($db, $query) or die ('Error: '.mysqli_error($db));

    //Close connection to db
    mysqli_close($db);

    //Redirect to admin page
    header("Location: admin.php");
    exit;

}
//if submit is not pressed/the page is loaded for first time
//if id is present in url
else if(isset($_GET['id'])) {
    //Retrieve the id from url
    $id = $_GET['id'];

    //query to get data from the database
    $query = "SELECT * FROM commissions WHERE id = " . mysqli_escape_string($db, $id);
    //runs query on database and put it in $result
    $result = mysqli_query($db, $query) or die ('Error: ' . $query );

    //if there is exactly one result
    if(mysqli_num_rows($result) == 1) {
        //fetches data and put data in $commissions to read
        $commissions = mysqli_fetch_assoc($result);
    }
    //if not exactly one result
    else {
        // redirect when database returns no result
        header('Location: admin.php');
        exit;
    }
}
//if id is not present in url
else {
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
