<?php
// start session
session_start();

// include database connection file
include('db_connection.php');

// check if login form has been submitted
// Check if the form has been submitted
echo "successfully login";
// header("Location: index.php");
// if(isset($_POST['submit'])){

  // Get the user's login credentials from the form
  $username = $_POST['username'];
  $password = $_POST['password'];
  if(empty($username))
  $username = $_GET['username'];
  if(empty($password))
  $password = $_GET['password'];


  // Prepare the SQL query to select the user's record from the database
  $sql = "SELECT * FROM users WHERE Username='$username' AND Password='$password'";
  // Execute the query
  $result = mysqli_query($conn, $sql);
  

  // Check if the query returned any rows
  if (mysqli_num_rows($result) == 1) {
      // Authentication successful - set session variables
      $row = mysqli_fetch_assoc($result);
      $_SESSION['loggedin'] = true;
      $_SESSION['username'] = $row['Username'];
      $_SESSION['user_id'] = $row['Id'];
      // Redirect to the home page
      if($row['Role'] == 'admin')
        header("Location: admin.php");
      else
        header("Location: home.php");
echo "successfully login";
exit();
  } else {
      // Authentication failed - show error message
      $error_message = "Invalid login credentials. Please try again.";
echo "Login Failed";
}
// }
?>
