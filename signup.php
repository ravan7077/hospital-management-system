<?php
// include database connection file
include('db_connection.php');


// Get the form data
$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Validate the form data
if (empty($username) || empty($firstname) || empty($lastname) || empty($password)) {
    // If any field is empty, show an error message
    echo "All fields are required.";
// } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//     // If the email is invalid, show an error message
//     echo "Invalid email address.";
} else {
    // If the form data is valid, create a new user account
    // $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (FirstName, LastName, Username, Password) VALUES ('$firstname', '$lastname','$username','$password')";

    if (mysqli_query($conn, $sql)) {
        $data = array('username' => $username, 'password' => $password);
        $options = array(
            'http' => array(
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context = stream_context_create($options);
        header('Location: login.php', true, 307);
        stream_context_set_default($options);
        // exit();
    } else {
        // If there's an error inserting the user, show an error message
        echo "Error: " . mysqli_error($conn);
    }
}

?>
