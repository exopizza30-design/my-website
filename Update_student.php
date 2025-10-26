<?php
include("connection.php");
session_start();

if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['user_name'];

// Fetch current user details
$query = "SELECT * FROM users WHERE Username = '$username'";
$data = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($data);

if (!$user) {
    echo "<h2 style='color:white;text-align:center;'>No user found!</h2>";
    exit();
}

// Update form submission
if (isset($_POST['update'])) {
    $username_new = $_POST['username'];
    $father = $_POST['father'];
    $mother = $_POST['mother'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $aadhar = $_POST['aadhar'];
    $father_aadhar = $_POST['father_aadhar'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    $update = "UPDATE users SET 
        Username='$username_new',
        Fathersname='$father',
        Mothersname='$mother',
        Email='$email',
        Phonenumber='$phone',
        Aadharno='$aadhar',
        Fathersaadharno='$father_aadhar',
        Dateofbirth='$dob',
        Address='$address',
        Gender='$gender'
        WHERE Username='$username'";

    $result = mysqli_query($conn, $update);

    if ($result) {
        $_SESSION['user_name'] = $username_new;
        echo "<script>window.location='profile.php';</script>";
    } else {
        echo "<script>alert('Error updating profile. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Profile</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
<?php include 'style1.css'; ?> /* 👈 OR paste your CSS here directly if not external */
</style>
</head>
<body>

<div class="form-container">
    <h2>Update Your Details</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $user['Username']; ?>" required>
        </div>

        <div class="form-group">
            <label>Father's Name</label>
            <input type="text" name="father" value="<?php echo $user['Fathersname']; ?>" required>
        </div>

        <div class="form-group">
            <label>Mother's Name</label>
            <input type="text" name="mother" value="<?php echo $user['Mothersname']; ?>" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $user['Email']; ?>" required>
        </div>

        <div class="form-group">
            <label>Phone Number</label>
            <input type="tel" name="phone" value="<?php echo $user['Phonenumber']; ?>" required>
        </div>

        <div class="form-group">
            <label>Aadhar Number</label>
            <input type="text" name="aadhar" value="<?php echo $user['Aadharno']; ?>" required>
        </div>

        <div class="form-group">
            <label>Father's Aadhar Number</label>
            <input type="text" name="father_aadhar" value="<?php echo $user['Fathersaadharno']; ?>" required>
        </div>

        <div class="form-group">
            <label>Date of Birth</label>
            <input type="date" name="dob" value="<?php echo $user['Dateofbirth']; ?>" required>
        </div>

        <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" value="<?php echo $user['Address']; ?>" required>
        </div>
        <div class="form-group">
            <label>Gender</label>
            <div class="radio-group">
                <label><input type="radio" name="gender" value="Male" <?php if($user['Gender']=="Male") echo "checked"; ?>> Male</label>
                <label><input type="radio" name="gender" value="Female" <?php if($user['Gender']=="Female") echo "checked"; ?>> Female</label>
               
        </div>


        <button type="submit" name="update">Update Profile</button>
    </form>
</div>

</body>
</html>
