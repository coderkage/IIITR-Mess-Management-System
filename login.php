<?php
session_start();
error_reporting(0);

include("config.php");

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = mysqli_query($conn, "SELECT user_id, username, role FROM users WHERE username='$username' && password='$password'");
    $user_data = mysqli_fetch_array($query);
    
    if ($user_data) {
        $username = $user_data['username'];
        $role = $user_data['role'];
        $user_id = $user_data['user_id'];
        
        $_SESSION["username"] = $username;
        $_SESSION["role"] = $role;
        $_SESSION["user_id"] = $user_id; 
        $_SESSION["loggedin"] = 1;

        if ($role === 'admin') {
            header("Location: admin_welcome.php");
        } elseif ($role === 'student') {
            header("Location: student_welcome.php");
        } elseif ($role === 'secretary') {
            header("Location: secretary_welcome.php");
        } elseif ($role === 'warden') {
            header("Location: warden_welcome.php");
        } elseif ($role === 'caterer') {
            header("Location: caterer_welcome.php");
        } else {

        }
    } else {
        $_SESSION['loggedin'] = 0;
        $msg1 = "Invalid username or password.";
    }
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
              <li class="nav-item active">
                <a class="nav-link" href="register.php">Register</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="login.php">Login</a>
              </li>
            </ul>
        </div>
    </nav>

<div class="container mt-4">
    <h3>Login Here:</h3>
    <hr>
  <form action="" method="post">
    <div class="form-group">
      <label for="exampleInputEmail1">Username</label>
      <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password">
    </div>  
    <button type="submit" class="btn btn-primary" name="login">Submit</button>
    <div>
      <label>
          <div class="error" style=" color:red; font-weight:bold; width:250px;">
              <?php if ($msg2) {
                  echo $msg2;
              }  ?>
          </div>
      </label>
      </div>
      <div>
            <label>
          <div class="error" style=" color:red; font-weight:bold; width:250px;">
              <?php if ($msg1) {
                  echo $msg1;
              } ?>
          </div>
      </label>
      </div>
  </form>
</div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
