<?php
session_start();
include("config.php");

if ($_SESSION['role'] != 'caterer') {
    header("Location: login.php");
}

$open_important_complaint_query = "SELECT * FROM complaints WHERE activity_status='open' AND important=1";
$open_important_complaint_result = mysqli_query($conn, $open_important_complaint_query);
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
<?php include("caterer_nav.php"); ?>
<br>
<div class="container" style="margin-top: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center">Current Complaints</h2>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 mx-auto text-center">
            <table class="table table-bordered table-striped table-light">
                <thead>
                <tr>
                    <th>Complaint</th>
                    <th>Image</th>
                    <th>Complain Date</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($open_important_complaint_result)) {
                    echo "<tr>";
                    echo "<td>" . $row['complaint'] . "</td>";
                    echo "<td><img src='" . $row['image_path'] . "' alt='Complaint Image' style='max-width: 100px; max-height: 100px;' onclick=\"openImageModal('" . $row['image_path'] . "')\"></td>";
                    echo "<td>" . $row['complain_date'] . "</td>";
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
