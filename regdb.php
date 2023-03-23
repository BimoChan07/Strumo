<?php
include './includes/dbconn.php';
$fname = $_POST['fname'];
$email = $_POST['email'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$username = $_POST['username'];
$password = $_POST['password'];
$address = $_POST['address'];

$sql = "INSERT INTO users(fullname,email,address,phone,username,password)
    VALUES ('$fname','$email','$address','$phone','$username','$password')";

// $sql1 = "INSERT INTO users(username,password) VALUES ('$username','$password')";
if ($mysqli->query($sql) > 0) {

    echo "<script>alert('User Registered Successfully');
    window.location.href='login.php'</script>";
} else {
    echo "<script>alert('Error while registering');
    </script>";
}
