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
                                <?php if( $_SESSION['role']=='ADMIN'): ?>
                                    <li><a href="create_content.php" class="dropdown-item text-secondary">Add new pet</a></li>
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
            <div>
                <h2><span class='rounded-3 btn-dark p-2'>ความคิดเห็น</span></h2>
                <br><br>
                <!-- Comment writing section -->
                        <!-- if logged_in can comment -->
                <?php if( $_SESSION['logged_in']): ?>
                    
                    <h6><span class='rounded-3 btn-info p-1 disabled'>แสดงความคิดเห็น</span></h6>
                    <div> 
                        <form action='comment.php' method='post'>
                            <div class="form-group">
                                <textarea class="form-control" rows="2" cols="110" name="comments" maxlength="150" placeholder="Write a comment..." required style="resize: none;"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-success" name="commentSubmit">Comment!</button>
                            </div>
                            <br><br>
                        </form>
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
                            echo "<div class='p-3 border border-dark border-1 rounded-3' style='background-color:#E79796;'>"
                            ."<div class='h2 b'>" . $usernameResult['username'] . "</div>"
                            ."<div class=''>" . $row['comment'] . "</div>"
                            ."<div>เมื่อ " . $row['date'] ."</div>";

                            //ลบ + แก้ไขเม้น
                            $usernameTemp = $_SESSION['username'];
                            if ($usernameResult['username'] == $usernameTemp) {
                                echo "<div style='float:right;'>
                                    <a href='edit_comment.php?updateid=".$row['comment_id']."'>Edit</a>"
                                    ." | "
                                    ."<a href='delete_comment.php?deleteid=".$row['comment_id']."'>Delete</a>"
                                    ."</div><br>";
                            }

                            echo "</div><br>";
                            
                        }
                    } else {
                        echo "<div class='' style='text-align: center;'>
                        <h3 class='m-2'>No Comment yet!</h3>
                        </div>
                        <br>
                        
                        ";
                    }
                    echo "<br><br>";
                    
                    
                ?>


            </div>  
         
    </div>

    <!--footer-->    
    <div class="footer footer-green fixed-bottom"></div>
</body>
</html>