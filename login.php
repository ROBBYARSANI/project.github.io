<?php
require 'koneksi.php';

// Check if email and password are set in the POST request
if(isset($_POST["email"], $_POST["password"])) {
    // Get email and password from POST request
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Prepare SQL statement with parameterized query
    $query_sql = "SELECT * FROM tbl_users WHERE email = ? AND password = ?";
    $stmt = mysqli_prepare($koneksi, $query_sql);
    
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);
    
    // Execute the statement
    mysqli_stmt_execute($stmt);
    
    // Get result
    $result = mysqli_stmt_get_result($stmt);
    
    // Check if any rows are returned
    if (mysqli_num_rows($result) > 0) {
        // Redirect to home.php if login successful
        header("Location: home.php");
        exit(); // Terminate script execution after redirection
    } else {
        // Display error message if login fails
        echo "<center><h1>Email atau Password Anda Salah. Silahkan Coba Login Kembali.</h1>
                <button><strong><a href='index.html'>Login</a></strong></button></center>";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // If email or password are not set in the POST request
    echo "Email atau password tidak ditemukan.";
}
?>
