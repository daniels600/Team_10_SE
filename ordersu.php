<?php
    session_start();

    include "config/db_conn.php";
    //creating an instance of db_connection 
    $db = new DB_connection();

    if (!isset($_SESSION["user_loggedIn"])) {
        header('Location: sign-up.php');
    }
    // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $dbname ="team_10";
    
    if(isset($_GET['id'])){
        $menu_id = $_GET['id'];
    }
    $user_id = isset($_SESSION['user_id'])? $_SESSION['user_id'] : "";
    $restaurant_id  =1;
    $query = "INSERT INTO orders(restaurant_id,menu_id,user_id) VALUES('$restaurant_id','$menu_id','$user_id')";
    $result = $db->connect()->query($query);

    if($result){
        header('Location: index.php?message=success');
    }else{
        header("Location: restaurant_menu.php");
    }
    
    // if(isset($_GET["delete"])){
    //     $delete= $_GET["delete"];
    //     $sql = "DELETE from orders where order_id = $delete";
    //     $db->connect()->query($sql);
    // }
    // $o ="meal_name";
    // if(isset($_GET["orderby"])){
    //     $o =$_GET["orderby"];
    // }
    // $sql = "SELECT orders.order_id, menu.meal_name,menu.meal_price,restaurants.restaurant_name, 
    // orders.created_at FROM `orders`, `menu` LEFT JOIN restaurants on 
    // restaurants.restaurant_id = menu.restaurant_id WHERE menu.menu_id = orders.menu_id 
    // and orders.user_id = ".$_SESSION["User"][1];
    // $query = $db->connect()->query($sql);

    

?>
<!-- <html>
    <body>
        <form>
            <table>
                <tr>
                <tr>
                    <th><button type = "submit" name = 'orderby' value ='meal_name'>Meal Name</button></th>
                    <th><button type = "submit" name = 'orderby' value ='meal_price'>Meal Price</button</th>
                    <th><button type = "submit" name = 'orderby' value ='restaurant_name'>Restaurant Name</th>
                    <th><button type = "submit" name = 'orderby' value ='created_at'>Created At</th>
                </tr>
                <?php
                    
                    // while($row = mysqli_fetch_array($query)){
                    //     echo "<tr>
                    //     <td>".$row['meal_name']."</td>
                    //     <td>".$row['meal_price']."</td>
                    //     <td>".$row['restaurant_name']."</td>
                    //     <td>".$row['created_at']."</td>
                    //     <td><button type='submit' name ='delete' value =".$row['order_id'].">Delete</button></td>
                    //     </tr>";
                    // }
                ?>
            </table>
        <form>
    </body>
</html> -->
