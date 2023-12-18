<?php
session_start();
include("config.php");

if ($_SESSION['role'] != 'student') {
    header("Location: login.php");
    exit();
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

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process ratings submitted by the user
    $ratings = $_POST['ratings'];

    // Loop through submitted ratings and insert into the ratings table
    foreach ($ratings as $meal_id => $rating) {
        $insert_rating_query = "INSERT INTO ratings (user_id, meal_id, rating, day) 
                                VALUES ('$user_id', '$meal_id', '$rating', '$current_day')";
        mysqli_query($conn, $insert_rating_query);
    }

    // Calculate average ratings and update the menu table
    $update_menu_query = "UPDATE menu SET avg_rating = 
                            (SELECT AVG(rating) FROM ratings 
                             WHERE meal_id = menu.meal_id) 
                         WHERE day = '$current_day'";
    mysqli_query($conn, $update_menu_query);

    // Redirect to thank you page or any other page
    header("Location: thank_you.php");
    exit();
} else {
    // Redirect to the rating page if the form is not submitted
    header("Location: rate_meals.php");
    exit();
}
?>
