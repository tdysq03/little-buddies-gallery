<?php 
session_start();
include('server.php');
@ini_set('display_errors', '0');
    $errors = array();
    $nameTemp = $_SESSION['username'];
    if (isset($_POST['submit'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['oldpassword']);
        $newpassword = mysqli_real_escape_string($conn, $_POST['newpassword']);

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

        $passcheck = "SELECT * FROM users WHERE password = '$password'";
        $query = mysqli_query($conn, $passcheck);
        $result = mysqli_fetch_assoc($query);

        if ($result) { // เช็คว่ารหัสตรงอันเก่าไหมไหม
            $password = md5($password);
            if ($result['oldpassword'] != $password) {
                array_push($errors, "password no match");
                $_SESSION['error'] = "password no match";
            }
        }

        if (count($errors) == 0) {
            $password = md5($password);
            $newpassword = md5($newpassword);
            $sql = "UPDATE users SET  email = '$email', username = '$username', password = '$newpassword' WHERE username='$nameTemp' ";
            mysqli_query($conn, $sql);
            header('location: logout.php');
        } else {
            header("location: edit_profile.php");
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
    <title>Test</title>
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
    <div class="container" >    
        <h2 class="rounded-pill mt-3 mb-4" style="color: #C6C09c;">Edit Profile</h2><hr>
        <div class="row">
            <div class="col-sm-12">
                <form action = "#" method = "post">
                <?php if (isset($_SESSION['error'])) :?>
                            <div class="alert alert-warning alert-dismissible fade show round" role="alert">
                            <h4 class="alert-heading">Please try again</h4>
                            <?php
                                    echo $_SESSION['error'];
                                    unset($_SESSION['error']);
                            ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif ?>
                    <div class="form-group">
                        <label for="inputPassword" class="col-form-label">E-mail :</label>           
                        <input type="text" class="form-control rounded-pill" name = "email" placeholder="e-mail" value=<?php echo $_SESSION['email'];?>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-form-label">Username :</label>
                        <input type="text" class="form-control rounded-pill"  name = "username" placeholder="username" value=<?php echo $_SESSION['username'];?>>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-form-label">New Password :</label>
                        <input type="password" class="form-control rounded-pill" name = "newpassword" placeholder="newpassword" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-form-label">Old password :</label>
                        <input type="password" class="form-control rounded-pill"  name = "oldpassword" placeholder="password" value="">
                    </div><br>
                    <div class="col-sm-12 d-flex justify">
                                <button class="btn btn-dark rounded-pill btn-long" type="submit" name="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <!--dogcat pic-->
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 d-flex align-items-center " >
                <img src="images/dog-edit.png" style="width: 105%;">
            </div>
        </div>

    <!--footer-->    
    <div class="footer footer-green fixed-bottom"></div>
</body>
</html>