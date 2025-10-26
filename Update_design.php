<?php
include("connection.php");
$id = $_GET['id'];

$query  = "SELECT * FROM users where id= '$id'";
$data   =  mysqli_query($conn, $query);


$total  = mysqli_num_rows($data);
$result = mysqli_fetch_assoc($data);




?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Student Details</title>
  <link rel="shortcut icon" type="image/x-icon" href="IMages\1.png">
  <link href="style3.css" rel="stylesheet" type="text/css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 

</head>



<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <div class="form-container">


    <h2>Update Student Details</h2>
    <form class="form-grid" action="" method="post">
      <div class="form-group">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="name" value="<?php echo $result['Username'];?>">
      </div>


      <div class="form-group">
        <label for="fathername">Father's Name</label>
        <input type="text" id="fathername" name="fathername"  value="<?php echo $result['Fathersname'];?>"  required>
      </div>


      <div class="form-group">
        <label for="mothername">Mother's Name</label>
        <input type="text" id="mothername" name="mothername"   value="<?php echo $result['Mothersname'];?>"  required>
      </div>


      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email"  value="<?php echo $result['Email'];?>" required>
      </div>

      <div class="form-group">
        <label for="aadhar"> Aadhar No.</label>
        <input type="text" id="aadhar" name="aadhar" pattern="[0-9]{12}"  value="<?php echo $result['Aadharno'];?>" required>
      </div>


      <div class="form-group">
        <label for="aadharfather">Father's Aadhar No.</label>
        <input type="text" id="aadharfather" name="aadharfather"  pattern="[0-9]{12}" value="<?php echo $result['Fathersaadharno'];?>" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" value="<?php echo $result['Password'];?>" required>
      </div>
      
      <div class="form-group">
        <label for="confirmpassword">Confirm Password</label>
        <input type="password" id="confirmpassword" name="confirmpassword" value="<?php echo $result['Password'];?>" required>
      </div>
      
      <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" value="<?php echo $result['Phonenumber'];?>" required>
      </div>


      <div class="form-group">
        <label for="dob">Date of Birth</label>
        <input type="date" id="dob" name="dob" value="<?php echo $result['Dateofbirth'];?>" required>
      </div>





      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" id="address" name="address" value="<?php echo $result['Address'];?>" required>
      </div>


      <div class="form-group">
        <label>Gender</label>
        <div class="radio-group" value="<?php echo $result['Gender'];?>">
          <label><input type="radio" name="gender_type" value="Male"  required 
          <?php  
            if($result['Gender'] == "Male")
            {
                echo "checked";
            }
          ?>
          > Male</label>
          <label><input type="radio" name="gender_type" value="Female" required
          <?php  
            if($result['Gender'] == "Female")
            {
                echo "checked";
            }
          ?>
          
          > Female</label>
        </div>
      </div>


      <button type="submit" name="Update"  >Update Student Details</button>
    </form>
  </div>
</body>

</html>





<?php
    if(isset($_POST['Update']))
      {
      $username         = $_POST['name'];
      $fathername       = $_POST['fathername'];
      $mothername       = $_POST['mothername'];
      $email            = $_POST['email'];
      $aadhar           = $_POST['aadhar'];
      $aadharfather     = $_POST['aadharfather'];
      $password         = $_POST['password'];
      $confirmpassword  = $_POST['confirmpassword'];
      $phone            = $_POST['phone'];
      $dob              = $_POST['dob'];
      $address          = $_POST['address'];
      $gender_type      = $_POST['gender_type'];

    $query = "UPDATE USERS set Username='$username' ,Fathersname='$fathername' ,Mothersname='$mothername' ,Email='$email',
              Aadharno='$aadhar' ,Fathersaadharno='$aadharfather' ,Password='$password' ,Confirmpassword='$confirmpassword' ,Phonenumber='$phone'
               ,Dateofbirth='$dob' ,Address='$address' ,Gender='$gender_type' WHERE id='$id'";
       $data = mysqli_query($conn,$query);

       if($data)
        {
          echo  "<script> alert('Record Updated')</script>";
          ?>
          <meta http-equiv="refresh" content="0; url=http://localhost/Star%20Public%20School/display.php">
          <?php
        }
        else{
          echo "failed";
        } 
      }
?>      