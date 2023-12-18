<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mess Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        background: rgba(0, 0, 0, 0.5); /* Adjust the opacity here */
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
    <div class="container">
        <div class="text-center">
            <img src="logo.png" alt="Institute Logo" width="500">
        </div>
    </div>
    <div class="container">
        <div class="text-center">
        <h1 style="font-family: 'Georgia', serif;">IIITR Mess Management System🍴</h1>
        <br>
        <p style="font-family: 'Georgia', serif; font-size: 25px;"><i>"Manage Your Meals With Ease"</i></p>
        </div>
    </div>
    <div class="container">
        <div class="row mt-5">
            <!-- <div class="col-md-3 mx-auto text-center">
                <a href="register.php" class="btn btn-primary btn-lg btn-block">Register</a>
            </div> -->
            <div class="col-md-3 mx-auto text-center">
                <a href="login.php" class="btn btn-success btn-lg btn-block">Login</a>
            </div>
        </div>
    </div>
</body>
</html>
