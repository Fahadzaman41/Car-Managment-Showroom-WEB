<?php
session_start();
$con = mysqli_connect('localhost','root','','car');
if(!$con){
    die('connection error');
}

$error = "";

if(isset($_POST['btn'])){
    $uname = $_POST['un'];
    $pass  = $_POST['ps'];
    $qu    = "SELECT * FROM users WHERE un='$uname' AND ps='$pass'";
    $result = mysqli_query($con,$qu);

    if(mysqli_num_rows($result) == 1){
        $rows = mysqli_fetch_assoc($result);
        $_SESSION['nam'] = $rows['nm'];
        header('location:dashboard.php');
        exit;
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    body {
      font-family: "Segoe UI", Roboto, Arial, sans-serif;
      background-color: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .login-card {
      background: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      width: 350px;
      text-align: center;
    }

    .login-card h2 {
      color: #1877f2;
      margin-bottom: 25px;
    }

    .login-card label {
      display: block;
      text-align: left;
      font-weight: 600;
      margin-top: 15px;
      margin-bottom: 5px;
    }

    .login-card input {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 15px;
      transition: 0.3s;
    }

    .login-card input:focus {
      border-color: #1877f2;
      box-shadow: 0 0 6px rgba(24, 119, 242, 0.3);
      outline: none;
    }

    .login-card button {
      margin-top: 20px;
      width: 100%;
      padding: 12px;
      background-color: #1877f2;
      color: #fff;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
    }

    .login-card button:hover {
      background-color: #0d5bd7;
    }

    .error {
      color: red;
      font-weight: bold;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>

  <div class="login-card">
    <h2><i class="fa-solid fa-user-lock"></i> Login</h2>

    <?php if($error != ""): ?>
      <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="" method="post">
      <label>Username</label>
      <input type="text" name="un" required>

      <label>Password</label>
      <input type="password" name="ps" required>

      <button type="submit" name="btn"><i class="fa-solid fa-right-to-bracket"></i> Login</button>
    </form>
  </div>

</body>
</html>
