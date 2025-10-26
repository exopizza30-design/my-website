<?php
include("connection.php");

session_start();
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");



if (isset($_POST['login'])) {
    $username        = $_POST['username'];
    $password        = $_POST['password'];
    $query = "SELECT * FROM users WHERE Username = '$username' && Password='$password'";
    $data  = mysqli_query($conn,$query);
    $total = mysqli_num_rows($data); 
    //echo $total;
if($total == 1){
  $_SESSION['user_name'] = $username;
    header('location:dashboard.php');
}
else{
  echo "Login Failed";
}



}
?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="shortcut icon" type="image/x-icon" href="IMages\1.png">
  <link href="style2.css" rel="stylesheet" type="text/css">
  <link href="css/bootstrap.min.css" rel="stylesheet">  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" rel="stylesheet" type="text/css">
    <script>
    if (window.history && window.history.pushState) {
      window.history.pushState(null, "", window.location.href);
      window.onpopstate = function () {
        window.history.pushState(null, "", window.location.href);
      };
    }
  </script>
</head>



<body>

  <div class="wrapper" >
  
  <!-- Left Container (Welcome / Branding) -->
  <div class="welcome-box" >
      <h1>🎓 Welcome Students</h1>
      <p>Login to access your dashboard, assignments, and more.</p>
      <img src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png" alt="Student Icon">
    </div>

    <!-- Right Container (Login Form) -->
    <div class="login-box">
      <h2>Student Login</h2>
      <p class="msg"></p>
      <form action="" method="post" >
        <div class="input-group">
          <input type="text" id="username" name="username" required autocomplete="off">
          <label for="student-id">Student Name</label>
        </div>

        <div class="input-group">
          <input type="password" id="password" name="password" required autocomplete="off">
          <label for="password">Password</label>
        </div>

        <div class="options">

          <a href="#">Forgot Password?</a>
        </div>

        <button type="submit" class="btn-login" name="login">Login</button>
        <p class="signup-text">New student? <a href="Registration.php" target="_blank">Register Here</a></p>
      </form>
    </div>
  </div>
</body>

</html>




