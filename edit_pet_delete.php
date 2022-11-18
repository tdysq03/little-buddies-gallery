<?php 
    session_start();
    include('server.php');
    @ini_set('display_errors', '0');

    //Prevent user from access by url
    if ($_SESSION['role'] == 'ADMIN'){
        if (isset($_GET['deleteid'])) {
            $deleteId = $_GET['deleteid'];

            $sql = "DELETE FROM pets WHERE pet_id='$deleteId'";
            $result = mysqli_query($conn, $sql);
        if ($result) {
            header("location: edit_pet.php");
        }
        }
        
    }
?>