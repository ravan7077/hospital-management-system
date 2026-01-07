<?php
// include database connection file
session_start();
if(isset($_POST['submit'])) {
    include('db_connection.php');

    // Get the form data
    $userid = $_SESSION['user_id'];
    $docid = mysqli_real_escape_string($conn, $_POST['docid']);
    $appdate = mysqli_real_escape_string($conn, $_POST['appdate']);
    $problem = mysqli_real_escape_string($conn, $_POST['problem']);
    $sql = "INSERT INTO appointment (PatientID, DoctorID, AppointmentDateTime, problem) VALUES ('$userid', '$docid','$appdate','$problem')";

        if (mysqli_query($conn, $sql)) {
            $context = stream_context_create($options);
            header('Location: home.php', true, 307);
            stream_context_set_default($options);
            exit();
        } else {
            // If there's an error inserting the user, show an error message
            echo "Error: " . mysqli_error($conn);
        }
    }
?>

