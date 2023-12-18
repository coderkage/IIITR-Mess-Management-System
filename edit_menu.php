<?php
session_start();
include("config.php");

if ($_SESSION['role'] != 'secretary') {
    header("Location: login.php");
}

// Process menu update from CSV
if (isset($_POST['update_menu_csv'])) {
    try {
        // Remove foreign key constraint
        $remove_foreign_key_query = "ALTER TABLE ratings DROP FOREIGN KEY ratings_ibfk_2";
        mysqli_query($conn, $remove_foreign_key_query);

        // Clear existing entries from the menu table
        $clear_menu_query = "TRUNCATE TABLE menu";
        mysqli_query($conn, $clear_menu_query);

        // Insert new entries from the CSV file
        if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == UPLOAD_ERR_OK) {
            $csv_file = fopen($_FILES['csv_file']['tmp_name'], 'r');
            fgetcsv($csv_file); // Skip header row

            while (($data = fgetcsv($csv_file, 1000, ',')) !== false) {
                $day = mysqli_real_escape_string($conn, $data[0]);
                $meal_type = mysqli_real_escape_string($conn, $data[1]);
                $meal_name = mysqli_real_escape_string($conn, $data[2]);

                $insert_menu_query = "INSERT INTO menu (day, meal_type, meal_name) VALUES ('$day', '$meal_type', '$meal_name')";
                mysqli_query($conn, $insert_menu_query);
            }

            fclose($csv_file);
        }

        // Add foreign key constraint back
        $add_foreign_key_query = "ALTER TABLE ratings ADD CONSTRAINT ratings_ibfk_2 FOREIGN KEY (meal_id) REFERENCES menu (meal_id)";
        mysqli_query($conn, $add_foreign_key_query);

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Retrieve menu data
$menu_query = "SELECT * FROM menu";
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
            background-image: url('cool.jpg');
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
<?php  include("sec_nav.php"); ?>

<br>
<div class="container" style="margin-top: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="text-center">Edit Menu</h3>
        </div>
    </div>
</div>
<hr>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 mx-auto text-center">
            <form method="post" action="" enctype="multipart/form-data">
                <input type="file" name="csv_file" accept=".csv" required>
                <input type="submit" name="update_menu_csv" value="Update Menu from CSV">
            </form>
            <br>
            <table class="table table-bordered table-striped table-dark">
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
