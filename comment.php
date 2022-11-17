<?php 
    session_start();
    include('server.php');
    date_default_timezone_set("Asia/Bangkok");
    if (isset($_POST['commentSubmit'])) {
        //Comment
        $comment = mysqli_real_escape_string($conn, $_POST['comments']);

        //Date
        $dateTemp = date('Y-m-d H:i:s');
        echo $dateTemp; //check

        //UserID
        $usernameTemp = $_SESSION['username'];
        $getUserId = "SELECT * FROM users WHERE username = '$usernameTemp'";
        $query = mysqli_query($conn, $getUserId);
        $result = mysqli_fetch_assoc($query);
        $userIdTemp = $result['user_id'];
        
        //PetID
        $breedTemp = $_SESSION['breed'];
        // echo $breedTemp; //check
        $getPetId = "SELECT * FROM pets WHERE breed = '$breedTemp'";
        $query = mysqli_query($conn, $getPetId);
        $result = mysqli_fetch_assoc($query);
        $petIdTemp = $result['pet_id'];



        $sql = "INSERT INTO comments (comment_id, user_id, pet_id, comment, date) VALUES ('', '$userIdTemp', '$petIdTemp', '$comment', '$dateTemp')";
        mysqli_query($conn, $sql);
        header('location: pet_info.php');
    }
?>