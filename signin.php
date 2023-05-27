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
        $sql = "SELECT * FROM user WHERE username = '$username'";
        
        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            echo "<script>alert('USERNAME SUDAH ADA')</script>";
        }
        else {
            $sql = "INSERT INTO user VALUES('$username', '$password')"; 
            mysqli_query($conn, $sql);
            echo "<script>alert('SIGN UP BERHASIL')</script>";

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
            <h2>SIGN UP</h2>
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
                <a href="login.php">Log in</a>
            </div>
            <input type="submit" name="submit" value="Sign up">
        </form>
    </div>

</body>
</html>


