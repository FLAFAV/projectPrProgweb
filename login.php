<?php
    session_start();
    $HOST = "localhost";
    $PASSWORD = "";
    $USER = "root";
    $DB = "kalender";
    
    $conn = mysqli_connect($HOST, $USER, $PASSWORD, $DB);
    if (isset($_SESSION['username'])) {
        header("location:index.php");
    }
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password = hash('sha256', $password);
        $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";

        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['username'] = $row['username'];
            header("location:index.php");
        }
        else { 
            echo "<script>alert('USERNAME ATAU PASSWORD SALAH')</script>";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="loginStyle.css">
</head>
<body>
    
    <div class="box">
        <span class="borderLine"></span>
        <form action="" method="POST" >
            <h2>LOG IN</h2>
            <div class="inputBox">
                <input name="username" type="text" required="required">
                <span>NIM</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input name="password" type="password" required="required">
                <span>Password</span>
                <i></i>
            </div>
            <div class="links">
                <a href="#"></a>
                <a href="signin.php">Sign in</a>
            </div>
            <input type="submit" name="submit" value="Login">
        </form>
    </div>

</body>
</html>


