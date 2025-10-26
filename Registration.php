<?php 
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
  <link rel="shortcut icon" type="image/x-icon" href="IMages/1.png">
  <link href="style1.css" rel="stylesheet" type="text/css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <div class="form-container">
    <h2>Student Registration Form</h2>
    <form class="form-grid" action="Registration.php" method="post" autocomplete="off">
      <div class="form-group">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="name" required>
      </div>

      <div class="form-group">
        <label for="fathername">Father's Name</label>
        <input type="text" id="fathername" name="fathername" required>
      </div>

      <div class="form-group">
        <label for="mothername">Mother's Name</label>
        <input type="text" id="mothername" name="mothername" required>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>

      <div class="form-group">
        <label for="aadhar">Aadhar No.</label>
        <input type="text" id="aadhar" name="aadhar" pattern="[0-9]{12}" required>
      </div>

      <div class="form-group">
        <label for="aadharfather">Father's Aadhar No.</label>
        <input type="text" id="aadharfather" name="aadharfather" pattern="[0-9]{12}" required>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <div style="position: relative;">
          <input type="password" id="password" name="password" required>
          <i class="fa fa-eye" id="togglePassword" style="position:absolute; right:10px; top:16px; cursor:pointer;"></i>
        </div>
      </div>
      
      <div class="form-group">
        <label for="confirmpassword">Confirm Password</label>
        <div style="position: relative;">
          <input type="password" id="confirmpassword" name="confirmpassword" required>
          <i class="fa fa-eye" id="toggleConfirmPassword" style="position:absolute; right:10px; top:16px; cursor:pointer;"></i>
        </div>
      </div>
      
      <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required>
      </div>

      <div class="form-group">
        <label for="dob">Date of Birth</label>
        <input type="date" id="dob" name="dob" required>
      </div>

      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" id="address" name="address" required>
      </div>

      <div class="form-group">
        <label>Gender</label>
        <div class="radio-group">
          <label><input type="radio" name="gender_type" value="Male" required> Male</label>
          <label><input type="radio" name="gender_type" value="Female" required> Female</label>
        </div>
      </div>

      <button type="submit" name="submit">Register</button>
    </form>
  </div>

  <script>
    // 🔹 Toggle Password Visibility
    const togglePassword = document.querySelector('#togglePassword');
    const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
    const password = document.querySelector('#password');
    const confirmPassword = document.querySelector('#confirmpassword');

    togglePassword.addEventListener('click', function() {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      this.classList.toggle('fa-eye-slash');
    });

    toggleConfirmPassword.addEventListener('click', function() {
      const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
      confirmPassword.setAttribute('type', type);
      this.classList.toggle('fa-eye-slash');
    });
  </script>
</body>
</html>

<?php
// ---------------------------
// Server-side processing
// ---------------------------

if (isset($_POST['submit'])) {
    // Trim and collect inputs safely
    $username        = trim($_POST['name'] ?? '');
    $fathername      = trim($_POST['fathername'] ?? '');
    $mothername      = trim($_POST['mothername'] ?? '');
    $email_raw       = trim($_POST['email'] ?? '');
    $email           = strtolower($email_raw);
    $aadhar          = trim($_POST['aadhar'] ?? '');
    $aadharfather    = trim($_POST['aadharfather'] ?? '');
    $password        = $_POST['password'] ?? '';
    $confirmpassword = $_POST['confirmpassword'] ?? '';
    $phone           = trim($_POST['phone'] ?? '');
    $dob             = trim($_POST['dob'] ?? '');
    $address         = trim($_POST['address'] ?? '');
    $gender_type     = trim($_POST['gender_type'] ?? '');

    // Basic validation
    if (empty($username) || empty($email) || empty($password)) {
        echo "<script>alert('❌ Name, Email and Password are required.');</script>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('❌ Invalid email address.');</script>";
        exit;
    }

    if ($password !== $confirmpassword) {
        echo "<script>alert('❌ Passwords do not match! Data not saved.');</script>";
        exit;
    }

    // ---------------------------
    // 1) Check if email already exists
    // ---------------------------
    $checkQuery = "SELECT id FROM USERS WHERE Email = ? LIMIT 1";
    if ($checkStmt = $conn->prepare($checkQuery)) {
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $checkStmt->store_result();
        if ($checkStmt->num_rows > 0) {
            // Email already registered
            echo "<script>alert('❌ This email is already registered. Please use another email or login.');</script>";
            $checkStmt->close();
            exit;
        }
        $checkStmt->close();
    } else {
        // prepare failed
        $err = addslashes($conn->error);
        echo "<script>alert('❌ Database error (check prepare failed): $err');</script>";
        exit;
    }

    // ---------------------------
    // 2) Insert new user (hash password)
    // ---------------------------
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $insertQuery = "INSERT INTO USERS (Username, Fathersname, Mothersname, Email, Aadharno, Fathersaadharno, Password, Phonenumber, Dateofbirth, Address, Gender)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($insertQuery)) {
        $stmt->bind_param("sssssssssss", $username, $fathername, $mothername, $email, $aadhar, $aadharfather, $password_hash, $phone, $dob, $address, $gender_type);

        if ($stmt->execute()) {
            // Success: redirect to login (JS redirect to avoid header issues)
            echo "<script>
                    alert('✅ Registration successful! Redirecting to login...');
                    window.location.href = 'login.php';
                  </script>";
            $stmt->close();
            exit;
        } else {
            // Handle possible duplicate race-condition or other DB errors
            $errno = $conn->errno;
            $dberr = addslashes($conn->error);
            if ($errno === 1062) { // duplicate entry error code
                echo "<script>alert('❌ Email already registered (duplicate).');</script>";
            } else {
                echo "<script>alert('❌ Failed to insert data! Database error: $dberr (ErrNo: $errno)');</script>";
            }
            $stmt->close();
            exit;
        }
    } else {
        $err = addslashes($conn->error);
        echo "<script>alert('❌ Database prepare() failed: $err');</script>";
        exit;
    }
}
?>
