<?php
/** @var mysqli $db */
session_start();
//checks if logged in
if(!isset($_SESSION['username'])){
    //redirects to login page
    header("Location: login.php");
}

//connects to database
require_once '../include/database.php';

//selects from commission table
$query = "SELECT * FROM commissions";
$result = mysqli_query($db, $query);

//puts results in array
$commissions = [];
while ($row = mysqli_fetch_assoc($result)){
    $commissions[] = $row;
}
mysqli_close($db);
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="item">
        <table class="adminTable">
            <tr>
                <th>id</th>
                <th>name</th>
                <th>twitter</th>
                <th>email</th>
                <th>style</th>
                <th class="description">description</th>
                <th colspan="2"></th>
                <th><a href="logout.php">Log out</th>
            </tr>
            <?php
                //reads array and puts in table
                foreach($commissions as $value){ ?>
                    <tr>
                        <td><?= $value["id"]?></td>
                        <td><?= $value["name"]?></td>
                        <td><?= $value["twitter"]?></td>
                        <td><?= $value["email"]?></td>
                        <td><?= $value["style"]?></td>
                        <td><?= $value["description"]?></td>
                        <td><a href="details.php?id=<?= $value['id'] ?>">Details</a></td>
                        <td><a href="edit.php?id=<?= $value['id'] ?>">Edit</a></td>
                        <td><a href="delete.php?id=<?= $value['id'] ?>">Delete</a></td>
                    </tr>
                <?php } ?>
        </table>
    </div>
</body>

</html>
