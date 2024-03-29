<?php 
session_start();
include('server.php');
@ini_set('display_errors', '0');
$sql = "SELECT * FROM pets";
$result = $conn->query($sql);
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
    <title><?php echo $_SESSION['breed']; ?></title>
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
                <form class="d-flex" action="search.php" method="GET">
                    <input class="form-control rounded-pill ms-2 me-2" placeholder="search" type="text" name="search">
                    <button class="btn btn-light rounded-pill text-pink" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                  </form>
                <!--menu-->
                <ul class="navbar-nav ms-auto d-flex align-items-center">
                    <li class="nav-item ">
                        <a href="index.php" class="nav-link rounded-pill ms-2 me-2 px-3">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link btn-pink2 dropdown-toggle rounded-pill ms-2 me-2 px-3" data-bs-toggle="dropdown">Categories</a>
                        <ul class="dropdown-menu ">
                            <li><a href="dog.php" class="dropdown-item text-secondary">Dogs</a></li>
                            <li><a href="cat.php" class="dropdown-item text-secondary">Cats</a></li>
                        </ul>
                    </li>
                    <?php if( $_SESSION['logged_in']): ?>
                        <!--user-->
                        <li class="nav-item dropdown">
                            <button class="btn btn-light rounded-pill text-pink ms-2 me-3 dropdown-toggle" data-bs-toggle="dropdown"><?php echo $_SESSION['username'];?></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <h6 class="dropdown-header">email: <?php echo $_SESSION['email'];?><br>username: <?php echo $_SESSION['username'];?></h6>
                                <li><a href="edit_profile.php" class="dropdown-item text-secondary">Edit profile</a></li>
                                <?php if( $_SESSION['role']=='ADMIN'): ?>
                                    <li><a href="add_pet.php" class="dropdown-item text-secondary">Administer</a></li>
                                <?php endif; ?>
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
                <img src='".$_SESSION['image']."'style='width: 100%;'>
                    </div>
                <div class='col-sm-6 mb-3 pt-2'>
                    <h2>".$_SESSION['breed']."</h2><hr>
                    <p class='text-secondary'>&emsp; &emsp; ".$_SESSION['description']."</p>
                </div>
            </div>
            <div class='row'>
                <div class='col-sm-12'>
                    <p class='text-secondary'>&emsp; &emsp;".$_SESSION['background']."</p>
                </div>
            </div>
            <div class='row p-2'>
                <div class='col-sm-12'>
                    <h6><span class='rounded-3 btn-blue p-1'>ลักษณะนิสัย</span></h6>
                    <p class='text-secondary mt-3'>&emsp; &emsp;".$_SESSION['property']."</p>
                </div><hr><br><br>
            </div>";
        ?>
            <!-- Comment Section -->
           
                <!-- Comment writing section -->
                        <!-- if logged_in can comment -->
                <?php if( $_SESSION['logged_in']): ?>
                <div class="col-sm-12">     
                    <form action='comment.php' method='post'>
                        <h4>แสดงความคิดเห็น</h4>
                        <div class="form-group">
                            <textarea class="form-control" rows="5" name="comments" maxlength="150" placeholder="Write a comment..." required></textarea>
                            <button type="submit" class="btn btn-pink mt-3" name="commentSubmit">Comment!</button>
                        </div>
                    </form>
                </div><br><hr><br>
                <?php endif ?>
                <h4>ความคิดเห็น</h4>
                <!-- Alert Box -->
                <?php if (isset($_SESSION['success'])) :?>
                            <div class="alert alert-success alert-dismissible fade show round" role="alert">
                            <h4 class="alert-heading">Congrat</h4>
                            <?php
                                    echo $_SESSION['success'];
                                    unset($_SESSION['success']);
                            ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                <?php endif ?>

                <!-- Show Comments -->
                <?php
                    //get pet_id
                    $breedTemp = $_SESSION['breed'];
                    $getPetId = "SELECT * FROM pets WHERE breed = '$breedTemp'";
                    $query = mysqli_query($conn, $getPetId);
                    $result = mysqli_fetch_assoc($query);
                    $petIdTemp = $result['pet_id'];
                
                    $sql = "SELECT * FROM comments WHERE pet_id = '$petIdTemp'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // get User's Name
                            $userIdTemp = $row['user_id'];
                            $getUsername1 = "SELECT * FROM users WHERE user_id = '$userIdTemp'";
                            $query = mysqli_query($conn, $getUsername1);
                            $usernameResult = mysqli_fetch_assoc($query);

                            /* $usernameResult['username'] = ชื่อคนเม้น
                                $row['comment'] = เม้น
                                $row['date'] = วันที่
                            */
                            echo
                            "<div class='col-sm-12'>  
                                <div class='card mb-4'> 
                                    <div class='card-header text-secondary d-flex justify-content-between align-items-end pt-3'>
                                        <h5>" . $usernameResult['username'] . "</h5>
                                        <small class='text-muted'>เมื่อ ". $row['date'] ."</small>
                                    </div>
                                    <div class='card-body'>
                                        <p class='card-text pt-2 pb-4 text-green'>" . $row['comment'] ."</p> 
                                    </div>";

                                    //ลบ + แก้ไขเม้น
                                    $usernameTemp = $_SESSION['username'];
                                    if ($usernameResult['username'] == $usernameTemp) {
                                    echo 
                                    "<div class='card-footer text-end'>
                                        <a class='white-link' href='edit_comment.php?updateid=".$row['comment_id']."'><button class='btn btn-sm btn-secondary'>Edit</button><a>
                                        <a class='white-link' href='delete_comment.php?deleteid=".$row['comment_id']."'><button class='btn btn-sm btn-orange'>Delete</button></a>
                                    </div>";
                                    } elseif ($_SESSION['role'] == 'ADMIN') {
                                    echo 
                                    "<div class='card-footer text-end'>
                                        <a class='white-link' href='delete_comment.php?deleteid=".$row['comment_id']."'><button class='btn btn-sm btn-orange'>Delete</button></a>
                                    </div>";
                                    } 
                                    echo 
                                "</div>
                            </div>"; 
                        }
                    } else {
                        echo 
                        "<div class='text-center'>
                            <h3 class='text-orange'>No Comment yet!</h3>
                        </div>";
                        
                    }
                    echo "<br><br></div>";
   
                ?>


         
         
    </div>

    <!--footer-->    
    <div class="footer footer-green fixed-bottom"></div>
</body>
</html>