<?php
/** @var mysqli $db */
require_once '../include/database.php';
session_start();
if(isset($_SESSION['username'])){
    header("Location: admin.php");
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>

<body>
    <div class="item">
        <form action="" method="post">
            <div class="subtitle">
                <div class="centerTextAlign">
                    Admin Page
                </div>
            </div>
            <br>
            <?php
            if(isset($_POST['submit'])) {
                if(!empty($_POST['username']) || !empty($_POST['password'])) {
                    $username = mysqli_real_escape_string($db, $_POST['username']);
                    $password = mysqli_real_escape_string($db, $_POST['password']);

                    //database sql query
                    $query = "SELECT password FROM adminlogin WHERE username = '". $username . "'";
                    //runs query on the database
                    $result = mysqli_query($db, $query);

                    //if there is 1 result in the database
                    if (mysqli_num_rows($result) == 1) {
                        //fetches information from database
                        $fetch = mysqli_fetch_assoc($result);
                        //only need password
                        $hash = $fetch['password'];

                        //checks if input pw matches with database pw/hash
                        if (password_verify($password, $hash)){
                            //sets username in a session superglobal
                            $_SESSION['username'] = $username;
                            header("Location: admin.php");
                        }
                        else{
                            //if pw doesnt match with database, show error
                            ?>
                            <p class="pinkText centerTextAlign">Username or Password invalid</p>
                            <?php
                        }
                    }
                    else{
                        //if there is no such username in database
                        echo 'Username or Password invalid';
                    }
                    mysqli_close($db);
                }
                else{
                    //if username or password is empty
                    ?>
                    <p class="pinkText centerTextAlign"> Please enter Username / Password</p>
                    <?php
                }
            }
            ?>
            <div class="centerTextAlign">
                <div class="rules">
                    <input type="text" name="username" placeholder="Username"/>
                    <br>
                    <input type="password" name="password" placeholder="Password"/>
                    <br>
                </div>
                <br>
                <input type="submit" name="submit" value="Log in"/>
            </div>
        </form>
    </div>
</body>

</html>