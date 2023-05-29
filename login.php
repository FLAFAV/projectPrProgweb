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
<!doctype html>
<html lang="en">
<head>
  <title>Login</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="loginYandi.css?v=<?php echo time()?>" rel="stylesheet">
</head>
<body>
  <div class="login-box">
    <h2>Login</h2>
    <form method="POST">
      <div class="user-box">
        <input type="text" name="username" required>
        <label>Username</label>
      </div>
      <div class="user-box">
        <input type="password" name="password" required>
        <label>Password</label>
      </div>
      <input type="submit" value="submit" name = "submit" id="submit" style="display:none;">

        <a href="#">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <label for="submit">Submit</label>
        </a>

    </form>
  </div>
</body>
</html>