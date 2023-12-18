<?php
// download_pdf.php

if (isset($_GET['pdf_path'])) {
    $pdf_path = $_GET['pdf_path'];

    // Check if the file exists
    if (file_exists($pdf_path)) {
        // Set headers for force download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($pdf_path));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($pdf_path));

        // Read the file and output it to the browser
        readfile($pdf_path);
        exit;
    } else {
        echo 'File not found.';
    }
} else {
    echo 'Invalid request.';
}
?>
