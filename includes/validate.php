<?php

require('../includes/config.php');
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $email = $_POST["email"];
    $password = $_POST["password"];
    $remember_password = isset($_POST["remember_password"]) ? true : false;

    // Perform server-side validation
    $errors = array();
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    if (empty($password)) {
        $errors[] = "Password is required";
    }

    // If there are no validation errors, attempt to authenticate the user
    if (empty($errors)) {

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute the database query
        $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        // If the query returned a row, the user is authenticated
        if ($result->num_rows > 0) {
            // Start a session
            session_start();

            // Set a session variable to indicate that the user is logged in
            $_SESSION["logged_in"] = true;

            // If the "remember password" checkbox was checked, set a cookie to remember the user's login
            if ($remember_password) {
                $cookie_name = "login_cookie";
                $cookie_value = $email;
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // Set the cookie to expire in 30 days
            }

            // Redirect the user to the admin dashboard
            header("Location: ../admin/index.php");
            exit();
        } else {
            // If the query didn't return a row, the user is not authenticated
            $errors[] = "Invalid email or password";
        
            // Close the database connection
            $conn->close();
        
            // Redirect the user back to the login page with an alert message
            echo "<script>alert('" . implode("<br>", $errors) . "')</script>";
            header("Location: ../admin/login.php");
            exit();
        }
    } else {
        // If there are validation errors, close the database connection and redirect the user back to the login page with an alert message
        $conn->close();

    }
}
?>
