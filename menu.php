<?php

session_start();

$status = "";
$mark =false;

if(isset($_SESSION['user_loggedIn']) && isset($_SESSION['user_id'])) {

    $status = 'logout.php?logout=yes';
    $mark =true;
}else{
    $status = 'sign-up.php';
    $mark= false;
}
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname ="team_10";
    
    if(!($conn = new mysqli($servername, $username, $password, $dbname))){
        alert("Connection has failed.");
    } 
    $search = "";
    $s = "";
    $o ="meal_name";
    if(isset($_GET["orderby"])){
        $o =$_GET["orderby"];
    }
    if (isset($_GET["Querysearch"])){
        $s = ucwords($_GET["Querysearch"]); 
        $search = " and (`meal_name` LIKE '%$s%' OR restaurants.restaurant_name LIKE '%$s%') ";
    }
    $sql = "SELECT menu.menu_id,menu.meal_name, menu.meal_price,restaurants.restaurant_name, menu.meal_image 
    FROM menu,restaurants WHERE menu.restaurant_id = restaurants.restaurant_id $search Order By $o";

    $query = $conn->query($sql);

    if(isset($_GET["order"])){
        session_start();
        if (!isset($_SESSION["User"])) {
            header('Location: sign-up.php');
        }
        $order = $_GET["order"];
        $sql = "INSERT INTO `orders`( `menu_id`, `user_id`) VALUES ($order,".$_SESSION["User"][1].")";
        $conn->query($sql);
    }

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home | Foodee</title>
        <script type="text/javascript" src=""></script>
        <link href='https://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    </head>
    <body>
        <header>
            <div class="navbar">
                <div>
                    <img src="svg/Top-left design.svg" alt="design">
                </div>
              <div class="Logo">
                  <img src="svg/Foodee.svg" alt="logo" id="foodee">
                  <img src="svg/Pizza icon.svg" alt="part_logo" id="pizzaicon">
              </div>
              <ul class="main-nav">
                  <li><a href="index.php">Home</a></li>
                  <li><a href="restaurant_admin_signup.php">Restaurant</a></li>
                  <li><a href="#">Menu</a></li>
                  <li><a href="#">Orders</a></li>
                  <li><a href="<?php if($mark == true){echo $status;} else{echo $status;}?>"> 
                  <?php if($mark == true){echo "Logout";} else{echo "Login/Signup";}?>
                  </a></li>
              </ul>  
            </div>
            
        </header>
        <section style="background: rgb(236, 236, 236); margin-bottom: 30px;">
            <div class="row"  >
                <div class="column" >
                    <img src="svg/What to choose.svg" alt="body-image" id="whattocho">
                </div>
                <div class="column">
                    <img src="svg/Text.svg" alt="long-text" id="body-text">
                    <form action = "menu.php">
                        <input type="text" id="Querysearch" name="Querysearch" placeholder="  type here...">
                    
                        <img src="svg/pointer.svg" alt="pointer" id="pointer">
                    
                        <input type="submit" class="btn-query" value="Search">
                    </form>
                </div>
                
            </div>
        </section >
        <div class="loader"><span>Your Searched Food</span></div>
        <section class="view-food" > 
            <div class="grid">
            <?php
                    
                    while($row = $query->fetch_assoc()){ ?>
                <div class="grid-item">
                    <div class="card">
                        <img class="card-img" src= "<?php echo $row['meal_image'] ?>" alt="Burger">
                        <div class="card-container">
                            <h1 class="card-header"><?php echo $row['meal_name']; ?></h1>
                            <p class="card-text">
                                Price - <span>&#8373;</span> <?php echo $row['meal_price']; ?>
                            </p>
                            <a class="card-btn" value="Pick me" href="ordersu.php?id= <?php echo $row['menu_id']; ?>" name = "Pick">Pick me</a>
                        </div>
                    </div>
                </div>
                
                <?php } ?>
            </div>
        </section>
       
        <?php if(isset($_GET['message'])) : ?>
        <div class='flash-data' data-flashdata="<? $_GET['message'];?>"></div>
        <?php endif; ?>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script>
        const flashdata = $('.flash-data').data('flashdata');

        if(flashdata) {
            Swal.fire({
                icon:'success',
                type: 'success',
                title: 'Order Accepted',
                text: 'Your order has been placed',
                    
            }).then(function () {
                window.location.href = 'index.php';
            });
        }
        
        
        </script>
    </body>
</html>
