<?php 
session_start();
include('server.php');
@ini_set('display_errors', '0');
$sql = "SELECT * FROM pets WHERE categories='CAT'";
$result = $conn->query($sql);
if(isset($_POST['pet_id'])) {
    $pet_id=$_POST['pet_id'];
    $result=mysqli_query($conn,"SELECT * FROM pets WHERE pet_id='$pet_id'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['pet_id']=$row['pet_id'];
        $_SESSION['breed']=$row['breed'];
        $_SESSION['description']=$row['description'];
        $_SESSION['property']=$row['property'];
        $_SESSION['background']=$row['background'];
        $_SESSION['image']=$row['image'];
    }
    header("location: pet_info.php");
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
    <title>Cat</title>
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
        <h1>Cat</h1>
        <p class="text-secondary">&emsp; &emsp;แมวถูกปรับเป็นสัตว์เลี้ยงครั้งแรกในตะวันออกใกล้ช่วงประมาณ 7,500 ปีก่อนคริสต์ศักราช เป็นที่เชื่อกันมานานแล้วว่าการเลี้ยงแมวเริ่มขึ้นในอียิปต์โบราณตั้งแต่ประมาณ 3,100 ปีก่อนคริสต์ศักราช โดยแมวได้รับการเคารพนับถือ
         ข้อมูลเมื่อ 2021 มีการประมาณการว่ามีแมวที่มีเจ้าของประมาณ 220 ล้านตัว และแมวจร 480 ล้านตัวทั่วโลก ข้อมูลเมื่อ 2017 แมวบ้านเป็นสัตว์เลี้ยงยอดนิยมอันดับสองในสหรัฐ โดยมีแมวที่มีเจ้าของ 95.6 ล้านตัว และประมาณ 
         42 ล้านครัวเรือนมีแมวอย่างน้อยหนึ่งตัว และ ข้อมูลเมื่อ 2020 ผู้ใหญ่ในสหราชอาณาจักรร้อยละ 26 มีแมวเลี้ยง โดยมีประชากรแมวเลี้ยงประมาณ 10.9 ล้านตัว</p>
        <hr><br>
        <?php 
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo 
                "<div class='card mb-4' '>
                    <div class='row g-0'>
                        <div class='col-sm-4'>
                        <img src='".$row['image']."' class='img-fluid rounded-start' style='width:100%'>
                        </div>
                        <div class='col-sm-8'>
                        <div class='card-body'>
                            <h3 class='card-title'>".$row['breed']."</h3>
                            <p class='card-text text-secondary'>".$row['description']."</p>
                            <form action='' method='post'>
                                <button class='btn btn-pink rounded-pill' type='submit' name='pet_id' value= '".$row['pet_id']."'>more details >></button>
                            </form> 
                        </div>
                        </div>
                    </div>
                </div>";
            }
        } else {
            echo "0 results";
        }
        echo"<br><hr><br>";
        $conn->close();
        ?>
    </div>

    <!--footer-->    
    <div class="footer footer-green fixed-bottom"></div>
</body>
</html>