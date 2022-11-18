<?php 
    session_start();
    include('server.php');
    @ini_set('display_errors', '0');

    //Prevent user from access by url
    if ($_SESSION['role'] != 'ADMIN'){
        header("location: index.php");
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
    <title>Edit pet</title>
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

    
    <?php // Get old comment to value
        $updateid = $_GET['updateid'];
        $sql = "SELECT * FROM pets WHERE pet_id = '$updateid'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    ?>
    <!--content-->
    <div class="container"><h2 class="text-secondary">Edit a comment</h2><hr><br>
        <div class="col-sm-12">
            <form method = "post">
                <div class="form-group">
                    <h4 class="text-pink">Breed</h4>                   
                    <textarea class="form-control text-green" rows="1" name="new_breed" maxlength="150"required><?php echo $row['breed'];?></textarea>             
                </div>
                <div class="form-group"><br>
                    <h4 class="text-pink">Description</h4>                   
                    <textarea class="form-control text-green" rows="5" name="new_description" required><?php echo $row['description'];?></textarea>             
                </div>
                <div class="form-group"><br>
                    <h4 class="text-pink">Background</h4>                   
                    <textarea class="form-control text-green" rows="5" name="new_background" required><?php echo $row['background'];?></textarea>             
                </div>
                <div class="form-group"><br>
                    <h4 class="text-pink">Property</h4>                   
                    <textarea class="form-control text-green" rows="5" name="new_property" required><?php echo $row['property'];?></textarea>             
                </div>
                <div class="form-group"><br>
                    <h4 class="text-pink">Image Path</h4>                   
                    <textarea class="form-control text-green" rows="1" name="new_image" required><?php echo $row['image'];?></textarea>             
                </div>
                <br>
                <div class="col-sm-12 d-flex justify-content-center ">
                    <button class="btn btn-blue btn-long rounded-pill mb-5 " type="submit" name="edit_pet">Update</button>
                </div>     
            </form>
        </div>
    </div>

    <?php 
        if (isset($_POST['edit_pet'])) {
            $newBreed = mysqli_real_escape_string($conn, $_POST['new_breed']);
            $newDescription = mysqli_real_escape_string($conn, $_POST['new_description']);
            $newBackground = mysqli_real_escape_string($conn, $_POST['new_background']);
            $newProperty = mysqli_real_escape_string($conn, $_POST['new_property']);
            $newImage = mysqli_real_escape_string($conn, $_POST['new_image']);
    
            $sql = "UPDATE pets SET breed='$newBreed', description='$newDescription', background='$newBackground', property='$newProperty', image='$newImage' WHERE pet_id=$updateid";
            mysqli_query($conn, $sql);

            header("Location: edit_pet.php");
        }
    ?>

    <!--footer-->    
    <div class="footer footer-green fixed-bottom"></div>
</body>
</html>