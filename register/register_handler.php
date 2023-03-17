<?php

// Include the database configuration file
require('../includes/config.php');

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    
    // Get the form data
    $studentid = $_POST['studentid'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    
    // Insert the form data into the database
    $sql = "INSERT INTO student_info (student_id, fname, lname, emailadd) VALUES ('$studentid', '$firstname', '$lastname', '$email')";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }
    
    // Encode the form data as a URL query string
    $data = http_build_query(array(
        'studentid' => $studentid,
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email
    ));
    
    // Redirect to the QR scan page with the form data
    header("Location: qr_scanner.php?$data");
    echo '<script>alert("Success");</script>';
    exit();
}

?>
