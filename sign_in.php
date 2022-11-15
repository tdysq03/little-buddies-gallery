<?php 
session_start();
include('server.php');
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
    <title>Sign In</title>
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
                        <a href="categories.php" class="nav-link dropdown-toggle rounded-pill ms-3 me-3" data-bs-toggle="dropdown">Categories</a>
                        <ul class="dropdown-menu ">
                            <li><a href="dog.php" class="dropdown-item text-secondary">Dogs</a></li>
                            <li><a href="cat.php" class="dropdown-item text-secondary">Cats</a></li>
                        </ul>
                    </li>
                    <!--sign in button-->
                    <il class="nav-item">
                        <a href="sign_in.php"><button = button class="btn btn-light rounded-pill text-pink ms-3 me-3">Sign In</button></a>
                    </il>
                </ul>
            </div>  
        </div>
    </nav>


    <!--content-->
    <div class="container">
        <div class="row">
            <div class="col-sm-1"></div>
            <!--sign up-->
            <div class="col-sm-6">
                <div class="card round orange-card mb-4 mt-2">
                    <div class="card-body p-3 m-4">
                        <h2 class="text-center">Welcome back</h2>
                        <p class="text-center">Log in to your existant account</p>
                        <form action = "login_db.php" method = "post">
                            <div class="form-group">
                                <label for="username" class="col-form-label">Username :</label>                                
                                <input type="text" class="form-control rounded-pill" placeholder="username" name = "username">
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-form-label">Password :</label>
                                <input type="password" class="form-control rounded-pill" placeholder="password" name = "password">
                            </div>
                            <a href="#" class="white-link" ><p class=" text-end mt-2 ">Forget Password?</p></a>
                            <div class="col-sm-12 d-flex justify-content-center ">
                                <button class="btn btn-dark rounded-pill btn-long" type="submit" name = "login_user">Log In</button>
                            </div>     
                        </form>
                    </div>
                </div>
                <p class="text-center" style="color: #FFB284;">Dont have an account? <a href="sign_up.php" ><b>Sign up</b></a></p><br><br><br>
            </div>
            <!--dog cat pic-->
            <div class="col-sm-5 d-flex align-items-end " >
                <img src="https://cdn.ultimatepetnutrition.com/wp-content/uploads/2022/09/DogCat.webp" style="width: 110%;">
            </div>
        </div>
    </div>

    <!--footer-->    
    <div class="footer footer-green fixed-bottom"></div>
</body>
</html>