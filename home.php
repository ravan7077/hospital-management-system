
<!DOCTYPE html>
<html lang="en">
<?php session_start();?>
  <head>

    <title>Home</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!--

TemplateMo 570 Chain App Dev

https://templatemo.com/tm-570-chain-app-dev

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/templatemo-chain-app-dev.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">

  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="index.html" class="logo">
              <img width="80" height="80" src="assets/images/logo.png" alt="Hospital Services">
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
              <li class="scroll-to-section"><a href="#services">Services</a></li>
              <li class="scroll-to-section"><a href="#about">About</a></li>
              <li class="scroll-to-section"><a href="#"><?php echo $_SESSION['username']; ?></a></li> 
              <li><div class="gradient-button"><a href="logout.php"><i class="fa fa-sign-in-alt"></i> Log Out</a></div></li>   
              <!-- <div class="gradient-button"><a id="modal_trigger" href="logout.php"><i class="fa fa-sign-in-alt"></i> Log Out</a></div></li>  -->
            </ul>        
            <a class='menu-trigger'>
                <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** --> 

  <div id="services" class="services section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading">
            <h4>Your Appointments</h4>
            <img src="assets/images/heading-line-dec.png" alt="">
            <p></p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <table>
        <tr>
            <th>Doctor</th>
            <th>Booking Date</th>
            <th>Appointment Date</th>
            <th>Status</th>
        </tr>
        <?php
        // include database connection file
        include('db_connection.php');

        // Retrieve the user's appointments from the database
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM appointment WHERE PatientID = '$user_id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $apdate = $row['AppointmentDateTime'];
                $bookdate = $row['BookingDate'];
                $docId = $row['DoctorID'];
                $status = $row['Status'];
                $sql2 = "SELECT * FROM users WHERE Id = '$docId'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $docname = $row2['FirstName']." ".$row2['LastName'];
                echo "<tr><td>$docname</td><td>$bookdate</td><td>$apdate</td><td>$status</td></tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No appointments found</td></tr>";
        }
        ?>


        </table>
      </div>
      <br>
      <div class="gradient-button"><center><a id="modal_trigger" href="#modal"> Book Appointment</a></center></div>
      <!-- <div class="gradient-button"><a href="appointment.php">  </a></center></div> -->
    </div>
  </div>

<?php
// start session
// include database connection file
include('db_connection.php');
// Retrieve the records from the database
$result = mysqli_query($conn, "SELECT Id,FirstName,LastName FROM users WHERE Role = 'doctor'");
?> 

<div id="modal" class="popupContainer" style="display:none;">
  <div class="book_appointment">
      <form method="post" action="userapp.php">
          <label> Doctor</label>
          <select name="docid">
              <?php while($row = mysqli_fetch_assoc($result)) { ?>
              <option value="<?php echo $row['Id']; ?>"><?php echo $row['FirstName']." ".$row['LastName']; ?></option>
              <?php } ?>
          </select>
          <label> Select Appoinment Date</label>
          <input type="datetime-local" id="date" name="appdate">
          <label> Mention Your Problem</label>
          <input type="text" name="problem"/>
          <br><br>
          <div class="action_btns">
              <div class="one_half last"><button type="submit" name="submit" class="btn btn_red">Submit</button></div>
          </div>
          <br>
      </form>
  </div>
</div>

 

  <!-- Scripts -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/animation.js"></script>
  <script src="assets/js/imagesloaded.js"></script>
  <script src="assets/js/popup.js"></script>
  <script src="assets/js/custom.js"></script>
</body>
</html>