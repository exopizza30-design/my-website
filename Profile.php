<?php
include("connection.php");
session_start();


// Prevent cache and back navigation after logout
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['user_name'];

// Fetch logged-in user details
$query = "SELECT * FROM users WHERE Username = '$username'";
$data = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($data);

if (!$user) {
    echo "<h2 style='color:white;text-align:center;'>No user found!</h2>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars($user['Username']); ?> - Profile</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" rel="stylesheet">
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }

  html, body {
    width: 100%; height: 100%;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: #fff;
    overflow-x: hidden;
  }

  .profile-container {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
    padding: 20px;
  }

  .profile-card {
    background: linear-gradient(145deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 25px 15px;
    width: 100%;
    max-width: 800px; /* smaller width */
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
  }

  .profile-header {
    text-align: center;
    margin-bottom: 20px;
  }

  .profile-header img {
    width: 80px; height: 80px;
    border-radius: 50%;
    border: 3px solid #fff;
    object-fit: cover;
    margin-bottom: 10px;
  }

  .profile-header h2 {
    font-size: 22px; margin-bottom: 5px;
  }

  .profile-header p {
    font-size: 14px; color: #ddd;
  }

  .profile-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 15px;
  }

  .detail-box {
    background: rgba(255,255,255,0.1);
    border-radius: 12px;
    padding: 15px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .detail-box:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.35);
  }

  .detail-box div {
    display: flex;
    justify-content: space-between;
    border-bottom: 1px solid rgba(255,255,255,0.2);
    padding: 6px 0px;
    font-size: 14px;
  }

  .detail-box div strong {
    color: #ffd966;
  }

  .detail-box div span { color: #fff; }

  .button-container {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 25px;
    flex-wrap: wrap;
  }

  .action-btn {
    padding: 10px 28px;
    border: none;
    border-radius: 25px;
    font-size: 14px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s ease;
    min-width: 120px;
    text-decoration: none;
    text-align: center;
    display: inline-block;
  }

  .logout-btn { background: #ff5e62; color: #fff; }
  .logout-btn:hover { background: #e84343; transform: scale(1.05); }

  .edit-btn { background: #4ade80; color: #fff; }
  .edit-btn:hover { background: #16a34a; transform: scale(1.05); }

  @media (max-width: 600px) {
    .profile-card { padding: 20px 12px; }
    .profile-header img { width: 70px; height: 70px; }
    .detail-box div { font-size: 13px; }
  }
</style>
</head>
<body>
<div class="profile-container">
  <div class="profile-card">
    <div class="profile-header">
      <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Profile">
      <h2><?php echo htmlspecialchars($user['Username']); ?></h2>
      <p>Student Profile</p>
    </div>

    <div class="profile-details">
      <div class="detail-box">
        <div><strong>Username:</strong> <span><?php echo $user['Username']; ?></span></div>
        <div><strong>Father's Name:</strong> <span><?php echo $user['Fathersname']; ?></span></div>
        <div><strong>Mother's Name:</strong> <span><?php echo $user['Mothersname']; ?></span></div>
        <div><strong>Email:</strong> <span><?php echo $user['Email']; ?></span></div>
        <div><strong>Phone:</strong> <span><?php echo $user['Phonenumber']; ?></span></div>
        <div><strong>Gender:</strong> <span><?php echo $user['Gender']; ?></span></div>
      </div>

      <div class="detail-box">
        <div><strong>Aadhar:</strong> <span><?php echo $user['Aadharno']; ?></span></div>
        <div><strong>Father's Aadhar:</strong> <span><?php echo $user['Fathersaadharno']; ?></span></div>
        <div><strong>DOB:</strong> <span><?php echo $user['Dateofbirth']; ?></span></div>
        <div><strong>Address:</strong> <span><?php echo $user['Address']; ?></span></div>
        <div><strong>Password:</strong> <span><?php echo $user['Password']; ?></span></div>
      </div>
    </div>

    <div class="button-container">
      <a href="dashboard.php" class="action-btn logout-btn">Back to Home</a>
      <a href="update_student.php" class="action-btn edit-btn">Edit Your Details</a>
    </div>

  </div>
</div>
</body>
</html>
