
<!DOCTYPE html>
<html lang="en">
<?php session_start();?>
  <head>

    <title>AllDoctors</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!--



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
            <li class="scroll-to-section"><a href="admin.php" >Home</a></li>
              <li class="scroll-to-section"><a href="users.php">Users</a></li>
              <li class="scroll-to-section"><a href="doctors.php" class="active">Doctors</a></li>
              <li class="scroll-to-section"><a href="allapp.php">Appointments</a></li>
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

  <div id="services" class="about-us">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading">
            <h4>All Doctors</h4>
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
            <th>First Name</th>
            <th>Last Name</th>
            <th>Registration Date</th>
        </tr>
        <?php
        // include database connection file
        include('db_connection.php');

        // Retrieve the user's appointments from the database
        $sql = "SELECT * FROM users WHERE Role = 'doctor'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $fname = $row['FirstName'];
                $lname = $row['LastName'];
                $regdate = $row['Reg_date'];
                echo "<tr><td>$fname</td><td>$lname</td><td>$regdate</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No appointments found</td></tr>";
        }
        // Display the appointments in an HTML table
        ?>
        </table>
      </div>
      <br>
      <!-- <div class="gradient-button"><center><a id="modal_trigger" href="#modal"> Book Appointment</a></center></div> -->
      <!-- <div class="gradient-button"><a href="appointment.php">  </a></center></div> -->
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