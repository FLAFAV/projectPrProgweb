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
  <title>login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="loginYandi.css?v=<?php echo time() ?>" rel="stylesheet">
</head>
<body>
  <div class="login-box">
      <div class="form">
        <form class="login-form" method="POST">
          <input type="text" name="username" placeholder="꧋ꦤꦩ" required/>
          <input type="password" name = "password" placeholder="꧋ꦥꦱ꧀ꦱ꧀ꦮꦺꦴꦂꦣ꧀"/>
          <input class = "button" type="submit" name = "submit" value="꧋ꦩꦱꦸꦏ꧀ꦩꦱ꧀" required>
          <!-- <button>꧋ꦩꦱꦸꦏ꧀ꦩꦱ꧀</button> -->
        </form>
      </div>
  </div>
</body>
</html>