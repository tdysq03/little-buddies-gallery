<!--- ใช้ไม่ได้ T^T ---->
<?php 
    session_start();
    include('server.php');
    $errors = array();

    if (isset($_POST['submit_edit'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if (empty($username)) {
            array_push($errors, "Username is required");
            $_SESSION['error'] = "Username is required";
        }
        if (empty($email)) {
            array_push($errors, "Email is required");
            $_SESSION['error'] = "Email is required";
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
            $_SESSION['error'] = "Password is required";
        }

        if (count($errors) == 0) {
            $password = md5($password);
            $sql = "UPDATE users SET  email = '$email', username = '$username', password = '$password'";
            mysqli_query($conn, $sql);

            header('location: index.php');
        } else {
            header("location: edit.php");
        }
    }
?>
