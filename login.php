<?php

$invalid = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  include 'connect.php';

  $userType = $_POST['userType'];
  $ID = $_POST['ID'];
  $password = $_POST['password'];

  if ($userType != 'student') {
    $sql = "SELECT * from employee_t where employeeID='$ID' and password='$password'";
    $result = mysqli_query($con, $sql);
    if ($result) {
      $num = mysqli_num_rows($result);
      if ($num > 0) {
        $invalid = 0;
        session_start();
        $_SESSION['ID'] = $ID;
        header('location:employee_dashboard.php');
      }
    }
  } elseif ($userType == 'student') {
    $sql = "SELECT * from student_t where studentID='$ID' and password='$password'";
    $result = mysqli_query($con, $sql);
    if ($result) {
      $num = mysqli_num_rows($result);
      if ($num > 0) {
        $invalid = 0;
        session_start();
        $_SESSION['ID'] = $ID;
        header('location:employee_dashboard.php');
      }
    }
  } else {
    $invalid = 1;
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="hp.css">
  <title>Login form</title>



</head>

<body>
  <?php
  if ($invalid == 1) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong></strong> Invalid credentials!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }
  ?>
  <div class="form-container">
    <form action="" method="post">
      <h1>SPMS 4.0</h1>
      <h3>Sign in</h3>

      <div>
        <!-- <label style="">
          User Type
        </label> -->
        <select name="userType" class="select selectNew" text-align="right">
          <option disabled selected>User Type</option>
          <option value="student">Student</option>
          <option value="faculty">Faculty</option>
          <option value="department head">Department Head</option>
          <option value="dean">Dean</option>
        </select>
      </div>
      <br>


      <input class="ID" type="text" name="ID" placeholder="Enter Your ID">
      <input class="ID" type="password" name="password" placeholder="Enter Your Password"><br>


      <input type="submit" name="submit" value="Login" class="form-btn">

    </form>
  </div>



</body>

</html>