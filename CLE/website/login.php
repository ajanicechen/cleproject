<?php
require_once '../include/database.php';
session_start();
if(isset($_SESSION['username'])){
    //header("Location: admin.php");
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Hakizen's Commissions!</title>
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

                    if (mysqli_num_rows($result)== false) {
                        //if there is no such username
                        echo 'Username or Password invalid';
                    }
                    else{
                        //gets hashed pw
                        $hash = mysqli_fetch_assoc($result);
                        $hash = $hash['password'];

                        //checks password
                        if (password_verify($password, $hash)){
                            $_SESSION['username'] = $username;
                            header("Location: admin.php");
                        }
                        else{
                            echo 'Username or Password invalid';
                        }
                    }
                    mysqli_close($db);
                }
                else{
                    echo 'Please enter Username and Password';
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