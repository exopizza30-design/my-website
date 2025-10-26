<?php
include("connection.php");
session_start();
$userprofile=$_SESSION['user_name'];



if($userprofile == true){

}
else{

  header('location:Login.php');    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Dashboard</title>
  <link rel="stylesheet" href="style4.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
  <!-- Mobile Sidebar Toggle -->
  <input type="checkbox" id="menu-toggle" />
  <label for="menu-toggle" class="menu-icon">&#9776;</label>
  
  <!-- Sidebar -->
  <aside class="sidebar">
    <h2>Dashboard</h2>
    <ul>
      <li><a href="dashboard.php" class="active">🏠 Home</a></li>
      <li><a href="#">📚 Courses</a></li>
      <li><a href="#">🧾 Assignments</a></li>
      <li><a href="result.php">📊 Results</a></li>
      <li><a href="Profile.php">👤 Profile</a></li>
      <li><a href="LogOut.php">🚪 Logout</a></li>
    </ul>
  </aside>

  <!-- Main Content -->
  <main class="main-content">
    
    <!-- Top Bar -->
    <header class="topbar">
      <h1><?php echo "welcome ".$_SESSION['user_name'];   ?></h1>
      <div class="user-info">
        <img src="IMages/1.png" alt="User">
        <span><?php echo "".$_SESSION['user_name'];   ?></span>
      </div>
    </header>

    <!-- Dashboard Cards -->
    <section class="cards">
      <div class="card">
        <h3>Enrolled Courses</h3>
        <p>8 Courses</p>
      </div>
      <div class="card">
        <h3>Assignments Due</h3>
        <p>3 Pending</p>
      </div>
      <div class="card">
        <h3>Attendance</h3>
        <p>92%</p>
      </div>
      <div class="card">
        <h3>Overall Grade</h3>
        <p>A+</p>
      </div>
    </section>

    <!-- Table Section -->
    <section class="table-section">
      <h2>Recent Grades</h2>
      <table>
        <thead>
          <tr>
            <th>Subject</th>
            <th>Assignment</th>
            <th>Grade</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Mathematics</td>
            <td>Algebra Test</td>
            <td>A</td>
          </tr>
          <tr>
            <td>Science</td>
            <td>Lab Report</td>
            <td>B+</td>
          </tr>
          <tr>
            <td>English</td>
            <td>Essay</td>
            <td>A+</td>
          </tr>
        </tbody>
      </table>
    </section>
  </main>
</body>
</html>
