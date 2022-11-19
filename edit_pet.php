<?php 
session_start();
include('server.php');
@ini_set('display_errors', '0');
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
    <title>Edit/Delete Pet</title>
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
    
    <!--sidebar menu-->
    <div class="sidebar">
        <h6 class="text-white btn-green ps-4 py-2">Manage content</h6>
        <a class="btn-sm rounded-1 mx-3 ps-4" href="add_pet.php">Add new pet</a>
        <a class="active btn-sm rounded-1 mx-3 ps-4" href="edit_pet.php">Edit/Delete pet</a>
        <hr class="mx-3">
        <h6 class="text-white btn-orange ps-4 py-2">Manage members</h6>
        <a class="btn-sm rounded-1 mx-3 ps-4" href="add_user.php">Add new member</a>
        <a class="btn-sm rounded-1 mx-3 ps-4" href="edit_user.php">Edit/Delete member</a>
    </div>
    

    <!--content-->
    <div class="content">
        <div class="container">
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
            <!--cat data-->
            <div class='row'>
                <h2 class="text-center">All Cat</h2>
                <h5 class="text-center text-green">น้องแมวเหมียวทั้งหมด</h5><hr>
                <br>
                <div class="col-sm-12" style="height: 500px; overflow: scroll;" >
                    <?php 
                    $sql = "SELECT * FROM pets WHERE categories='CAT' ";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        echo"<table class='table table-bordered'>
                        <thead class='table-secondary text-center'>
                        <tr>
                            <th>breed</th>
                            <th>description</th>
                            <th>background</th>
                            <th>property</a></th>
                            <th>image path</a></th>
                            <th>Option</a></th>
                        </tr>
                        </thead>
                        <tbody>";
                        while($row = $result->fetch_assoc()) {
                        echo "<tr>".
                        "<td>".$row["breed"]."</td>".
                        "<td>".$row['description']."</td>".
                        "<td>".$row['background']."</td>".
                        "<td>".$row['property']."</td>".
                        "<td>".$row['image']."</td>".
                        //edit delete button
                        "<td class='d-flex justify-content-around'><a class='white-link' href='edit_pet_update.php?updateid=".$row['pet_id']."'><button class='btn btn-sm btn-secondary'>Edit</button></a>
                        <a class='white-link' href='edit_pet_delete.php?deleteid=".$row['pet_id']."'><button class='btn btn-sm btn-danger'>Delete</button></a></td>".
                        "</tr>";
                        }
                        echo "</tbody></table>";
                    } else {
                        echo "0 results";
                    }
                    ?>
                </div>   
                <!--dog data-->
                <div class='row mt-5'>
                <h2 class="text-center">All Dog</h2>
                <h5 class="text-center text-green">น้องหมาบ้อกแบ้กทั้งหมด</h5><hr>
                <br>
                <div class="col-sm-12" style="height: 500px; overflow: scroll;" >
                    <?php 
                    $sql = "SELECT * FROM pets WHERE categories='DOG' ";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        echo"<table class='table table-bordered'>
                        <thead class='table-secondary text-center'>
                        <tr>
                            <th>breed</th>
                            <th>description</th>
                            <th>background</th>
                            <th>property</a></th>
                            <th>image path</a></th>
                            <th>Option</a></th>
                        </tr>
                        </thead>
                        <tbody>";
                        while($row = $result->fetch_assoc()) {
                        echo "<tr>".
                        "<td>".$row["breed"]."</td>".
                        "<td>".$row['description']."</td>".
                        "<td>".$row['background']."</td>".
                        "<td>".$row['property']."</td>".
                        "<td>".$row['image']."</td>".
                        //edit delete button
                        "<td class='d-flex justify-content-around'><a class='white-link' href='edit_pet_update.php?updateid=".$row['pet_id']."'><button class='btn btn-sm btn-secondary'>Edit</button></a>
                        <a class='white-link' href='edit_pet_delete.php?deleteid=".$row['pet_id']."'><button class='btn btn-sm btn-danger'>Delete</button></a></td>".
                        "</tr>";
                        }
                        echo "</tbody></table>";
                    } else {
                        echo "0 results";
                    }
                    ?>
                </div>    
            </div> <br><br>
        </div> 
    </div>


    <!--footer-->    
    <div class="footer footer-green fixed-bottom"></div>
</body>
</html>