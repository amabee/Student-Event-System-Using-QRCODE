<?php
require('../includes/auth.php');
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Event Management</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <link href="https://cdn.jsdelivr.net/npm/propellerkit@1.3.1/dist/css/propeller.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/propellerkit-datetimepicker@1.2.0/css/pmd-datetimepicker.min.css"
        rel="stylesheet">

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- Bootstrap DateTimePicker -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/propellerkit@1.3.1/dist/js/propeller.min.js"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/propellerkit-datetimepicker@1.2.0/js/bootstrap-datetimepicker.min.js"></script>

</head>


<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">ADMIN SYSTEM</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>

                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        <div class="sb-sidenav-menu-heading">Event Management</div>
                        <a class="nav-link" href="events.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Create Event
                        </a>

                        <div class="sb-sidenav-menu-heading">Data</div>
                        <a class="nav-link" href="tables.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Attendance
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php echo $email; ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Manage Events</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Event Creation</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Create Event
                        </div>
                        <div class="card-body">
                            <?php
                            require('../includes/config.php');
                            require_once('phpqrcode/qrlib.php');

                            // When form submitted, insert values into the database.
                            if (isset($_REQUEST['event_id'])) {
                                // removes backslashes
                                $event_id = stripslashes($_REQUEST['event_id']);
                                //escapes special characters in a string
                                $event_id = mysqli_real_escape_string($conn, $event_id);

                                $event_name = stripslashes($_REQUEST['event_name']);
                                $event_name = mysqli_real_escape_string($conn, $event_name);

                                $event_venue = stripslashes($_REQUEST['event_venue']);
                                $event_venue = mysqli_real_escape_string($conn, $event_venue);

                                $event_TimeIn = $_POST['event_TimeIn'];
                                $event_TimeOut = $_POST['event_TimeOut'];

                                $timeIn = date('Y-m-d g:i A', strtotime($event_TimeIn));
                                $timeOut = date('Y-m-d g:i A', strtotime($event_TimeOut));

                                // Generate QR code with logo
                            
                                $qr_text = "Event ID: $event_id\nEvent Name: $event_name\nEvent Venue: $event_venue\nEvent Datetime: $timeIn\nEvent Time Out: $timeOut\n";
                                $qr_filename = "qrcodes/$event_id.png";



                                // Create QR code
                                QRcode::png($qr_text, $qr_filename, QR_ECLEVEL_H, 8, 3);

                                // Add logo to QR code
                                $logo = 'assets/img/PHINMA.jpg';
                                $logo = imagecreatefromstring(file_get_contents($logo));
                                $qr = imagecreatefrompng($qr_filename);
                                $qr_width = imagesx($qr);
                                $qr_height = imagesy($qr);
                                $logo_width = imagesx($logo);
                                $logo_height = imagesy($logo);

                                // Scale logo to fit in the center of the QR code
                                $logo_size = 0.2;
                                $logo_width = $qr_width * $logo_size;
                                $logo_height = $qr_height * $logo_size;

                                // Copy QR code to new transparent image
                                $merged = imagecreatetruecolor($qr_width, $qr_height);
                                $transparent = imagecolorallocatealpha($merged, 0, 0, 0, 127);
                                imagefill($merged, 0, 0, $transparent);
                                imagecopy($merged, $qr, 0, 0, 0, 0, $qr_width, $qr_height);

                                // Calculate position of logo in the QR code
                                $x = ($qr_width - $logo_width) / 2;
                                $y = ($qr_height - $logo_height) / 2;

                                // Merge logo with QR code
                                imagecopyresampled($merged, $logo, $x, $y, 0, 0, $logo_width, $logo_height, $logo_width, $logo_height);

                                // Save merged image
                                imagepng($merged, $qr_filename);
                                imagedestroy($qr);
                                imagedestroy($logo);
                                imagedestroy($merged);


                                $qr_image = mysqli_real_escape_string($conn, $qr_filename);

                                $create_datetime = date("Y-m-d H:i:s");

                                $query = "INSERT INTO `events`(`event_id`, `event_name`, `event_venue`, `event_qr`,`TimeOF_IN`, `TimeOF_OUT` ,`created_at`) 
                                      VALUES ('$event_id','$event_name','$event_venue','$qr_image', '$timeIn', '$timeOut' ,NOW())";
                                $result = mysqli_query($conn, $query);
                                if ($result) {
                                    echo "<div class='form'>
                                      <h3>Event Created Successfully.</h3><br/>
                                      <p class='link'>Click here to go back to<a href='index.php'> Dashboard</a></p>
                                      </div>";
                                }
                            } else {
                                ?>
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="event_id"></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-address-card"></i>
                                                </div>
                                            </div>
                                            <input id="event_id" name="event_id" placeholder="Event ID" type="text"
                                                required="required" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="event_name"></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-font"></i>
                                                </div>
                                            </div>
                                            <input id="event_name" name="event_name" placeholder="Event Name" type="text"
                                                required="required" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="text"></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-bicycle"></i>
                                                </div>
                                            </div>
                                            <input id="event_venue" name="event_venue" placeholder="Event Venue" type="text"
                                                required="required" class="form-control">
                                        </div>
                                    </div>
                                    <!--TIME IN -->
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label" for="datetimepicker-timeIn">Event Time In</label>
                                            <input type="text" id="datetimepicker-timeIn" name="event_TimeIn" 
                                            class="form-control" required="required" 
                                             data-toggle="datetimepicker" data-target="#datetimepicker-timeIn" 
                                             data-format="YYYY-MM-DD hh:mm A" />

                                    </div>
                                    <script>
                                        // Default date and time picker
                                        $('#datetimepicker-timeIn').datetimepicker();
                                    </script>

                                    <!--TIME OUT -->
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label" for="datetimepicker-timeOut">Event Time Out</label>
                                        <input type="text" id="datetimepicker-timeOut" name="event_TimeOut" 
                                        class="form-control" required="required" 
                                        data-toggle="datetimepicker" 
                                        data-target="#datetimepicker-timeOut" data-format="YYYY-MM-DD hh:mm A" />

                                    </div>
                                    <script>
                                        // Default date and time picker
                                        $('#datetimepicker-timeOut').datetimepicker();
                                    </script>

                                    <div class="form-group">
                                        <button name="submit" type="submit" class="btn btn-primary">Create Event</button>
                                    </div>
                                </form>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">IT Days 2023 | Event Management System</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>