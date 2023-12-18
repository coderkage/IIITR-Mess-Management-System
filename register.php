<?php
require_once "config.php";

$username = $password = $confirm_password = $role = "";
$username_err = $password_err = $confirm_password_err = $role_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (empty(trim($_POST["username"]))) {
        $username_err = "Username cannot be blank";
    } else {
        $sql = "SELECT username FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = trim($_POST['username']);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken";
                } else {
                    $username = trim($_POST['username']);
                }
            } else {
                echo "Something went wrong";
            }
        }
    }

    if (empty(trim($_POST['password']))) {
        $password_err = "Password cannot be blank";
    }  else {
        $password = trim($_POST['password']);
    }

    if (empty(trim($_POST['confirm_password']))) {
        $confirm_password_err = "Please confirm your password";
    } else {
        $confirm_password = trim($_POST['confirm_password']);
        if ($password != $confirm_password) {
            $confirm_password_err = "Password does not match";
        }
    }

    $role = $_POST['role'];

    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($role_err)) {
        $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password, $param_role);

            $param_username = $username;
            $param_password = $password;
            $param_role = $role;

            if (mysqli_stmt_execute($stmt)) {
                header("location: login.php");
            } else {
                echo "Something went wrong... cannot redirect!";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<title>IIITR Mess</title>
<style>
        body {
            background-image: url('food.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: white;
        }
        body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: -1;
    }
        .container {
            margin-top: 100px;
        }
        h1 {
            font-size: 3rem;
        }
    </style>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">IIITR Mess</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
  <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="register.php">Register</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="login.php">Login</a>
      </li>     
    </ul>
  </div>
</nav>

<div class="container mt-4">
<h3>Register Here:</h3>
<hr>
<form action="" method="post">
    <div class="form-group">
      <label for="inputEmail4">Username</label>
      <input type="text" class="form-control" name="username" id="inputEmail4" placeholder="Username">
    </div>
  <div class="form-group">
    <label for="role">User Role:</label>
      <select class="form-control" name="role" aria-label="Default select example" id="role">  
        <option value="student">Student</option>
        <option value="admin">Admin</option>
        <option value="secretary">Mess Secretary</option>
        <option value="warden">Warden</option>
        <option value="caterer">Mess Caterer</option>
    </select>
  </div>

    <div class="form-group">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" name ="password" id="inputPassword4" placeholder="Enter Password">
    </div>
  <div class="form-group">
      <label for="inputPassword4">Confirm Password</label>
      <input type="password" class="form-control" name ="confirm_password" id="inputPassword" placeholder="Confirm Password">
    </div>
  <button type="submit" class="btn btn-primary">Sign in</button>
</form>
</div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
