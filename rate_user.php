<?php
session_start();
include("config.php");

if ($_SESSION['role'] != 'student') {
    header("Location: login.php");
}

$user_id = $_SESSION['user_id'];
$current_day = date("l"); // Get the current day name

// Check if the user has already rated meals for the current day
$already_rated_query = "SELECT COUNT(*) as count FROM ratings 
                        WHERE user_id='$user_id' AND day='$current_day'";
$already_rated_result = mysqli_query($conn, $already_rated_query);
$already_rated_row = mysqli_fetch_assoc($already_rated_result);

if ($already_rated_row['count'] > 0) {
    // Redirect to thank you page or display a message
    header("Location: thank_you.php");
    exit();
}

// Display meals for the current day
$menu_query = "SELECT meal_id, meal_type, meal_name FROM menu WHERE day='$current_day'";
$menu_result = mysqli_query($conn, $menu_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate Meals</title>
</head>

<body>

    <h2>Rate Meals for <?php echo $current_day; ?></h2>

    <form method="post" action="process_ratings.php">
        <?php
        while ($row = mysqli_fetch_assoc($menu_result)) {
            echo "<p>{$row['meal_type']}: {$row['meal_name']} - ";
            echo "Rate: <input type='number' name='ratings[{$row['meal_id']}]' min='1' max='5' required></p>";
        }
        ?>
        <input type="submit" value="Submit Ratings">
    </form>

</body>

</html>
