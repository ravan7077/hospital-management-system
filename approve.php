<?php
// include database connection file
include('db_connection.php');

if(isset($_POST['print_button'])) {
    require_once('tcpdf/tcpdf.php');
    
    // Get data from the database
    $aid = $_POST['aid'];
    $sql = "SELECT * FROM appointments WHERE AppointmentID = '$aid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    // Set up PDF document
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetMargins(10, 10, 10);
    $pdf->AddPage();
    
    // Add data to PDF
    $pdf->SetFont('helvetica', '', 11);
    $pdf->Cell(0, 10, 'Appointment Details', 0, 1);
    $pdf->Ln();
    $pdf->Cell(30, 7, 'User:', 0);
    $pdf->Cell(50, 7, $row['PatientID'], 0);
    $pdf->Ln();
    $pdf->Cell(30, 7, 'Doctor:', 0);
    $pdf->Cell(50, 7, $row['DoctorID'], 0);
    $pdf->Ln();
    $pdf->Cell(30, 7, 'Booking Date:', 0);
    $pdf->Cell(50, 7, $row['BookingDate'], 0);
    $pdf->Ln();
    $pdf->Cell(30, 7, 'Appointment Date:', 0);
    $pdf->Cell(50, 7, $row['AppointmentDateTime'], 0);
    $pdf->Ln();
    
    // Output the PDF
    $pdf->Output('appointment.pdf', 'D');
}
else if(isset($_POST['submit_button']))
{
    // Get the form data
    $firstname = mysqli_real_escape_string($conn, $_POST['aid']);

    // Validate the form data
    if (empty($aid)) {
        echo "AppointmentIs fields is required.";
    } else {
        $sql = "UPDATE appointment SET Status = 'Accepted' WHERE AppointmentId = '$aid'";

        if (mysqli_query($conn, $sql)) {
            header('Location: admin.php', true, 307);
            // exit();
        } else {
        
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
