<?php
session_start();
include("config.php");

// Check if the user is authorized (caterer, secretary, or warden)
$authorized_roles = ['caterer', 'secretary', 'warden'];
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $authorized_roles)) {
    header("Location: login.php");
}

// Retrieve unique days and meal types from the menu
$days_query = "SELECT DISTINCT day FROM menu";
$meal_types_query = "SELECT DISTINCT meal_type FROM menu";

$days_result = mysqli_query($conn, $days_query);
$meal_types_result = mysqli_query($conn, $meal_types_query);

// Default to the first day if none is selected
$selected_day = isset($_GET['day']) ? $_GET['day'] : null;
$selected_meal_type = isset($_GET['meal_type']) ? $_GET['meal_type'] : null;

// Retrieve menu data for the selected day and meal type
$menu_query = "SELECT day, meal_type, meal_name, avg_rating FROM menu WHERE 1";

if ($selected_day) {
    $menu_query .= " AND day = '$selected_day'";
}

if ($selected_meal_type) {
    $menu_query .= " AND meal_type = '$selected_meal_type'";
}

$menu_result = mysqli_query($conn, $menu_query);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>IIITR Mess - Menu</title>
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

        h2 {
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

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="text-center">Item Ratings</h3>
            </div>
        </div>
    </div>
    <hr>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 mx-auto text-center">
                <!-- Form for selecting both days and meal types -->
                <form method="get" action="">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="daySelect">Select Day:</label>
                            <select class="form-control" id="daySelect" name="day">
                                <option value="" <?php echo !$selected_day ? 'selected' : ''; ?>>All Days</option>
                                <?php
                                while ($day_row = mysqli_fetch_assoc($days_result)) {
                                    $day_value = $day_row['day'];
                                    echo "<option value='$day_value' " . ($selected_day === $day_value ? 'selected' : '') . ">$day_value</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mealTypeSelect">Select Meal Type:</label>
                            <select class="form-control" id="mealTypeSelect" name="meal_type">
                                <option value="" <?php echo !$selected_meal_type ? 'selected' : ''; ?>>All Meal Types</option>
                                <?php
                                while ($meal_type_row = mysqli_fetch_assoc($meal_types_result)) {
                                    $meal_type_value = $meal_type_row['meal_type'];
                                    echo "<option value='$meal_type_value' " . ($selected_meal_type === $meal_type_value ? 'selected' : '') . ">$meal_type_value</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                </form>
<br><br>
                <!-- Display ratings based on the selected day and meal type -->
                <table class="table table-bordered table-striped table-light">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Meal Type</th>
                            <th>Meal Name</th>
                            <th>Avg. Rating (Out of 5)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($menu_result)) {
                            echo "<tr>";
                            echo "<td>" . $row['day'] . "</td>";
                            echo "<td>" . $row['meal_type'] . "</td>";
                            echo "<td>" . $row['meal_name'] . "</td>";
                            echo "<td>" . $row['avg_rating'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UoI/X1Mzwrn/P+GrL/x4jrbLUECNo8vSekc5T6JZsLqBNbfSPOyZyDDtFVvzT" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
