<?php 
    session_start();
    include('server.php');
    $success = array();
    $errors = array();

    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password1 = mysqli_real_escape_string($conn, $_POST['password1']);
        $password2 = mysqli_real_escape_string($conn, $_POST['password2']);

        if (empty($username)) {
            array_push($errors, "Username is required");
            $_SESSION['error'] = "Username is required";
        }
        if (empty($email)) {
            array_push($errors, "Email is required");
            $_SESSION['error'] = "Email is required";
        }
        if (empty($password1)) {
            array_push($errors, "Password is required");
            $_SESSION['error'] = "Password is required";
        }
        if ($password1 != $password2) {
            array_push($errors, "The two passwords do not match");
            $_SESSION['error'] = "The two passwords do not match";
        }

        $usercheck = "SELECT * FROM users WHERE username = '$username' OR email = '$email' LIMIT 1";
        $query = mysqli_query($conn, $usercheck);
        $result = mysqli_fetch_assoc($query);

        if ($result) { // เช็คว่าชื่่อซ้ำไหม
            if ($result['email'] == $email) {
                array_push($errors, "Email already exists");
                $_SESSION['error'] = "Email already exists";
            }
            if ($result['username'] == $username) {
                array_push($errors, "Username already exists");
                $_SESSION['error'] = "Username already exists";
            }
        }

        if (count($errors) == 0) {
            $password = md5($password1);
            $sql = "INSERT INTO users (email, username, password,role) VALUES ('$email', '$username', '$password','USER')";
            mysqli_query($conn, $sql);
            array_push($success, "Register Success");
            $_SESSION['success'] = "Register Success";

            $_SESSION['username'] = $username;
            header('location: sign_up.php');
        } else {
            header("location: sign_up.php");
        }
    }
?>