<?php
session_start();
include("config.php");

$menu_query = "SELECT * FROM menu";
$menu_result = mysqli_query($conn, $menu_query);
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
            background-image: url('mess.jpeg');
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
            margin-top: 50px;
        }

        h1 {
            font-size: 3rem;
        }
        hr {
            border: 0;
            height: 2px;
            background: linear-gradient(to right, rgba(255,255,255,0), rgba(255,255,255,0.75), rgba(255,255,255,0));
            margin: 20px 0; /* Adjust the margin as needed */
        }
    </style>
</head>
<body>
<?php  if ($_SESSION['role'] == 'caterer') 
{
  include("caterer_nav.php");
}
elseif ($_SESSION['role'] == 'student') 
{
  include("student_nav.php");
} 
elseif ($_SESSION['role'] == 'warden') 
{
  include("warden_nav.php");
} 
elseif ($_SESSION['role'] == 'secretary') 
{
  include("sec_nav.php");
} 
?>


<div class="container" style="margin-top: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="text-center">Menu</h3>
        </div>
    </div>
</div>
<hr>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 mx-auto text-center">
            <table class="table table-bordered table-striped table-light">
                <thead>
                <tr>
                    <th>Day</th>
                    <th>Meal Type</th>
                    <th>Meal Name</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($menu_result)) {
                    echo "<tr>";
                    echo "<td>" . $row['day'] . "</td>";
                    echo "<td>" . $row['meal_type'] . "</td>";
                    echo "<td>" . $row['meal_name'] . "</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
