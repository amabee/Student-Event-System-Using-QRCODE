<?php

// Include the database configuration file
require('../includes/config.php');

// Check if the event ID is set in the URL query string
if (isset($_GET['eventId'])) {
    $event_id = $_GET['eventId'];
} else {
    // Display an error message and exit the script
    echo '<script>alert("Error: Event ID not found.");</script>';
    exit;
}

// Check if the form data has been sent from qr_scanner.php
if (isset($_POST['data'])) {
    // Get the form data
    $data = $_POST['data'];
    $studentid = $data['studentid'];
    $firstname = $data['firstname'];
    $lastname = $data['lastname'];
    $email = $data['email'];

    // Check if the student is already in the student_info table
    $sql = "SELECT * FROM student_info WHERE student_id = '$studentid'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // If the student is already in the table, use the existing record
        $row = mysqli_fetch_assoc($result);
        $studentid = $row['student_id'];
        $firstname = $row['fname'];
        $lastname = $row['lname'];
        $email = $row['emailadd'];
    } else {
        // If the student is not in the table, insert the new record
        $sql = "INSERT INTO student_info (student_id, fname, lname, emailadd) VALUES ('$studentid', '$firstname', '$lastname', '$email')";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die("Error: " . mysqli_error($conn));
        }
    }


    // Check if the event has already started or ended
    $sql = "SELECT * FROM events WHERE event_id = '$event_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // If the event exists, check if it has already started or ended
        $row = mysqli_fetch_assoc($result);
        $start_time = strtotime($row['TimeOF_IN']);
        $end_time = strtotime($row['TimeOF_OUT']);
        $current_time = date("Y-m-d H:i:s");

        if ($current_time < $start_time) {
            // If the event has not started yet, display an error message and exit the script
            echo '<script>alert("Error: Event has not started yet.");</script>';
            exit;
        } 
        else if ($current_time > $end_time) {
            // If the current time is between the start and end time of the event, check if the student has already checked in for this event
            $sql = "SELECT * FROM attendance WHERE student_id = '$studentid' AND event_id = '$event_id' AND Time_Out IS NULL";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) 
            {
                // If the student has already checked in, update the Time_OUT
                $sql = "UPDATE attendance SET Time_Out = NOW() WHERE student_id = '$studentid' AND event_id = '$event_id' AND Time_Out IS NULL";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    die("Error: " . mysqli_error($conn));
                }
                // Display a success message
                echo '<script>alert("Attendance updated.");</script>';
            exit;
        } 
        else {

            // Check if the event is already finished. If the event is done, you cannot Time In anymore else you can still go for time in but late
                if($current_time < $end_time) {
                    // If the student has not checked in, insert the attendance record
                $sql = "INSERT INTO attendance (student_id, firstname, lastname, emailadd, Time_In, event_id) VALUES ('$studentid', '$firstname', '$lastname', '$email', NOW(), '$event_id')";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    die("Error: " . mysqli_error($conn));
                }
                // Display a success message
                echo '<script>alert("Attendance recorded.");</script>';
                exit;
                }
                else{
                    echo '<script>alert("Event is already finished! You cannot mark attendance anymore");</script>';
                }
            }
           
        }
    } else {
        // If the event does not exist, display an error message and exit the script
        echo '<script>alert("Error: Event not found.");</script>';
        exit;
    }


} else {
    // Debugging: display the received data
    echo "Data received: <br>";
    var_dump($_POST);
}

?>