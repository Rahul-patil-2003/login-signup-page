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
$cpassw=$_POST['cpassw'];
$phno=$_POST['phno'];

$username = str_replace(" ", "", $_POST['uname']);
$user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
$result = mysqli_query($con, $user_check_query);
$user = mysqli_fetch_assoc($result);

if ($user) { // if user exists
    if ($user['username'] === $username) {
        echo'<h2>';
        echo("$username,username already exists");
        echo'<html><a href="signup.html">TRY AGAIN</a></h2></html>';
        echo '<script>alert("Username Already exist")</script>';
    }
}

else{
    if($passw==$cpassw){
        if (count($errors) == 0) {
            $password = md5($passw);//encrypt the password before saving in the database
            $query = "INSERT INTO users (username,password,phone)VALUES('$username','$password','$phno')";
            mysqli_query($con, $query);
            echo'<h2>';
            echo("$username,is now registered");
            echo'<html><Now you can Login IN--><a href="login.html">Login form</a></h2></html>';
        }
    }

    else{
        echo("$username,<h2>Confirmed Password does not match-->");
        echo '<script>alert("Confirmed Password does not match")</script>';
        echo'<html><a href="signup.html">TRY AGAIN</a></h2></html>';
    }
}
?>