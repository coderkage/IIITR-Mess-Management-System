<?php
session_start();
include("config.php");

if ($_SESSION['role'] != 'secretary' && $_SESSION['role'] != 'warden') {
    header("Location: login.php");
}

if (isset($_GET['complaint_id'])) {
    $complaint_id = $_GET['complaint_id'];
    $resolution_date = date('Y-m-d');

    $update_complaint_query = "UPDATE complaints SET activity_status='closed', resolution_date='$resolution_date' WHERE complaint_id='$complaint_id'";
    mysqli_query($conn, $update_complaint_query);

    header("Location: resolution.php");
} else {

}
?>


</body>
</html>