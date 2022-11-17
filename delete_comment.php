<?php
    session_start();
    include('server.php');
    @ini_set('display_errors', '0');
    if (isset($_GET['deleteid'])){
        $deleteid = $_GET['deleteid'];

        $sql = "DELETE FROM comments WHERE comment_id = '$deleteid'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: {$_SERVER["HTTP_REFERER"]}");
        }
    }

?>