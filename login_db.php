<?php 
    session_start();
    include('server.php');
    $errors = array();

    if (isset($_POST['login_user'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if (empty($username)) {
            array_push($errors, "Username is required");
            $_SESSION['error'] = "Username is required!";
        }

        if (empty($password)) {
            array_push($errors, "Password is required");
            $_SESSION['error'] = "password is required!";
        }

        if (count($errors) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            $result = mysqli_query($conn, $query);
        }

        if($result==null){
            array_push($errors,"Username or password can't be blank");
            $_SESSION['error'] = "Username or password can't be blank!";
            header("location: sign_in.php");
        }else if (mysqli_num_rows($result) == 1) {  //เช็คว่าชื่อกับรหัสตรงกับ db ไหม
                $_SESSION['logged_in'] = true;
                $row = mysqli_fetch_array($result);
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $row['role'];
                $_SESSION['email'] = $row['email'];
                header("location: index.php");
        } else {
                array_push($errors, "Wrong Username or Password");
                $_SESSION['error'] = "Wrong Username or Password!";
                header("location: sign_in.php");
            }
    }else{
        
    }

?>