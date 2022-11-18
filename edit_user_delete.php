<?php 
    session_start();
    include('server.php');
    @ini_set('display_errors', '0');

    //Prevent user from access by url
    if ($_SESSION['role'] == 'ADMIN'){
        if (isset($_GET['deleteid'])) {
            $deleteId = $_GET['deleteid'];

            $sql = "DELETE FROM users WHERE user_id='$deleteId'";
            $result = mysqli_query($conn, $sql);
        if ($result) {
            array_push($success, "Delete complete!");
            $_SESSION['success'] = "Delete complete!";
            header("location: add_user.php");
        }
        }
        
    }
?>