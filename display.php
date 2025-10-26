<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display All Records</title>

    <style>
        body{
    background-color: #D071f9;
    font-family: Arial, sans-serif;
    padding: 10px;
}

table{
    background-color: white;
    border-collapse: collapse;
    width: 98%; /* Table thoda chhota */
    margin: 0 auto;
    font-size: 15px; /* Smaller font */
}

th, td{
    padding: 6px; /* Reduce padding */
    text-align: center;
    border: 1px solid green;
}

th{
    background-color: yellow;
}

.update, .delete {
    height: 22px;
    width: 90px;
    font-size: 12px;
    margin-top: 2px;
    border-radius: 4px;
    border: none;          /* Remove border */
    outline: none;         /* Remove outline */
    cursor: pointer;
    color: #fff;
    transition: 0.3s;
}

.update {
    background-color: green;
}

.delete {
    background-color: red;
}

/* Hover effects */
.update:hover {
    background-color: #00b300; /* Slightly brighter green */
}

.delete:hover {
    background-color: #ff4d4d; /* Slightly brighter red */
}

/* Responsive adjustments */
@media(max-width:768px){
    .update, .delete{
        width: 70px;
        height: 20px;
        font-size: 10px;
    }
}

    </style>
</head>
<body>

<h2 align="center"><mark>Displaying All Records</mark></h2>

<table>
<tr>
    <th>Roll No.</th>
    <th>Username</th>
    <th>Father's Name</th>
    <th>Mother's Name</th>
    <th>Email</th>
    <th>Aadhar No.</th>
    <th>Father's Aadhar No.</th>
    <th>Password</th>
    <th>Phone Number</th>
    <th width="95px">Date Of Birth</th>
    <th>Address</th>
    <th>Gender</th>
    <th>Operations</th>
</tr>

<?php
include("connection.php");
error_reporting(0);

$query  = "SELECT * FROM users ORDER BY id ASC"; // Fetch all records ordered by id
$data   = mysqli_query($conn, $query);
$total  = mysqli_num_rows($data);

if($total != 0){
    $serialNo = 1; // Initialize serial number
    while($result = mysqli_fetch_assoc($data)){
        echo "
            <tr>
            <td>".$serialNo."</td>
            <td>".$result['Username']."</td>
            <td>".$result['Fathersname']."</td>
            <td>".$result['Mothersname']."</td>
            <td>".$result['Email']."</td>
            <td>".$result['Aadharno']."</td>
            <td>".$result['Fathersaadharno']."</td>
            <td>".$result['Password']."</td>
            <td>".$result['Phonenumber']."</td>
            <td>".$result['Dateofbirth']."</td>
            <td>".$result['Address']."</td>
            <td>".$result['Gender']."</td>
            <td>
                <a href='Update_design.php?id=".$result['id']."'><input type='submit' value='Update' class='update'></a>
                <a href='delete.php?id=".$result['id']."'><input type='submit' value='Delete' class='delete' onclick='return checkdelete()'></a>
            </td>
            </tr>
        ";
        $serialNo++; // Increment serial number
    }
}else{
    echo "<tr><td colspan='13'>No Records Found</td></tr>";
}
?>

</table>

<script>
function checkdelete(){
    return confirm('Are You Sure You Want To Delete This Record?');
}
</script>

</body>
</html>
