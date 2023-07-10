<?php
$con=mysqli_connect("localhost","root","");
    if(mysqli_connect_error()){
        print("Failed to connect db:".mysqli_connect_error());
        exit();
    }
    else
    print("Connection sucessful!!"."\n");

$errors = array();
mysqli_select_db($con,"users");
$username=$_POST['uname'];
$passw=$_POST['passw'];
$username = str_replace(" ","", $_POST['uname']);
$password = md5($passw);
$query = "SELECT * FROM users WHERE username='$username'and password='$password'";
$results = mysqli_query($con, $query);
        
    if (mysqli_num_rows($results) == 1) {
    echo'<h1>You are now logged in</h1>';
    }
    else {
        echo'<html><h2>Wrong Password Entered<a href="login.html">TRY AGAIN</a></h2></html>';
    }
?>