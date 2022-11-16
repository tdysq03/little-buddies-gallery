<?php 
session_start();
include('server.php');
@ini_set('display_errors', '0');
$sql = "SELECT * FROM pets";
$result = $conn->query($sql);
if(isset($_POST['pet_id'])) {
    $pet_id=$_POST['pet_id'];
    $result=mysqli_query($conn,"SELECT * FROM pets WHERE pet_id='$pet_id'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.1/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <title><?php echo $row['breed']; ?></title>
</head>
<body>

    <!--navbar-->
    <nav class="navbar navbar-expand-sm navbar-dark navbar-bg-pink fixed-top">
        <div class="container-fluid">
            <a href="index.php" class="navbar-brand " style="margin: -20px 0px -13px -10px;"><img src="images/logo-nav.png" height="55px"></a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarToggle">
                <span class="navbar-toggler-icon" ></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarToggle">
                <!--search-->
                <form class="d-flex">
                    <input class="form-control rounded-pill ms-2 me-2" placeholder="search" type="text"  >
                    <button class="btn btn-light rounded-pill text-pink" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                  </form>
                <!--menu-->
                <ul class="navbar-nav ms-auto d-flex align-items-center">
                    <li class="nav-item ">
                        <a href="index.php" class="nav-link rounded-pill ms-3 me-3">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle rounded-pill ms-3 me-3" data-bs-toggle="dropdown">Categories</a>
                        <ul class="dropdown-menu ">
                            <li><a href="dog.php" class="dropdown-item text-secondary">Dogs</a></li>
                            <li><a href="cat.php" class="dropdown-item text-secondary">Cats</a></li>
                        </ul>
                    </li>
                    <?php if( $_SESSION['logged_in']): ?>
                        <!--user-->
                        <li class="nav-item dropdown">
                            <button class="btn btn-light rounded-pill text-pink ms-3 me-3 dropdown-toggle" data-bs-toggle="dropdown"><?php echo $_SESSION['username'];?></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <h6 class="dropdown-header">email: <?php echo $_SESSION['email'];?><br>username: <?php echo $_SESSION['username'];?></h6>
                                <li><a href="edit_profile.php" class="dropdown-item text-secondary">Edit profile</a></li>
                                <li><a href="logout.php" class="dropdown-item text-secondary">Sign out</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <il class="nav-item">
                            <!--sign in button-->
                            <a href="sign_in.php"><button class="btn btn-light rounded-pill text-pink ms-3 me-3" type="button">Sign In</button></a>
                        </il>
                    <?php endif; ?>                    
                </ul>
            </div>  
        </div>
    </nav>

    
    <!--content-->
    <div class="container">
        
        <?php
            echo 
                "<div class='row d-flex align-items-end'>  
                    <div class='col-sm-6 mb-3'>
                        <img src='".$row['image']."'style='width: 100%;'>
                    </div>
                    <div class='col-sm-6 mb-3 pt-2'>
                        <h2>".$row['breed']."</h2><hr>
                        <p class='text-secondary'>&emsp; &emsp; ".$row['description']."</p>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-sm-12'>
                        <p class='text-secondary'>&emsp; &emsp;".$row['background']."</p>
                    </div>
                </div>
                <div class='row p-2'>
                    <div class='col-sm-12'>
                        <h5 class='btn btn-blue'>ลักษณะนิสัย</h5>
                        <p class='text-secondary mt-2'>&emsp; &emsp;".$row['property']."</p><br><br>
                    </div><br><hr><br>
                </div> ";    
            $conn->close();
        ?> 
    </div>




    <!--footer-->    
    <div class="footer footer-green fixed-bottom"></div>
</body>
</html>