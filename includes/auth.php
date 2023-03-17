<?php
    session_start();
    
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && !isset($_SESSION['redirected'])) {
        $_SESSION['redirected'] = true;
        $redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php';
        header("Location: $redirect");
        die();   
    } else if (!isset($_SESSION["email"])) {
        header("Location: login.php");
        exit();
    }

    // Check if user has been inactive for 30 minutes and logout if necessary
    $inactive = 1800; // 30 minutes in seconds
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $inactive)) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }
    
    $_SESSION['LAST_ACTIVITY'] = time();
    
    // Calculate the remaining time until logout
    $remaining_time = $inactive - (time() - $_SESSION['LAST_ACTIVITY']);
    
    // Convert remaining time to minutes and seconds
    $minutes = floor($remaining_time / 60);
    $seconds = $remaining_time % 60;
    
    // Output the remaining time as a console.log message
    echo "<script>console.log('You will be logged out in " . $minutes . "m " . $seconds . "s.')</script>";
?>
