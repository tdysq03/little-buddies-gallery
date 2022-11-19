<?php
    session_start();
    include('server.php');
    @ini_set('display_errors', '0');

    //Prevent one from deleting others's comments
    $deleteid = $_GET['deleteid'];
    $userTemp = $_SESSION['username'];
    $query = mysqli_query($conn, "SELECT * FROM comments WHERE comment_id='$deleteid'");
    $result = mysqli_fetch_assoc($query);
    $userIdTemp = $result['user_id'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE user_id='$userIdTemp'");
    $result = mysqli_fetch_assoc($query);
    $resultName = $result['username'];
    
    if (($_SESSION['role'] == 'ADMIN') || ($userTemp == $resultName)) {
        if (isset($_GET['deleteid'])){
            $deleteid = $_GET['deleteid'];
            $sql = "DELETE FROM comments WHERE comment_id = '$deleteid'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location: {$_SERVER["HTTP_REFERER"]}");
            }
        }
    } else {
        header("Location: {$_SERVER["HTTP_REFERER"]}");
    }
?>