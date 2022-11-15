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
    <title>welcome to little buddies gallery</title>
</head>
<body>

    <!--navbar-->
    <nav class="navbar navbar-expand-sm navbar-dark fixed-top">
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
                        <a href="sign_in.php"><button class="btn btn-light rounded-pill text-pink ms-3 me-3" type="button">Sign In</button></a>
                    </il>
                </ul>
            </div> 
        </div>
    </nav>
    <img src="images/welcome-1.jpg"style="width: 100%; border-bottom: 20px solid #FFB284;">
    
    
    <!--content-->
    <div class="container" style="height: 1500px;" >    
        <!--popular-->
        <div class="row pb-4" style="text-align: center;">
            <div class=" col-sm-1"></div>
            <div class=" col-sm-2">
                <h3 class="m-2" style="color: #7287A0;">Popular :</h3></div>
                <div class=" col-sm-8 ">
                <button class="btn btn-blue rounded-pill m-2" type="button">#หมาดำ</button>
                <button class="btn btn-blue rounded-pill m-2" type="button">#หมาเซเว่น</button>
                <button class="btn btn-blue rounded-pill m-2" type="button">#แมวส้ม</button>
                <button class="btn btn-blue rounded-pill m-2" type="button">#แมวเห็ด</button>
                <button class="btn btn-blue rounded-pill m-2" type="button">#แมววัว</button>
            </div>
        </div><hr>
    </div>

    <!--footer-->    
    <div class="footer footer-pink fixed-bottom"></div>

    <!--navbar effect-->
    <script>
        const navEl = document.querySelector('.navbar');
        const footEl = document.querySelector('.footer');
        window.addEventListener('scroll',()=>{
            if(window.scrollY >=60){
                navEl.classList.add('navbar-bg-pink');
                footEl.classList.remove('footer-pink');
                footEl.classList.add('footer-green');
            }else if(window.scrollY < 60){
                navEl.classList.remove('navbar-bg-pink');
                footEl.classList.remove('footer-green');
                footEl.classList.add('footer-pink');
            }
        });
    </script>
</body>
</html>