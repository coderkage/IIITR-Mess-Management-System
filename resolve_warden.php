<?php
session_start();
include("config.php");

if ($_SESSION['role'] != 'warden') {
    header("Location: login.php");
}

$resolved_complaint_query = "SELECT * FROM complaints WHERE activity_status='closed'";
$resolved_complaint_result = mysqli_query($conn, $resolved_complaint_query);

$open_complaint_query = "SELECT * FROM complaints WHERE activity_status='open'";
$open_complaint_result = mysqli_query($conn, $open_complaint_query);

if (isset($_POST['mark_important'])) {
    $complaint_id = $_POST['complaint_id'];

    // Mark the complaint as important
    $mark_important_query = "UPDATE complaints SET important=1 WHERE complaint_id=$complaint_id";
    mysqli_query($conn, $mark_important_query);
    header("Location: resolve_warden.php");
}

if (isset($_POST['unmark_important'])) {
    $complaint_id = $_POST['complaint_id'];

    // Unmark the complaint as important
    $unmark_important_query = "UPDATE complaints SET important=0 WHERE complaint_id=$complaint_id";
    mysqli_query($conn, $unmark_important_query);
    header("Location: resolve_warden.php");
}

if (isset($_POST['submit_remark'])) {
    $complaint_id = $_POST['complaint_id'];
    $warden_remark = mysqli_real_escape_string($conn, $_POST['warden_remark']);

    // Update the 'remark' column in the database
    $update_remark_query = "UPDATE complaints SET remark='$warden_remark' WHERE complaint_id=$complaint_id";
    mysqli_query($conn, $update_remark_query);
    header("Location: resolve_warden.php");
}

if (isset($_POST['close_complaint'])) {
    $complaint_id_to_close = $_POST['complaint_id_to_close'];

    // Update the activity_status to 'closed' for the selected complaint
    $close_complaint_query = "UPDATE complaints SET activity_status='closed' WHERE complaint_id=$complaint_id_to_close";
    mysqli_query($conn, $close_complaint_query);
    header("Location: resolve_warden.php");
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
            background-image: url('nice.jpg');
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
        /* Style for the horizontal line */
        hr {
            border: 0;
            height: 2px;
            background: linear-gradient(to right, rgba(255,255,255,0), rgba(255,255,255,0.75), rgba(255,255,255,0));
            margin: 20px 0; /* Adjust the margin as needed */
        }
    </style>
    
    <script>
        // Function to open a modal with the clicked image
        function openImageModal(imagePath) {
            var modal = document.getElementById('imageModal');
            var modalImg = document.getElementById('modalImage');
            modal.style.display = "block";
            modalImg.src = imagePath;
        }

        // Function to close the modal
        function closeModal() {
            var modal = document.getElementById('imageModal');
            modal.style.display = "none";
        }
    </script>
    
  </head>
  <body>
  <?php include("warden_nav.php"); ?>
<br>
<div class="container" style="margin-top: 50px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center">Complaint Resolution</h2>
            </div>
        </div>
    </div>
    <hr>
    <div class="container mt-5">
    <div class="row">
        <div class="col-md-12 mx-auto text-center">
            <h3>Open Complaints</h3><br>
            <table class="table table-bordered table-striped table-light">
                <thead>
                    <tr>
                        <th scope="col">Complaint</th>
                        <th scope="col">Image</th>
                        <th scope="col">Complain Date</th>
                        <th scope="col">Warden's Remark</th>
                        <th scope="col">Important</th>
                        <th scope="col">Add Remark</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($open_complaint_result)) {
                        echo "<tr>";
                        echo "<td>" . $row['complaint'] . "</td>";
                        echo "<td><img src='" . $row['image_path'] . "' alt='Complaint Image' style='max-width: 100px; max-height: 100px;' onclick=\"openImageModal('" . $row['image_path'] . "')\"></td>";
                        echo "<td>" . $row['complain_date'] . "</td>";
                        echo "<td>" . $row['remark'] . "</td>"; // Display warden's remark
                        echo "<td>";
                        echo "<form method='post' action=''>";
                        echo "<input type='hidden' name='complaint_id' value='" . $row['complaint_id'] . "'>";
                        if ($row['important']) {
                            echo "<button type='submit' name='unmark_important' class='btn btn-danger'>Unmark Important</button>";
                        } else {
                            echo "<button type='submit' name='mark_important' class='btn btn-success'>Mark Important</button>";
                        }
                        echo "</form>";
                        echo "</td>";
                        echo "<td>";
                        echo "<form method='post' action=''>";
                        echo "<input type='hidden' name='complaint_id' value='" . $row['complaint_id'] . "'>";
                        echo "<textarea name='warden_remark' rows='2' cols='30' class='form-control' placeholder='Add a remark'></textarea>";
                        echo "<input type='submit' name='submit_remark' value='Submit Remark' class='btn btn-primary mt-2'>";
                        echo "</form>";
                        echo "</td>";
                        echo "<td>";
                        echo "<form method='post' action=''>";
                        echo "<input type='hidden' name='complaint_id_to_close' value='" . $row['complaint_id'] . "'>";
                        echo "<button type='submit' name='close_complaint' class='btn btn-warning'>Close Complaint</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

<br><br>
                <h3>Resolved Complaints</h3><br>
                <table class="table table-bordered table-striped table-dark">
                    <thead>
                        <tr>
                            <th>Complaint</th>
                            <th>Image</th>
                            <th>Complain Date</th>
                            <th>Resolution Date</th>
                            <th>Warden's Remark</th> <!-- Add this column -->
                            <th>Important</th> <!-- Add this column -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($resolved_complaint_result)) {
                            echo "<tr>";
                            echo "<td>" . $row['complaint'] . "</td>";
                            echo "<td><img src='" . $row['image_path'] . "' alt='Complaint Image' style='max-width: 100px; max-height: 100px;' onclick=\"openImageModal('" . $row['image_path'] . "')\"></td>";
                            echo "<td>" . $row['complain_date'] . "</td>";
                            echo "<td>" . $row['resolution_date'] . "</td>";
                            echo "<td>" . $row['remark'] . "</td>";
                            echo "<td>" . ($row['important'] ? 'Yes' : 'No') . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="imageModal" class="modal" onclick="closeModal()">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage">
</div>
</body>
</html>
