<?php
session_start();
include("config.php");

if ($_SESSION['role'] != 'student') {
    // Redirect unauthorized users
    header("Location: login.php");
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['file_complaint'])) {
    $complaint = mysqli_real_escape_string($conn, $_POST['complaint']);
    $complain_date = date('Y-m-d');

    $complaint_count_query = "SELECT COUNT(*) as count FROM complaints WHERE user_id='$user_id' AND activity_status='open'";
    $complaint_count_result = mysqli_query($conn, $complaint_count_query);
    $complaint_count_row = mysqli_fetch_assoc($complaint_count_result);

    if ($complaint_count_row['count'] < 5) {
        // Check if an image is uploaded
        if (!empty($_FILES["complaint_image"]["name"])) {
            $target_dir = "complaint_images/";
            $target_file = $target_dir . basename($_FILES["complaint_image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["complaint_image"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            if ($_FILES["complaint_image"]["size"] > 50000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["complaint_image"]["tmp_name"], $target_file)) {
                    echo "The file " . basename($_FILES["complaint_image"]["name"]) . " has been uploaded.";
                    $image_path = $target_file;

                    $insert_complaint_query = "INSERT INTO complaints (user_id, complaint, activity_status, complain_date, image_path) 
                                               VALUES ('$user_id', '$complaint', 'open', '$complain_date', '$image_path')";
                    mysqli_query($conn, $insert_complaint_query);
                    header("Location: complain.php");
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            // If no image is uploaded, save the complaint without an image
            $insert_complaint_query = "INSERT INTO complaints (user_id, complaint, activity_status, complain_date) 
                                       VALUES ('$user_id', '$complaint', 'open', '$complain_date')";
            mysqli_query($conn, $insert_complaint_query);
            header("Location: complain.php");
        }
    } else {
        $complaint_limit_reached = true;
    }
}

$student_complaints_query = "SELECT * FROM complaints WHERE user_id='$user_id'";
$student_complaints_result = mysqli_query($conn, $student_complaints_query);
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">

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
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="student_welcome.php">IIITR Mess</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
  <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="view_menu.php">Menu</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="vote.php">Preference</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="rate_user.php">Daily Rating</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="complain.php">Complain</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="leave_join.php">Leave update</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="billings.php">Billing</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
    <li class="nav-item active">
      <a class="nav-link" href="logout.php">Logout</a>
    </li>
  </ul>
  </div>
</nav>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center"><i>File your Complaint</i></h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12 mx-auto text-center">
                <form method="post" action="" enctype="multipart/form-data">
                    <textarea name="complaint" rows="4" cols="50" placeholder="Enter your complaint here" required></textarea>
                    <br><br>
                    <label for="complaint_image">Upload an Image:</label>
                    <input type="file" name="complaint_image" id="complaint_image" accept="image/*">
                    <br><br>
                    <?php
                    if (isset($complaint_limit_reached) && $complaint_limit_reached) {
                        echo "<p>You have reached the maximum limit of 5 complaints.</p>";
                    }
                    ?>
                    <input type="submit" name="file_complaint" value="Submit">
                </form>

                <br><br>

                <h3>Your Filed Complaints</h3>
                <table class="table table-bordered" style="color: white;">
                    <thead>
                        <tr>
                            <th>Complaint ID</th>
                            <th>Complaint</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($student_complaints_result)) {
                            echo "<tr>";
                            echo "<td>" . $row['complaint_id'] . "</td>";
                            echo "<td>" . $row['complaint'] . "</td>";
                            echo "<td><img src='" . $row['image_path'] . "' alt='Complaint Image' style='max-width: 100px; max-height: 100px;' onclick=\"openImageModal('" . $row['image_path'] . "')\"></td>";
                            echo "<td>" . $row['activity_status'] . "</td>";
                            echo "<td>";

                            // Display a link to view remarks if available
                            if (!empty($row['remark'])) {
                                echo  $row['remark'] ;
                            } else {
                                echo "<i>-- No Remarks --</i>";
                            }

                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for Image -->
    <div id="imageModal" class="modal" onclick="closeModal()">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>

    <!-- Modal for Remarks -->
    <div id="remarksModal" class="modal" onclick="closeRemarksModal()">
        <span class="close" onclick="closeRemarksModal()">&times;</span>
        <div class="modal-content" id="modalRemarks"></div>
    </div>

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

        // Function to open a modal with the clicked remarks
        function openRemarksModal(remarks) {
            var modal = document.getElementById('remarksModal');
            var modalRemarks = document.getElementById('modalRemarks');
            modal.style.display = "block";
            modalRemarks.innerHTML = remarks;
        }

        // Function to close the remarks modal
        function closeRemarksModal() {
            var modal = document.getElementById('remarksModal');
            modal.style.display = "none";
        }
    </script>
</body>

</html>
